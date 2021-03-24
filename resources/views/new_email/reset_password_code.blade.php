<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Gamehub Email</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body style="position: relative; min-height: 100vh; width: 80%;margin: auto;align-items: center; justify-content: space-between;">
    <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- email template -->
    <table class="main-table" width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <!-- header -->
        <tr>
            <td bgcolor="#0B0F18" height="80">
                <table class="col1" width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr>
                            <td align="center">
                                <a href="https://www.gamehub.com.bd" target="_blank"><img src="{{ asset('email_image/logo.png') }}" alt="logo" style="width: 20%;"></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <!-- gap -->
        <tr>
            <td height="40"></td>
        </tr>
        <!-- content -->
        <tr>
            <td>
                <table align="center" width="100%">
                    <tbody>
                        <tr>
                            <td align="center">
                                <h5>Dear concern, </h5>
                                <p>Your Password reset code is {{ $otp }}</p>
                            </td>
                        </tr>
                        <tr>
                            <td align="center">
                                <p>Thank you,<br/>Gamehub</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <!-- footer -->
        <!-- gap -->
        <tr>
            <td height="100"></td>
        </tr>
    </table>
    <div class="footer" style="position: absolute; bottom: 0; width: 100%; height: 80px; background: black;">
        <div style="display: flex;align-items: center; justify-content: space-between; width: 100%; margin: auto; color: white; height: 100%;">
            <div class="content" style="margin-left: 20px">
                <p> ©2021 Game Hub.</p>
            </div>
            <div class="content">
                <p> Powered By: Augnitive</p>
            </div>
            <div class="content" style="display: flex; align-items: center;margin-right: 20px">
                <a href="#" style="margin-right: 8px;"><img src="{{ asset('email_image/facebook.png') }}" alt="facebook"></a>
                <a href="#" style="margin-right: 8px;"><img src="{{ asset('email_image/twich.png') }}" alt="twich"></a>
                <a href="#" style="margin-right: 8px;"><img src="{{ asset('email_image/twitter.png') }}" alt="twitter"></a>
                <a href="#" style="margin-right: 8px;"><img src="{{ asset('email_image/instagram.png') }}" alt="instagram"></a>
                <a href="#" style="margin-right: 0px;"><img src="{{ asset('email_image/youtube.png') }}" alt="youtube"></a>
            </div>
        </div>
    </div>

</body>

</html>
