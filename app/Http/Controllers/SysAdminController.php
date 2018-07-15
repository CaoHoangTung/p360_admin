<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SysAdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $status = Auth::user()->name;
        $this->middleware(['auth','2fa','sysadmin']);
    }

    public function index(){
      $userData = array();
      $userData['name'] = Auth::user()->name;
      $userData['password']= Auth::user()->password;
      $userData['twofactor_is_on']=Auth::user()->twofactor_is_on;
      $userData['admin_granted'] = Auth::user()->admin_granted;
      return view('settings',$userData);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

}
