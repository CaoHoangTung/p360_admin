<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class APIController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

     public function tryLogin(Request $req){
       $username = $req->username;
       $password = $req->password;
       $query = new Query();

       $res = $query->getUser($username,$password);
       return $res;
     }

     public function registerUser(Request $req){
      // to do
     }

     public function showUForm(){
       $arr['role'] = 'user';
       return view('userForm',['arr'=>$arr]);
     }

     public function addUser(Request $req){
       $username = $req->user_name;
       $password = $req->password;
       $phone = $req->phone;
       $role = $req->role;
       // verify
       $query = new Query();

       $result = $query->addUser($req);
       return $result?redirect()->back()->with(['msg'=>'Thêm thành công'])
                      :redirect()->back()->with(['msg'=>'Thất bại']);
     }

     public function showDForm(){
       $arr = array();
       $arr['role'] = 'driver';
       return view('driverForm',['arr'=>$arr]);
     }
     public function addDriver(Request $req){
       $username = $req->user_name;
       $password = $req->password;
       $phone = $req->phone;
       $role = $req->role;
       // verify
       $query = new Query();

       $result = $query->addDriver($req);
       return $result?redirect()->back()->with(['msg'=>'Thêm thành công'])
                      :redirect()->back()->with(['msg'=>'Thất bại']);
     }

     public function deleteAccount(Request $req){
       $username = $req->user_name;
       $role = $req->role;
       $table = $role=='Tài xế'?'gwdrivers':'gwusers';
       $query = new Query();

       $result = $query->deleteAccount($table,$username);
       return $result?redirect('/admin')->with(['msg' => 'Xóa thành công'])
                      :redirect()->back()->with(['msg' => 'Thất bại']);
     }

     public function profile(Request $req)
     {
         $query = new Query();

         $filter = $req->filter;
         $table;

         switch($filter){
           case "0":
            $table = 'gwusers';
            break;
           case "1":
            $table = 'gwusers';
            break;
           case "2":
            $table = 'gwdrivers';
            break;
           case "3":
            $table = 'gwdrivers';
            break;
           default:
            $table = 'gwusers';
            $filter='0';
         }
         $arr = $query->getInfo($table,$req->username);
         $places = $query->getPlaces();

         $op = $table=='gwdrivers'?'gwusers':'gwdrivers';
         $suggestions = $query->getSuggestions($table,$arr[0]->from_place_id,$arr[0]->to_place_id);

         $arr[0]->role = $table=='gwusers'?'Người dùng':'Tài xế';
         $arr[0]->places = $places;
         $arr[0]->suggestions = $suggestions;

         return view('profile',['arr'=>$arr[0]]);
     }

     public function activate(Request $req){
        $query = new Query();
        $username = $req->user_name;
        $role = $req->role;
        $table;

        switch($role){
          case "Người dùng":
           $table = 'gwusers';
           break;
          case "Tài xế":
           $table = 'gwdrivers';
           break;

        }

        $result = $query->activate($req, $table,$username);

        return $result?redirect()->back()->with(['msg'=>'Lưu thành công'])
                      :redirect()->back()->with(['msg'=>'Không có thay đổi']);
     }

}
