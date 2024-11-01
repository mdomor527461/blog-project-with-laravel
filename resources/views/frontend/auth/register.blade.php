@extends('layouts.master')

@section('content')

  <!--Login-->
  <section class="login">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-8 m-auto">
                <div class="login-content">
                    <h4>Sign up</h4>
                    <!--form-->
                    <form  class="sign-form widget-form" action="{{route('guest.register')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Username*" name="name" value="">
                            @error('name')
                                <p class="text-danger text-center">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email Address*" name="email" value="">
                            @error('email')
                                <p class="text-danger text-center">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password*" name="password" value="">
                            @error('password')
                                <p class="text-danger text-center">{{ $message }}</p>
                            @enderror
                        </div>
                        {{-- <div class="sign-controls form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="rememberMe">
                                <label class="custom-control-label" for="rememberMe">Agree to our <a href="#" class="btn-link">terms & conditions</a> </label>
                            </div>
                        </div> --}}
                        <div class="form-group">
                            <button type="submit" class="btn-custom">Sign Up</button>
                        </div>
                        <p class="form-group text-center">Already have an account? <a href="{{route('guest.login')}}" class="btn-link">Login</a> </p>
                    </form>
                       <!--/-->
                </div>
            </div>
         </div>
    </div>
</section>


@endsection
