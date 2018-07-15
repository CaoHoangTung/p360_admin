<?php
  namespace App\Http\Controllers;

  use Illuminate\Support\Facades\DB;
  use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

  class Query extends Controller{

    function __construct(){

    }

    public function getPlaces(){
      $result = DB::table('gwplaces')->get()->toArray();
      return $result;
    }

    public function getUser($username, $password){
      $tables = ['gwdrivers','gwusers'];
      foreach($tables as $table){
        $result = DB::table($table)->where([['user_name',$username],['password',$password]])->get();
        if (sizeof($result) > 0) {
          $res = array();
          $utype = $table=='gwdrivers'?'driver':'user';
          $res['auth'] = '1';
          $res['user_type'] = $utype;
          $result[0]->password='hidden';
          $res['data'] = $result[0];
          return json_encode($res);
        }
      }
      return "{auth: 0}";
    }

    public function registerUser($fullname, $username, $password, $type){
      switch($type){
        case 'user':
          break;
        case 'driver':
          break;
        default:
          break;
      }
    }

    public function addUser(Request $req){
      $username = $req->user_name;
      $password = $req->password;
      $fullname = $req->fullname;
      $table = 'gwusers';
      $param = [
        'user_name' => $username,
        'password' => $password,
        'fullname' => $fullname,
      ];

      $result = DB::table($table)->insert($param);
      return $result;
    }

    public function addDriver(Request $req){
      $username = $req->user_name;
      $password = $req->password;
      $fullname = $req->fullname;
      $table = 'gwdrivers';
      $param = [
        'user_name' => $username,
        'password' => $password,
        'fullname' => $fullname,
      ];

      $result = DB::table($table)->insert($param);
      return $result;
    }

    // delete account
    public function deleteAccount($table,$username){
      $result = DB::table($table)->where('user_name',$username)->delete();
      return $result;
    }

    // get user info
    public function getInfo($table,$user_name,$filter = null){

      $result = DB::table($table)->where('user_name',$user_name)->get();
      return $result;
    }

    public function getSuggestions($table,$from,$to){
      $result = DB::table($table)->where([['from_place_id',$from],['to_place_id',$to]])->get()->toArray();
      return $result;
    }

    // query toàn bộ dữ liệu từ bảng $table
    public function retrieveAll($table,$filter){
      // if user is driver
        if($filter > 1) $filter -= 2;

        $result = DB::table($table)->where('status',$filter)->get();
        return $result;
    }

    public function activate(Request $req, $table, $username){

      $username = $req->user_name;
      $password = $req->password;
      $email = $req->email;
      $phone = $req->phone;
      $fullname = $req->fullname;
      $dob = $req->birth_day;
      $gender = $req->gender;
      $status = $req->status;
      $cmnd = $req->cmnd;
      $homeaddr = $req->home_address;
      $comp_name = $req->company_name;
      $comp_addr = $req->company_address;
      $from = $req->from_place_id;
      $to = $req->to_place_id;
      $schedule = $req->schedule_work;
      $role = $req->role;
    if ($role=='Tài xế'){
      $vehicle_number = $req->vehicle_number;
      $driving_license = $req->driving_license;
      $insurrance = $req->insurrance;
    } else{
      $vehicle_number = '';
      $driving_license = '';
      $insurrance = '';
    }
    $param = [
      'user_name' => $username,
      'password' => $password,
      'email' => $email,
      'phone' => $phone,
      'fullname' => $fullname,
      'birth_day' => $dob,
      'gender' => $gender,
      'status' => $status,
      'cmnd' => $cmnd,
      'home_address' => $homeaddr,
      'company_name' => $comp_name,
      'company_address' => $comp_addr,
      'from_place_id' => $from,
      'to_place_id' => $to,
      'schedule_work' => $schedule,
    ];

      $result = DB::table($table)->where('user_name',$username)
      ->update($param);
      return $result;
    }

  }
?>
