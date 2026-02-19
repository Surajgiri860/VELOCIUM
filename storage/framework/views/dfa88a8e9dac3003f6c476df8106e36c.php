<!DOCTYPE html>
<html lang="en">
   <head>
      <title>User Login: VELOCIUM SYSTEM</title>
      <meta charset="UTF-8" />
      <link rel="icon" href="<?php echo e(asset('assets/img/logo.png')); ?>" type="image/x-icon" />
      <link rel="shortcut icon" href="<?php echo e(asset('assets/img/logo.png')); ?>" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <link rel="stylesheet" href="<?php echo e(asset('assets/logincss/bootstrap.min.css')); ?>" />
      <link rel="stylesheet" href="<?php echo e(asset('assets/logincss/font-awesome.min.css')); ?>" />
      <link rel="stylesheet" href="<?php echo e(asset('assets/logincss/login.css')); ?>" />
   </head>
   <body>
      <div class="login_form">
         <div class="container-fluid">
            <div class="row">
               <div class="col-lg-8 col-md-12 col-sm-12 login_bg">
                  <div class="side_logo">
                     <img src="<?php echo e(asset('assets/img/logo.png')); ?>">
                  </div>
               </div>
               
               <div class="col-lg-4 col-md-12 col-sm-12 login-right-bg">
                  <form method="POST" action="<?php echo e(route('admin.login')); ?>" class="login100-form">
                     <?php echo csrf_field(); ?>
                     <img src="<?php echo e(asset('assets/img/logo.png')); ?>" class="mobile-logo" style="height:90px;">
                     <span class="login100-form-title">User Login</span>
                     <p class="login-text">Please Enter your Username and Password to Sign in.</p>

                     <!-- Username input field -->
                     <div class="wrap-input100 validate-input">
                        <input name="email" value="<?php echo e(old('email')); ?>" type="text" class="input100" placeholder="Username" value="<?php echo e(old('loginId')); ?>" />
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                     </div>
                     <!-- Error message for loginId -->
                     <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="alert alert-danger"><?php echo e($message); ?></div>
                     <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                     <!-- Password input field -->
                     <div class="wrap-input100 validate-input">
                        <input name="password" value="<?php echo e(old('password')); ?>" type="password" class="input100" placeholder="Password" />
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                     </div>
                     <!-- Error message for password -->
                     <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="alert alert-danger"><?php echo e($message); ?></div>
                     <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

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

      <script src="<?php echo e(asset('assets/logincss/jquery-1.11.1.min.js')); ?>"></script>
      <script src="<?php echo e(asset('assets/logincss/bootstrap.min.js')); ?>"></script>
      <script src="<?php echo e(asset('assets/logincss/jquery-ui.js')); ?>"></script>
   </body>
</html>
<?php /**PATH C:\xampp\htdocs\VELOCIUM\resources\views/Admin/Login.blade.php ENDPATH**/ ?>