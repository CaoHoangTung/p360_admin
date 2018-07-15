@extends('layouts.app')

@section('link')
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.  1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<style>
.user-row {
  margin-bottom: 14px;
}

.user-row:last-child {
  margin-bottom: 0;
}


.dropdown-user:hover {
  cursor: pointer;
}

.table-user-information > tbody > tr {
  border-top: 1px solid rgb(221, 221, 221);
}

.table-user-information > tbody > tr:first-child {
  border-top: 0;
}


.table-user-information > tbody > tr > td {
  border-top: 0;
}
.toppad
{margin-top:20px;
}

</style>
@endsection

@section('content')
<div class="container">
      <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >


          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">{{$arr->user_name}} - {{$arr->role}}</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="https://bothraindustries.com/wp-content/themes/bothraindustries/img/default-user-icon.png" class="img-circle img-responsive"> </div>

                <!--<div class="col-xs-10 col-sm-10 hidden-md hidden-lg"> <br>
                  <dl>
                    <dt>DEPARTMENT:</dt>
                    <dd>Administrator</dd>
                    <dt>HIRE DATE</dt>
                    <dd>11/12/2013</dd>
                    <dt>DATE OF BIRTH</dt>
                       <dd>11/12/2013</dd>
                    <dt>GENDER</dt>
                    <dd>Male</dd>
                  </dl>
                </div>-->
                <div class=" col-md-9 col-lg-9 ">
                  <form method='post' action='{{ route("activate")}}'>
                    @csrf
                  <table class="table table-user-information">
                    <tbody>
                      <tr><td>
                      Tên đăng nhập
                    </td><td><input id='' name='user_name' value='{{$arr->user_name}}'></td></tr>
                      <tr><td>
                      Mật khẩu
                    </td><td><input type='password' id='' name='password' value='{{$arr->password}}'></td></tr>
                      <tr><td>
                      Email
                    </td><td><input id='' name='email' value='{{$arr->email}}'></td></tr>
                      <tr><td>
                      SĐT
                    </td><td><input id='' name='phone' value='{{$arr->phone}}'></td></tr>
                      <tr><td>
                      Họ và tên
                    </td><td><input id='' name='fullname' value='{{$arr->fullname}}'></td></tr>
                      <tr><td>
                      Ngày sinh
                    </td><td><input type='date' id='' name='birth_day' value='{{$arr->birth_day}}'></td></tr>
                      <tr><td>
                      Giới tính
                    </td><td>
                      <select name='gender'>
                        <option value='1' @if ($arr->gender=='1') selected @endif>Nam</option>
                        <option value='0' @if ($arr->gender=='0') selected @endif>Nữ</option>
                        <option value='2' @if ($arr->gender=='2') selected @endif>Khác</option>
                      </select>
                    </td></tr>
                      <!-- <tr><td>
                      Điểm
                    </td><td><input id='' name='point' value='{{$arr->point}}'></td></tr> -->
                      <!-- <tr><td>
                      Mã xác nhận
                    </td><td><input id='' name='confirm_code' value='{{$arr->confirm_code}}'></td></tr> -->

                      <tr><td>
                      Ngày khởi tạo
                    </td><td>{{$arr->create_date}}</td></tr>

                      <tr><td>
                      Activate/Deactivate (1/0):
                    </td><td><input id='' name='status' value='{{$arr->status}}' required></td></tr>
                      <tr><td>
                      Số CMND
                    </td><td><input id='' name='cmnd' value='{{$arr->cmnd}}' required></td></tr>
                      <tr><td>
                      Địa chỉ nhà
                    </td><td><input id='' name='home_address' value='{{$arr->home_address}}' required></td></tr>
                      <tr><td>
                      Tên công ty
                    </td><td><input id='' name='company_name' value='{{$arr->company_name}}' required></td></tr>
                      <tr><td>
                      Địa chỉ công ty
                    </td><td><input id='' name='company_address' value='{{$arr->company_address}}' required></td></tr>
                      <tr><td>
                      Điểm đón
                    </td><td>
                      <select id='' name='from_place_id' required>
                        @foreach ($arr->places as $key=>$place)
                        <option value='{{$place->id}}'
                           @if ($arr->from_place_id == $place->id)
                            selected
                           @endif>{{$place->name}}</option>
                        @endforeach
                      </select>
                    </td></tr>
                      <tr><td>
                      Điểm trả
                    </td><td>
                      <select id='' name='to_place_id' required>
                        @foreach ($arr->places as $key=>$place)
                        <option value='{{$place->id}}'
                           @if ($arr->to_place_id == $place->id)
                            selected
                           @endif>{{$place->name}}</option>
                        @endforeach
                      </select>
                    </td></tr>

                      <tr><td>
                      Lịch làm việc
                    </td><td><input id='' name='schedule_work' value='{{$arr->schedule_work}}' required></td></tr>

                    @if ($arr->role=='Tài xế')
                    <tr><td>
                      Số chứng nhận phương tiện
                    </td><td><input id='' name='vehicle_number' value='{{$arr->vehicle_number}}' required></td></tr>
                      <tr><td>
                      Bằng lái xe
                    </td><td><input id='' name='driving_license' value='{{$arr->driving_license}}' required></td></tr>
                      <tr><td>
                      Bảo hiểm
                    </td><td><input id='' name='insurrance' value='{{$arr->insurrance}}' required></td></tr>
                    @endif
                    <input type='hidden' name='user_name' value='{{$arr->user_name}}'>
                    <input type='hidden' name='role' value='{{$arr->role}}'>
                    </tbody>
                  </table>
                  <p>@if ((Session::get('msg')) != null)
                  {{Session::get('msg')}}
                  @endif
                  </p>

                  <button type='submit' class="btn btn-primary">Save changes</button>
                  <a href="/delete?user_name={{$arr->user_name}}&role={{$arr->role}}" class="btn btn-primary" style='background-color:#DD5044'>Delete</a>
                </form>
                <table class="display" id="example" style="width:100%">
                   <thead>
                      <tr>
                         <th>Username</th>
                         <th>Fullname</th>
                         <th>From</th>
                         <th>To</th>
                         <th>Action</th>
                      </tr>
                   </thead>
                   <tbody>
                     @foreach($arr->suggestions as $key=>$suggestion)
                      <tr>
                         <td>{{$suggestion->user_name}}</td>
                         <td>{{$suggestion->fullname}}</td>
                         <td>{{$suggestion->from_place_id}}</td>
                         <td>{{$suggestion->to_place_id}}</td>
                         <td><a href='pair?p1={{$suggestion->user_name}}&p2={{$arr->user_name}}'>Pair</td></td>
                      </tr>
                     @endforeach
                   </tbody>
                </table>
                </div>
              </div>
            </div>

                 <!-- <div class="panel-footer">
                        <a data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>
                        <span class="pull-right">
                            <a href="edit.html" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                            <a data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                        </span>
                    </div> -->

          </div>
        </div>
      </div>
    </div>
  @endsection

    <script>
    $(document).ready(function() {
      var panels = $('.user-infos');
      var panelsButton = $('.dropdown-user');
      panels.hide();

      //Click dropdown
      panelsButton.click(function() {
          //get data-for attribute
          var dataFor = $(this).attr('data-for');
          var idFor = $(dataFor);

          //current button
          var currentButton = $(this);
          idFor.slideToggle(400, function() {
              //Completed slidetoggle
              if(idFor.is(':visible'))
              {
                  currentButton.html('<i class="glyphicon glyphicon-chevron-up text-muted"></i>');
              }
              else
              {
                  currentButton.html('<i class="glyphicon glyphicon-chevron-down text-muted"></i>');
              }
          })
      });


      $('[data-toggle="tooltip"]').tooltip();

      $('button').click(function(e) {
          e.preventDefault();
          alert("This is a demo.\n :-)");
      });
  });
    </script>
