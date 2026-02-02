<!DOCTYPE html>
<html lang="en">
   <head>
      <title>User Login: VELOCIUM SYSTEM</title>
      <meta charset="UTF-8" />
      <link rel="icon" href="{{ asset('assets/img/logo.png')}}" type="image/x-icon" />
      <link rel="shortcut icon" href="{{ asset('assets/img/logo.png')}}" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <link rel="stylesheet" href="{{ asset('assets/logincss/bootstrap.min.css')}}" />
      <link rel="stylesheet" href="{{ asset('assets/logincss/font-awesome.min.css')}}" />
      <link rel="stylesheet" href="{{ asset('assets/logincss/login.css')}}" />
   </head>
   <body>
      <div class="login_form">
         <div class="container-fluid">
            <div class="row">
               <div class="col-lg-8 col-md-12 col-sm-12 login_bg">
                  <div class="side_logo">
                     <img src="{{ asset('assets/img/logo.png')}}">
                  </div>
               </div>
               {{-- <div class="card-header">{{ __('Login') }}</div> --}}
               <div class="col-lg-4 col-md-12 col-sm-12 login-right-bg">
                  <form method="POST" action="{{ route('admin.login') }}" class="login100-form">
                     @csrf
                     <img src="{{ asset('assets/img/logo.png')}}" class="mobile-logo" style="height:90px;">
                     <span class="login100-form-title">User Login</span>
                     <p class="login-text">Please Enter your Username and Password to Sign in.</p>

                     <!-- Username input field -->
                     <div class="wrap-input100 validate-input">
                        <input name="email" value="{{ old('email') }}" type="text" class="input100" placeholder="Username" value="{{ old('loginId') }}" />
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                     </div>
                     <!-- Error message for loginId -->
                     @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                     @enderror

                     <!-- Password input field -->
                     <div class="wrap-input100 validate-input">
                        <input name="password" value="{{ old('password') }}" type="password" class="input100" placeholder="Password" />
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                     </div>
                     <!-- Error message for password -->
                     @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                     @enderror

                     <!-- Submit button -->
                     <div class="container-login100-form-btn">
                        <input type="submit" name="btnLogin" value="Login" class="login100-form-btn" />
                       
                     </div>

                     <!-- Links for sign-up and forgot password -->
                    
                  </form>
               </div>
            </div>
         </div>
      </div>

      <script src="{{ asset('assets/logincss/jquery-1.11.1.min.js') }}"></script>
      <script src="{{ asset('assets/logincss/bootstrap.min.js') }}"></script>
      <script src="{{ asset('assets/logincss/jquery-ui.js') }}"></script>
   </body>
</html>
