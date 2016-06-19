<!doctype html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>RH Mini Finance</title>
        <meta name="description" content="RH Mini Finance"/>
        <meta name="author" content="RH Mini Finance"/>
        <meta name="copyright" content="RH Mini Finance"/>
        <link rel="stylesheet" href="<?php echo base_url("assests/css/foundation.css?ver=1"); ?>"/>
        <script src="<?php echo base_url("assests/js/jquery-1.9.1.js"); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url("assests/js/validate.js"); ?>"></script>
        <!-- bxSlider Javascript file -->
        <script src="<?php echo base_url("assests/js/jquery.bxslider.min.js?v=2"); ?>"></script>
        <!-- bxSlider CSS file -->
        <link href="<?php echo base_url("assests/css/jquery.bxslider.css?v=2"); ?>" rel="stylesheet" />
    </head>
    <body>

        <div class="row">
            <div class="large-3 columns">
                <h1><img src="<?php echo base_url("assests/images/logo.jpg"); ?>"></h1>
            </div>
            <div class="large-9 columns" style="height:75px;">
                <div style="margin-top: 25px;">
                    <form action="/home/verify_login" method="POST">
                        <input type='submit' tabindex="3" class="login_button" value='Login' >
                        <input type='password' tabindex="2" name='password' class="login_password"  placeholder='Password' >
                        <input type='text' tabindex="1" name='username' placeholder='User Name' class="login_username">
                        <br/>
                    </form>
                </div>
            </div><br/>
            <div style="float: right;margin-right: 17px;margin-bottom: 10px;">
                <a class="login_forgot" style="color:black;" href="#">Forgot password?</a>
            </div>
        </div>

        <div class="row">
            <div class="large-12 columns">
                <div class="bx-wrapper" style="max-width: 100%;">
                    <div class="bx-viewport" style="width: 100%; overflow: hidden; position: relative; height: 211px;">
                        <ul class="bxslider" style="margin-left: 0px; width: 515%; position: relative; -webkit-transition-duration: 0s; transition-duration: 0s; -webkit-transform: translate3d(-960px, 0px, 0px);"><li style="float: left; list-style: none; position: relative; width: 960px;" class="bx-clone">
                                <img src="http://localhost:8082/assests/images/houses.jpg?v=2"></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
         
        <div class="row" style="  margin-bottom: 50px;padding-left: 50px; padding-right: 50px;" >
            <h2 style="margin-top: -20px;">About Us</h2>
            <p>Your money is a huge part of your life. it can determine what you can do and where you can go. Learning how to manage your money the right way is an important step toward taking control of your life.</p>
            
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
            
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
            
        </div>

        <footer >
            <div class='container'>
                <div class='eight columns' style="margin-left: -88px;margin-top: 0px;">
                    <ul class='mainMenu' style="float: none;">
                        <li ><a style="color:white ;" href='#' title='Home'>Contact Us</a></li>
                    </ul>
                    <br/><br/>
                    <p style="margin-left: 11px;">RH Mini Finance @2015 , All Right Reserved.</p>
                </div>


                <div class='four columns social'>
                    <h5 style="color:white ;">Social media</h5>
                    <a href='#'><img src='<?php echo base_url("assests/images/social/dribbble.png"); ?>'></a>
                    <a href='#'><img src='<?php echo base_url("assests/images/social/facebook.png"); ?>'></a>
                    <a href='#'><img src='<?php echo base_url("assests/images/social/twitter.png"); ?>'></a>
                </div>
            </div>
        </footer>

        <script type="text/javascript">

            $(document).ready(function () {
                $('.bxslider').bxSlider({
                    auto: true
                });
            });
            var form = $('form');

            $(document).ready(function () {
                form.validate({
                    ignore: "",
                    rules: {
                        'username': {
                            required: true,
                        },
                        'password': {
                            required: true,
                        }
                    },
                    errorPlacement: function (error, element) {
                    }

                });
            });
        </script>
    </body>
</html>