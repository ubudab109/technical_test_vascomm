@extends('layouts.main')
@section('content')
<div class="row justify-content-center mt-5">
  <div class="card">
    <div class="card-header">
      <h3>Login Here</h3>
    </div>
    <div class="card-body">
      <form action="{{route('login')}}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Email address</label>
          <input type="email" name="email" value="{{old('email')}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
          <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" value="{{old('password')}}" name="password" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="mb-3 form-check">
          <input type="checkbox" class="form-check-input" name="remember" id="exampleCheck1">
          <label class="form-check-label" for="exampleCheck1">Remember Me</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>

      <div class="d-flex flex-wrap mt-2">
        <a href="{{route('register.view')}}">Don't Have Account? Register Here</a>
      </div>
    </div>
  </div>
</div>
@endsection