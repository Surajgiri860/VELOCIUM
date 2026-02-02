<!DOCTYPE html>
<html lang="en">
   <head>
      <title>New Registration: Velocium System</title>
      <meta charset="UTF-8" />
      <link rel="icon" href="<?php echo e(asset('assets/img/logo.png')); ?>" type="image/x-icon" />
      <link rel="shortcut icon" href="<?php echo e(asset('assets/img/logo.png')); ?>" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <!-- Stylesheets -->
      <link href="<?php echo e(asset('assets/logincss/jquery-ui.css')); ?>" rel="stylesheet" />
      <link rel="stylesheet" href="<?php echo e(asset('assets/logincss/bootstrap.min.css')); ?>" />
      <link rel="stylesheet" href="<?php echo e(asset('assets/logincss/font-awesome.min.css')); ?>" />
      <link rel="stylesheet" href="<?php echo e(asset('assets/logincss/register.css')); ?>" />
   </head>
   <body>
      <!-- Loader and Alert Divs -->
      <div id="divloader" class="progressdiv" style="z-index: 9999999; display: none;"></div>
      <div class="otherdiv" id="otherdiv"></div>

      <!-- Alert for Registration Success -->
<div class="divalert" id="divalert" style="z-index: 9999999; display: none;">
   <a class="divalert-close" onclick="closealert();"><img src="<?php echo e(asset('assets/img/cancel.png')); ?>"></a>
   <div class="clear"></div>
   <div class="divalert-text" id="alerttext">
      Dear <span id="username"></span>,<br>You have registered successfully.<br><br>
      Your Login ID is: <span id="loginId"></span><br>
      Password: <span id="password"></span>
   </div>
   <div class="divalert-bottom">
      <input type="button" value="OK" onclick="closealert();" class="divalert-ok">
   </div>
</div>

      <div id="divalertback" class="otherdiv" style="z-index: 999999; display: none;" onclick="closealert();"></div>

      <!-- Registration Form -->
      <div class="login_form">
         <div class="container-fluid">
            <div class="row">
               <!-- Left Side Logo Section -->
               <div class="col-lg-6 col-md-12 col-sm-12 login_bg">
                  <div class="side_logo swingimage">
                     <img src="<?php echo e(asset('assets/img/logo.png')); ?>" style="width:150px;">
                  </div>
               </div>

               <!-- Right Side Form Section -->
               <div class="col-lg-6 col-md-12 col-sm-12 login-right-bg">
                  <form action="<?php echo e(route('register')); ?>" method="POST" class="login100-form">
                     <?php echo csrf_field(); ?>
                     <img src="<?php echo e(asset('assets/img/logo.png')); ?>" class="mobile-logo" style="height: 90px;">
                     <span class="login100-form-title">Sign Up</span>
                     <p class="login-text">Fields marked as star (*) are required</p>

                     <div class="row">
                        <!-- Sponsor Detail Section -->
                        <div class="col-md-12">
                           <fieldset>
                              <legend>Sponsor Detail</legend>
                              <div class="row">
                                 <div class="col-sm-6">
                                    <div class="ctrl">
                                       <label>Sponsor ID: *</label>
                                       <input type="text" id="sponsor" name="referal_by" value="<?php echo e(old('referal_by')); ?>" class="form-control" maxlength="50" required />
                                       <?php $__errorArgs = ['referal_by'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                       <div class="text-danger"><?php echo e($message); ?></div>
                                       <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                 </div>
                                 <div class="col-sm-6">
                                    <div class="ctrl">
                                       <label>Sponsor Name:</label>
                                       <input type="text" id="txtSponsorName" class="form-control" readonly />
                                    </div>
                                 </div>
                              </div>
                           </fieldset>
                        </div>

                        <!-- Personal Detail Section -->
                        <div class="col-md-12">
                           <fieldset>
                              <legend>Personal Detail</legend>
                              <div class="row">
                                 <div class="col-xs-4 col-sm-4 col-lg-2">
                                    <div class="ctrl">
                                       <label>Prefix: *</label>
                                       <select id="dropPrefix" name="prefix" class="form-control" required>
                                          <option value="Mr." <?php echo e(old('prefix') == 'Mr.' ? 'selected' : ''); ?>>Mr</option>
                                          <option value="Ms." <?php echo e(old('prefix') == 'Ms.' ? 'selected' : ''); ?>>Ms</option>
                                          <option value="Miss." <?php echo e(old('prefix') == 'Miss.' ? 'selected' : ''); ?>>Miss</option>
                                          <option value="Dr." <?php echo e(old('prefix') == 'Dr.' ? 'selected' : ''); ?>>Dr</option>
                                          <option value="Prof." <?php echo e(old('prefix') == 'Prof.' ? 'selected' : ''); ?>>Prof</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col-xs-4 col-sm-4 col-lg-10">
                                    <div class="ctrl">
                                       <label>Your Full Name: *</label>
                                       <input type="text" name="name" value="<?php echo e(old('name')); ?>" required class="form-control" maxlength="50" />
                                       <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                       <div class="text-danger"><?php echo e($message); ?></div>
                                       <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                 </div>

                                 <!-- Password Fields -->
                                 <div class="col-xs-12 col-sm-6 col-lg-6">
                                    <div class="ctrl">
                                       <label>Password: *</label>
                                       <input type="password" name="password" required class="form-control" maxlength="20" />
                                       <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                       <div class="text-danger"><?php echo e($message); ?></div>
                                       <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                 </div>
                                 <div class="col-xs-12 col-sm-6 col-lg-6">
                                    <div class="ctrl">
                                       <label>Confirm Password: *</label>
                                       <input type="password" name="password_confirmation" required class="form-control" maxlength="20" />
                                       <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                       <div class="text-danger"><?php echo e($message); ?></div>
                                       <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                 </div>

                                 <!-- Email and Mobile -->
                                 <div class="col-md-6">
                                    <div class="ctrl">
                                       <label>Email: *</label>
                                       <input type="email" name="email" value="<?php echo e(old('email')); ?>" required class="form-control" maxlength="50" />
                                       <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                       <div class="text-danger"><?php echo e($message); ?></div>
                                       <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="ctrl">
                                       <label>Mobile No.: *</label>
                                       <input type="text" name="phone" value="<?php echo e(old('phone')); ?>" required class="form-control" maxlength="10" />
                                       <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                       <div class="text-danger"><?php echo e($message); ?></div>
                                       <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                 </div>
                              </div>
                           </fieldset>
                        </div>

                        <!-- Submit Button -->
                        <div class="col-md-12">
                           <div class="ctrl text-center">
                              <input type="submit" class="login100-form-btn full" value="Sign Up" />
                           </div>
                        </div>

                        <!-- Already Registered Section -->
                        <div class="text-center p-t-12">
                           <span class="txt1">Already have an account?</span>
                           <a class="reg100-form-btn" href="<?php echo e(route('login')); ?>">Login</a>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>

      <!-- JavaScript and jQuery -->
      <script src="<?php echo e(asset('assets/logincss/jquery-1.11.1.min.js')); ?>"></script>
      <script src="<?php echo e(asset('assets/logincss/bootstrap.min.js')); ?>"></script>
      <script src="<?php echo e(asset('assets/logincss/jquery-ui.js')); ?>"></script>

      <!-- Sponsor Autofill and AJAX Script -->
      <script>
         document.addEventListener('DOMContentLoaded', function() {
             const referralCode = new URLSearchParams(window.location.search).get('referral');
             if (referralCode) {
                 document.getElementById('sponsor').value = referralCode;
                 fetchSponsorName(referralCode);
             }

             document.getElementById('sponsor').addEventListener('input', function() {
                 fetchSponsorName(this.value);
             });

             function fetchSponsorName(sponsorId) {
                 if (sponsorId) {
                     $.ajax({
                         url: '/get-sponsor-name', // Your API route to get sponsor details
                         method: 'GET',
                         data: { referal_by: sponsorId },
                         success: function(response) {
                             document.getElementById('txtSponsorName').value = response.name || '';
                         },
                         error: function() {
                             document.getElementById('txtSponsorName').value = '';
                         }
                     });
                 } else {
                     document.getElementById('txtSponsorName').value = '';
                 }
             }
         });
      </script>
   </body>
</html>
<script>
   document.addEventListener('DOMContentLoaded', function() {
       // Check if user details exist in the session
       <?php if(session('username') && session('loginId') && session('password')): ?>
           // Set the username, login ID, and password in the popup
           document.getElementById('username').textContent = "<?php echo e(session('username')); ?>";
           document.getElementById('loginId').textContent = "<?php echo e(session('loginId')); ?>";
           document.getElementById('password').textContent = "<?php echo e(session('password')); ?>";

           // Show the alert popup
           document.getElementById('divalert').style.display = 'block';
       <?php endif; ?>
   });

   // Function to close the alert popup
   function closealert() {
       document.getElementById('divalert').style.display = 'none';

       // Call backend to clear session data
       fetch("<?php echo e(route('clear.session')); ?>", {
           method: "POST",
           headers: {
               'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
               'Content-Type': 'application/json'
           }
       }).then(response => response.json()).then(data => {
           if (data.status === 'success') {
               console.log("Session data cleared");
           }
       }).catch(error => {
           console.error("Error clearing session:", error);
       });
   }
</script><?php /**PATH C:\xampp\htdocs\VELOCIUM\resources\views/auth/Register.blade.php ENDPATH**/ ?>