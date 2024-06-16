@extends('main')
@section('content')
<div class="container justify-content-center" style="width: 55%">
    <form action="/post-regis" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
        <div class="mb-3">
            <h5 style="text-align: center">Register</h5>
        </div>
        <div class="mb-3">
          <label for="exampleInputText" class="form-label">Username</label>
          <input type="text" class="form-control" id="exampleInputText" name="username">
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" class="form-control" name="password" id="exampleInputPassword1">
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Email</label>
          <input type="email" class="form-control" name="email" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
</div>
@endsection