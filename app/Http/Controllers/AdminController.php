<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','2fa']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {

        $filter = isset($req['filter'])?$req['filter']:0;

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
           $filter = '0';
           break;
        }

        $tickets = $query->retrieveAll($table,$filter);
        $places = $query->getPlaces();

        $arr['places'] = $places;
        $arr['tickets'] = $tickets;
        $arr['filter'] = $filter;

        return view('admin',$arr);
    }


}
