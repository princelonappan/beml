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
                <h1><a href="/"><img class="logo_image" src="<?php echo base_url("assests/images/medium_logo.png"); ?>"></a></h1>
            </div>
            <div class="large-9 columns" style="height:75px;">
                <div style="margin-top: 25px;">
                     <form action="/home/verify_login" method="POST" id='login_form'>
                        <input type='submit' id='login_button' tabindex="3" class="login_button" value='Login' >
                        <input type='password' tabindex="2" name='password' class="login_password"  placeholder='Password' >
                        <input type='text' tabindex="1" name='username' placeholder='User Name' class="login_username">
                        <br/>
                    </form>
                </div>
            </div><br/>
            <div style="float: right;margin-right: 17px;margin-bottom: 10px;">
                            <a class="login_forgot" style="color:black;text-decoration: underline;" href="/forgot_password">Forgot password?</a>
                                </div>
        </div>

        <div class="row">
            <div class="large-12 columns" >
                <ul class="bxslider" style="margin-left: 0px;height: 350px;">
                    <li><img src="<?php echo base_url("assests/images/banner_1.jpg?v=2"); ?>"></li>
                    <!--<li><img src="<?php echo base_url("assests/images/banner_2.jpg?v=2"); ?>" /></li>-->
                    <li><img src="<?php echo base_url("assests/images/banner_3.jpg?v=2"); ?>" /></li>
                </ul>
            </div>
        </div>

        <div class="row" style="  margin-bottom: 50px;" >
            	<div class="span3" style="float:left;">
                	<div class="service-wrap">
                    	<div class="wrap-icon">
                            <img alt="" src="<?php echo base_url("assests/images/icon1.png"); ?>">
                        </div>
                        <h2>About Us</h2>
                        <p>Nunc sit amet nisl ut ipsum auctor placerat ut at turpis. Phasellus gravida volutpat velit, a tempus neque consequat vel.</p>
                        <a href="/about_us" class="learn_more">Learn More</a>
                    </div>
                </div>
                <div class="span3"  style="float:left;">
                	<div class="service-wrap">
                    	<div class="wrap-icon">
                            <img alt="" src="<?php echo base_url("assests/images/icon2.png"); ?>">
                        </div>
                        <h2>Service</h2>
                        <p>Nunc sit amet nisl ut ipsum auctor placerat ut at turpis. Phasellus gravida volutpat velit, a tempus neque consequat vel.</p>
                     <a href="/service"  class="learn_more">Learn More</a></div>
                </div>
                <div class="span3"  style="float:left;">
                	<div class="service-wrap">
                    	<div class="wrap-icon">
                            <img alt="" src="<?php echo base_url("assests/images/icon3.png"); ?>">
                        </div>
                        <h2>Help</h2>
                        <p>Nunc sit amet nisl ut ipsum auctor placerat ut at turpis. Phasellus gravida volutpat velit, a tempus neque consequat vel.</p>
                      <a href="/help" class="learn_more">Learn More</a></div>
                </div>                
                 
            </div>
         <footer >
		<div class='container'>
			
			<div class='eight columns' style="margin-left: -88px;margin-top: 0px;">
					<ul class='mainMenu' style="float: none;">
						<li ><a style="color:white ;text-decoration: underline;" href="/contact_us" title='Home'>Contact Us</a></li>
						</ul>
                            <br/><br/>
                            <p style="margin-left: 11px;">RH Mini Finance @2015 , All Right Reserved.</p>
			</div>
                    

			<div class='four columns social'>
				<h5 style="color:white ;">Social media</h5>
				
				<a href='https://www.facebook.com/rakesh.hethur'><img src='<?php echo base_url("assests/images/social/facebook.png"); ?>'></a>
				<a href='https://twitter.com/rhminifinance'><img src='<?php echo base_url("assests/images/social/twitter.png"); ?>'></a>
				
			</div>
	</footer>
        
    
<script type="text/javascript">	
    
    $(document).ready(function(){
    $('.bxslider').bxSlider({
        auto: true
  });
  $("#login_button").click(function(){
                $("#login_form").validate({
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
});
		    
	</script>
    </body>
</html>