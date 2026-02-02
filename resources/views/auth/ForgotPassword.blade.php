

<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from fts.in.net/User/ForgotPassword.aspx by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 04 Oct 2024 05:47:54 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head><title>
	Forgot Password: VELOCIUM SYSTEM
</title><meta charset="UTF-8" /><link rel="icon" href="https://fts.in.net/favicon.ico" type="image/x-icon" /><link rel="shortcut icon" href="https://fts.in.net/favicon.ico" /><meta name="viewport" content="width=device-width, initial-scale=1" /><link rel="stylesheet" href="logincss/bootstrap.min.css" /><link rel="stylesheet" href="logincss/font-awesome.min.css" /><link rel="stylesheet" href="logincss/login.css" /></head>
<body>
<div class="login_form">
<div class="container-fluid">
<div class="row">
<div class="col-lg-8 col-md-12 col-sm-12 login_bg">
<div class="side_logo swingimage">
<img src="LoginImages/logo.png" style="max-width: 140px;">
<p>www.skybiotechindia.com</p>
</div>
</div>
<div class="col-lg-4 col-md-12 col-sm-12 login-right-bg">
<form method="post" action="https://fts.in.net/User/ForgotPassword.aspx" id="form1" class="login100-form">
<div class="aspNetHidden">
<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="n8EzLy3nnoeutiuaR5+Vdx6507FQzM82if5kx1rPx+oB/1DQBEnJMVPhFSWbZjlQd3TJ7Zvn3mXACcrRVPrSnqlT16iWfueSULv54+DvLL8=" />
</div>
<div class="aspNetHidden">
<input type="hidden" name="__VIEWSTATEGENERATOR" id="__VIEWSTATEGENERATOR" value="4A878D42" />
<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="59Ckb68mlwPadnzHWJkPpS/7WyJNSnv8MjE2Ip9TdwvWkQKGaxORBTB34j0JfrkfDxnwcQDAaK+sRf0e5eDL/ngE8/kVTooA4yGBKlB+meADohRkQxuaz/MJIOIj5msyDjsYtwGWBFkoR4Qgoi81Zw==" />
</div>
<img src="LoginImages/logo.png" class="mobile-logo" style="height: 60px;">
<span class="login100-form-title">Recover Your Password
</span>
<div id="divAdd">
<p>Please Enter Your Login ID.</p>
<div class="wrap-input100 validate-input">
<input name="txtEmailID" type="text" id="txtEmailID" class="input100" placeholder="Login ID" />
<span class="focus-input100"></span>
<span class="symbol-input100">
<i class="fa fa-user" aria-hidden="true"></i>
</span>
</div>
<div class="clearfix"></div>
<div class="clearfix"></div>
<div class="alert-danger" id="validLoginID" style="display: none;">
&nbsp; Enter Login ID!
</div>
<div class="alert-danger" id="validPwd" style="display: none;">
&nbsp; Enter OTP!
</div>
<div class="container-login100-form-btn">
<input type="submit" name="btnLogin" value="Send Password" onclick="return ValidateLogin();" id="btnLogin" class="login100-form-btn" />
</div>
<div class="text-center p-t-12">
<span class="txt1">go to
</span>
<a class="txt2" href="Login.html">Login</a>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
<script src="js/jquery-1.11.1.min.html"></script>
<script src="js/bootstrap.min.html"></script>
<script type="text/javascript">
        function ValidateLogin() {
            var status = 1;
            if ($("#txtEmailID").val() == "") {
                $("#validLoginID").show();
                status = 0;
            }
            else {
                $("#validLoginID").hide();
            }


            if (status == 0) {
                return false;
            }
            else {
                return true;
            }
        }
        function ValidateOTP() {
            var status = 1;
            if ($("#txtPassword").val() == "") {
                $("#validPwd").show();
                status = 0;
            }
            else {
                $("#validPwd").hide();
            }


            if (status == 0) {
                return false;
            }
            else {
                return true;
            }
        }
    </script>
</body>

<!-- Mirrored from fts.in.net/User/ForgotPassword.aspx by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 04 Oct 2024 05:47:56 GMT -->
</html>
