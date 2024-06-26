@extends('main')
@section('content')
@if($sukses = Session::get('sukses'))
<div class="alert alert-success alert-block">
  <button type="button" class="close" data-dismiss="alert">×</button> 
  <h5 class="alert-heading">{{ $sukses }}</h5>
</div>
@endif
@if($error = Session::get('error'))
<div class="alert alert-danger alert-block">
  <button type="button" class="close" data-dismiss="alert">×</button> 
  <h5 class="alert-heading">{{ $error }}</h5>
</div>
@endif
<div class="container justify-content-center" style="width: 55%">
    <form action="/post-login" method="post">
      @csrf
        <div class="mb-3">
            <h5 style="text-align: center">Login</h5>
        </div>
        <div class="mb-3">
          <label for="exampleInputText" class="form-label">Username</label>
          <input type="text" class="form-control" id="exampleInputText" name="username">
          <div id="textHelp" class="form-text">if you don't have account klik <a href="/register"> Here</a></div>
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
</div>
@endsection