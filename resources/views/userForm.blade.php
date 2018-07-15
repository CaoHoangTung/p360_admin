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
              <h3 class="panel-title">Add {{$arr['role']}}</h3>
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
                  <form method='post' action='/add/user'>
                    @csrf
                  <table class="table table-user-information">
                    <tbody>
                      <tr><td>
                      Số điện thoại
                    </td><td><input id='' name='user_name' placeholder='SĐT'></td></tr>
                      <tr><td>
                      Mật khẩu
                    </td><td><input type='password' id='' name='Mật khẩu' placeholder='password'></td></tr>

                      <tr><td>
                      Họ và tên
                    </td><td><input id='' name='fullname' placeholder='Họ và tên'></td></tr>

                    <input type='hidden' name='role' value='Người dùng'>
                    </tbody>
                  </table>
                  <p>@if ((Session::get('msg')) != null)
                  {{Session::get('msg')}}
                  @endif
                  </p>
                  <button type='submit' class="btn btn-primary">Add</button>
                  <!-- <a href="/delete?user_name=user_name" class="btn btn-primary" style='background-color:#DD5044'>Delete</a> -->
                </form>
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
