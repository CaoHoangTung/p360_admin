<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $status = Auth::user()->name;
        $this->middleware(['auth','2fa']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    // get info from user id
    private function getInfo($uid){
      $result = DB::table('users')->where('id',$uid)->get();
      return $result->toArray();
    }

    public function index(Request $req, $uid=null)
    {
        // if user is not sysadmin
        if (!$uid){
          $id = Auth::user()->id;

          $userData = array();
          $userData['twofactor_is_on']=Auth::user()->twofactor_is_on;
          $userData['admin_granted'] = Auth::user()->admin_granted;
          return view('settings',$userData);
        }
        // if user id sysadmin
        else{
          $id = $uid;
          $arr = self::getInfo($id);
          die(var_dump($arr));
          // $userData['twofactor_is_on'] = $arr['']
          // return view('settings',$userData);
        }
    }

    public function showNameForm(Request $req, $uid=null){
      $userData = array();
      $userData['id'] = Auth::user()->id;
      $userData['name'] = Auth::user()->name;
      $userData['twofactor_is_on']=Auth::user()->twofactor_is_on;
      $userData['admin_granted'] = Auth::user()->admin_granted;
      return view('changeName',$userData);
    }

    public function changeName(Request $req){
      $name = $req->name;
      $id = $req->id;

      // if user change his/her own name
      if ($id == Auth::user()->id){
        $result = DB::table('users')->where('id',$id)->update(['name' => $name]);
        return redirect()->back()->with(['msg'=>'Name changed']);
      } else
      // if user change someone else's name, check for admin privilege
      if (Auth::user()->admin_granted == 1){
        // admin change user's name here
      }
      // if user change someone else's name and are not granted admin privilege
      else return redirect()->back()->with(['msg'=>'Internal error']);
    }

    public function showPasswordForm(){
      $userData = array();
      $userData['id'] = Auth::user()->id;
      $userData['name'] = Auth::user()->name;
      $userData['twofactor_is_on']=Auth::user()->twofactor_is_on;
      $userData['admin_granted'] = Auth::user()->admin_granted;
      return view('changePwd',$userData);
    }

    public function changePassword(Request $req){
      $id = $req->id;
      $old_password = $req->old_password;
      // $old_password = bcrypt($old_password);
      $password = $req->password;
      $cf = $req->cf_password;

      // if user change his/her own name
      if ($id == Auth::user()->id){
        $pwdCorrect = Hash::check($old_password,Auth::user()->password);
        if (!$pwdCorrect)
          return redirect()->back()->with(['msg'=>'Incorrect password']);

        if ($password != $cf)
          return redirect()->back()->with(['msg'=>'Confirm not match']);

        if ($old_password == $cf)
          return redirect()->back()->with(['msg'=>'Your new password cannot be the same as old password']);

        $result = DB::table('users')->where([['id',$id]])->update(['password' => bcrypt($password)]);
        if ($result)
          return redirect()->back()->with(['msg'=>'Password changed successfully']);

        return redirect()->back()->with(['msg'=>'Internal error']);
      } else
      // if user change someone else's password, check for admin privilege
      if (Auth::user()->admin_granted == 1){
        // admin change user's password here
      }
      else return redirect()->back()->with(['msg'=>'Internal error']);

    }

    public function show2faForm(){
      $userData = array();
      $userData['id'] = Auth::user()->id;
      $userData['email'] = Auth::user()->email;
      $userData['name'] = Auth::user()->name;
      $userData['twofactor_is_on']=Auth::user()->twofactor_is_on;
      $userData['admin_granted'] = Auth::user()->admin_granted;

      return view('change2fa',$userData);
    }


    public function customAddSecretKey(Request $request){
      $id = $req->id;

      // if user change his/her own name
      if ($id == Auth::user()->id){
        $secret = $request['secret'];
        $QR_Image = $request['qr'];
        $confirm_pwd = $request['one-time-password'];
        $request->session()->flash('registration_data', session('registration_data'));
        if (strlen($confirm_pwd)==0){
          return view('google2fa.register', ['QR_Image' => $QR_Image, 'secret' => $secret,'err' => 'Incorrect OTP']);
        }
        // var_dump($confirm_pwd,$secret,$QR_Image);die();
        $google2fa = app('pragmarx.google2fa');

        $verify = $google2fa->verifyGoogle2FA($secret,$confirm_pwd);
        // return (var_dump($secret,$confirm_pwd));

        if (!$verify){
          return view('google2fa.register', ['QR_Image' => $QR_Image, 'secret' => $secret,'err' => 'Incorrect OTP']);
        } else{
          DB::table('users')->where('id',$id)->update(['google2fa_secret'=>$secret,'twofactor_is_on'=>1]);
          return redirect('/settings/change/2fa')->with(['msg'=>'Two factor authentication turned on']);
        }
      } else
      // if user change someone else's 2fa, check for admin privilege
      if (Auth::user()->admin_granted == 1){
        // admin change user's password here
      }
      else return redirect()->back()->with(['msg'=>'Internal error']);
    }

    // enable 2fa
    private function customEnable2fa(Request $req){
      $google2fa = app('pragmarx.google2fa');
      $google2fa_secret = $google2fa->generateSecretKey();
      $email = $req->email;

      // Generate the QR image. This is the image the user will scan with their app
   // to set up two factor authentication
      $QR_Image = $google2fa->getQRCodeInline(
          config('app.name'),
          $email,
          $google2fa_secret
        );

      return view('google2fa.register', ['QR_Image' => $QR_Image, 'secret' => $google2fa_secret,'err'=>'']);
    }

    public function change2fa(Request $req){
      $password = $req->password;

      $pwdCorrect = Hash::check($password,Auth::user()->password);
      if(!$pwdCorrect)
        return redirect()->back()->with(['msg'=>'Incorrect password']);

      $id = $req->id;
      // if user change his/her own 2fa
      if ($id == Auth::user()->id){
        $changeTo = $req->twofactor_status;

        if ($changeTo == null){

          $result = DB::table('users')->where('id',$id)->update(['twofactor_is_on'=>0]);
          if ($result)
            return redirect()->back()->with(['msg'=>'Two factor authentication turned off']);
          return redirect()->back()->with(['msg'=>'Internal error']);
        } else
        if ($changeTo == 'on'){
          // $result = DB::table('users')->where('id',$id)->update(['twofactor_is_on'=>1]);
          return self::customEnable2fa($req);
        }
      } else
      // if user change someone else's 2fa, check for admin privilege
      if (Auth::user()->admin_granted == 1){
        // admin change user's 2fa here
      }
      else return redirect()->back()->with(['msg'=>'Internal error']);
    }
}
