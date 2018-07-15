@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Set up Google Authenticator</div>

                <div class="card-body" style="text-align: center;">
                    <p>Set up your two factor authentication by scanning the barcode below. Alternatively, you can use the code {{ $secret }}</p>
                    <div>
                        <img src="{{ $QR_Image }}">
                    </div>
                    <p>You must set up your Google Authenticator app before continuing. You will be unable to login otherwise</p>
                    <div>
                      <form method='post' action='{{route('insert_2fa_key')}}'>
                        @csrf
                        <input name='id' type='hidden' value='{{$id}}'>
                        <input name='email' type='hidden' value='{{$email}}'>
                        <input name='qr' type='hidden' value='{{$QR_Image}}'>
                        <input name='secret' type='hidden' value='{{$secret}}'>
                        <input name='one-time-password' placeholder='Confirm'>
                        <button class="btn-primary">Confirm</button>
                      </form>
                      <p style='color:red'>{{$err}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
