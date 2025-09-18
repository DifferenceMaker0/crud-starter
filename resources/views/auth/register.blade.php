@extends('auth.sso')

@section('content')  
<div> 
<div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>

@if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

      <form action="{{ route('register.store') }}" method="POST">
        @csrf

        <div class="input-group mb-3">

          <input name="name" type="text" class="form-control" placeholder="Enter Your Screen Name">


          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">

          <input name="email" type="email" class="form-control" placeholder="Email">


          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">

          <input name="password" type="password" class="form-control" placeholder="Password">


          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">

          <input name="password_confirmation" type="password" class="form-control" placeholder="Retype password">


          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              
              {{-- <input name="agree_terms" type="checkbox" id="agreeTerms" value="agree">
              <label for="agree_terms">
               I agree to the <a href="#">terms</a>
              </label> --}}


            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">

            <button type="submit" class="btn btn-primary btn-block">Register</button>


          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i>
          Sign up using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i>
          Sign up using Google+
        </a>
      </div>

      <a href="{{ route('login') }}" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
@endsection