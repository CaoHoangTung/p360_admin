@extends('settings')

@section('settings-pane')

<form method="POST" action = "{{ route('change_name') }}" id='changename-form'>
  @csrf
  <label for='name'>Your name:</label>
  <input id='name' name='name' class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"  value='{{$name}}' required autofocus>
  <input name='id' value={{$id}} type='hidden'>
  <p style='color:red'>
    @if (\Session::has('msg'))
      {!! \Session::get('msg') !!}
    @endif
  </p>
  <button type="submit" class="btn btn-primary">
      {{ __('Save change') }}
  </button>
</form>
@endsection
