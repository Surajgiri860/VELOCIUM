<!-- resources/views/emails/sendemail.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your OTP Code</title>
    <style>
        /* CSS styling goes here */
        body { background-color: #f0f2f3; margin: 0; }
        .email-container { margin: auto; max-width: 600px; padding-top: 50px; }
        #logoContainer { background: #252f3d; padding: 20px 0; text-align: center; }
        #emailBodyContainer { background: #fff; padding: 25px 35px; color: #444; }
        .verification-code { font-weight: bold; padding-bottom: 15px; }
        .code { color: #000; font-size: 36px; font-weight: bold; padding-bottom: 15px; }
        .expiration { color: #444; font-size: 10px; }
    </style>
</head>
<body>
    <div class="email-container">
        <div id="logoContainer">
            <img src="http://13.60.77.89/p2pmobile/public/assets/images/logo.png" width="75" height="45" alt="Logo">
        </div>
        <div id="emailBodyContainer">
            <h1>Your OTP Code</h1>
            <p class="verification-code">Verification code</p>
            <p class="code">{{ $otp }}</p>
            <p class="expiration">(This code will expire 10 minutes after it was sent.)</p>
            <p>Your email {{ $email }} has been successfully verified. Please check your inbox regularly for updates and important notifications.</p>
        </div>
    </div>
</body>
</html>
