<!DOCTYPE html>
<html lang="en">
   <head>
      <title>New Registration: Velocium System</title>
      <meta charset="UTF-8" />
      <link rel="icon" href="{{ asset('assets/img/logo.png') }}" type="image/x-icon" />
      <link rel="shortcut icon" href="{{ asset('assets/img/logo.png') }}" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <!-- Stylesheets -->
      <link href="{{ asset('assets/logincss/jquery-ui.css') }}" rel="stylesheet" />
      <link rel="stylesheet" href="{{ asset('assets/logincss/bootstrap.min.css') }}" />
      <link rel="stylesheet" href="{{ asset('assets/logincss/font-awesome.min.css') }}" />
      <link rel="stylesheet" href="{{ asset('assets/logincss/register.css') }}" />
   </head>
   <body>
      <!-- Loader and Alert Divs -->
      <div id="divloader" class="progressdiv" style="z-index: 9999999; display: none;"></div>
      <div class="otherdiv" id="otherdiv"></div>

      <!-- Alert for Registration Success -->
<div class="divalert" id="divalert" style="z-index: 9999999; display: none;">
   <a class="divalert-close" onclick="closealert();"><img src="{{ asset('assets/img/cancel.png') }}"></a>
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
                     <img src="{{ asset('assets/img/logo.png') }}" style="width:150px;">
                  </div>
               </div>

               <!-- Right Side Form Section -->
               <div class="col-lg-6 col-md-12 col-sm-12 login-right-bg">
                  <form action="{{ route('register') }}" method="POST" class="login100-form">
                     @csrf
                     <img src="{{ asset('assets/img/logo.png') }}" class="mobile-logo" style="height: 90px;">
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
                                       <input type="text" id="sponsor" name="referal_by" value="{{ old('referal_by') }}" class="form-control" maxlength="50" required />
                                       @error('referal_by')
                                       <div class="text-danger">{{ $message }}</div>
                                       @enderror
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
                                          <option value="Mr." {{ old('prefix') == 'Mr.' ? 'selected' : '' }}>Mr</option>
                                          <option value="Ms." {{ old('prefix') == 'Ms.' ? 'selected' : '' }}>Ms</option>
                                          <option value="Miss." {{ old('prefix') == 'Miss.' ? 'selected' : '' }}>Miss</option>
                                          <option value="Dr." {{ old('prefix') == 'Dr.' ? 'selected' : '' }}>Dr</option>
                                          <option value="Prof." {{ old('prefix') == 'Prof.' ? 'selected' : '' }}>Prof</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col-xs-4 col-sm-4 col-lg-10">
                                    <div class="ctrl">
                                       <label>Your Full Name: *</label>
                                       <input type="text" name="name" value="{{ old('name') }}" required class="form-control" maxlength="50" />
                                       @error('name')
                                       <div class="text-danger">{{ $message }}</div>
                                       @enderror
                                    </div>
                                 </div>

                                 <!-- Password Fields -->
                                 <div class="col-xs-12 col-sm-6 col-lg-6">
                                    <div class="ctrl">
                                       <label>Password: *</label>
                                       <input type="password" name="password" required class="form-control" maxlength="20" />
                                       @error('password')
                                       <div class="text-danger">{{ $message }}</div>
                                       @enderror
                                    </div>
                                 </div>
                                 <div class="col-xs-12 col-sm-6 col-lg-6">
                                    <div class="ctrl">
                                       <label>Confirm Password: *</label>
                                       <input type="password" name="password_confirmation" required class="form-control" maxlength="20" />
                                       @error('password_confirmation')
                                       <div class="text-danger">{{ $message }}</div>
                                       @enderror
                                    </div>
                                 </div>

                                 <!-- Email and Mobile -->
                                 <div class="col-md-6">
                                    <div class="ctrl">
                                       <label>Email: *</label>
                                       <input type="email" name="email" value="{{ old('email') }}" required class="form-control" maxlength="50" />
                                       @error('email')
                                       <div class="text-danger">{{ $message }}</div>
                                       @enderror
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="ctrl">
                                       <label>Mobile No.: *</label>
                                       <input type="text" name="phone" value="{{ old('phone') }}" required class="form-control" maxlength="10" />
                                       @error('phone')
                                       <div class="text-danger">{{ $message }}</div>
                                       @enderror
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
                           <a class="reg100-form-btn" href="{{ route('login') }}">Login</a>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>

      <!-- JavaScript and jQuery -->
      <script src="{{ asset('assets/logincss/jquery-1.11.1.min.js') }}"></script>
      <script src="{{ asset('assets/logincss/bootstrap.min.js') }}"></script>
      <script src="{{ asset('assets/logincss/jquery-ui.js') }}"></script>

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
       @if(session('username') && session('loginId') && session('password'))
           // Set the username, login ID, and password in the popup
           document.getElementById('username').textContent = "{{ session('username') }}";
           document.getElementById('loginId').textContent = "{{ session('loginId') }}";
           document.getElementById('password').textContent = "{{ session('password') }}";

           // Show the alert popup
           document.getElementById('divalert').style.display = 'block';
       @endif
   });

   // Function to close the alert popup
   function closealert() {
       document.getElementById('divalert').style.display = 'none';

       // Call backend to clear session data
       fetch("{{ route('clear.session') }}", {
           method: "POST",
           headers: {
               'X-CSRF-TOKEN': '{{ csrf_token() }}',
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
</script>