<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Gamehub Email</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        @font-face {
            font-family: gil-regular;
            src: url('{{ asset('email_font/gilroy-regular.ttf') }}');
        }
        table,
        td,
        p {
            font-family: gil-regular;
            font-size: 20px;
        }
    </style>
</head>

<body style="position: relative; min-height: 100vh;">

<!-- email -->
<table style="max-width: 600px; margin: 50px auto; border-collapse: collapse; border-spacing: 0; position: relative;">
    <thead>
    <tr>
        <td style="padding: 0;">
            <table style="border-collapse: collapse; border-spacing: 0;">
                <tr>
                    <td style="padding: 0;">
                        <a href="https://www.gamehub.com.bd"><img src="{{ asset('email_image/header.webp') }}" style="width: 100%;"></a>
                    </td>
                </tr>

            </table>
        </td>

    </tr>
    </thead>
    <tbody>
    <tr>
        <td>
            <table style="margin-top: 70px; width: 100%;">
                <thead>
                @yield('content')
                <tr>
                    <td style="padding-left: 80px; ">
                        <a href="https://www.gamehub.com.bd/games" style="display: block; margin-top: 40px; margin-bottom: 60px;"><img src="{{ asset('email_image/rent.png') }}" alt="rent"></a>
                    </td>
                </tr>
                <tr>
                    <td style="border-top: 1px solid rgba(196, 196, 196, 0.75); border-bottom: 1px solid rgba(196, 196, 196, 0.75); height:50px;">
                        <div style="text-align: center; width: fit-content; margin-left: auto; margin-right: auto; margin-top: 5px;">
                            <a href="https://www.facebook.com/gamehub.bangladesh" style="margin-right: 25px;"><img src="{{ asset('email_image/facebook.png') }}" alt="facebook"></a>
                            <a href="https://twitter.com/BdGamehub" style="margin-right: 25px;"><img src="{{ asset('email_image/twitter.png') }}" alt="twitter" style="height: 18px;"></a>
                            <a href="https://www.instagram.com/gamehub.bd" style="margin-right: 25px;"><img src="{{ asset('email_image/insta.png') }}" alt="insta"></a>
                            <a href="https://www.youtube.com/channel/UCEtVjE3POZd-DKXpjpjJ53g" style="margin-right: 25px;"><img src="{{ asset('email_image/youtube.png') }}" alt="youtube" style="height: 18px;"></a>
{{--                            <a href="#"><img src="{{ asset('email_image/book.png') }}" alt="book"></a>--}}

                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p style="max-width: 381px; margin-left: auto; margin-right: auto; margin-top: 40px; margin-bottom: 26px; text-align: center;"> You received this email because you are registered member or GameHub, Bangladesh.</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p style="max-width: 464px; margin-left: auto; margin-right: auto; margin-top: 40px; margin-bottom: 26px; text-align: center;"> For more information: 01823 3365415 | House: 941, Road: 14, Avenue: 2, Mirpur DOHS, Dhaka 1216</p>
                    </td>
                </tr>


                </thead>
            </table>
        </td>
    </tr>
    </tbody>

</table>


</body>

</html>
