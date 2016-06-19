<div class="row static_banner" >
    <img src="<?php echo base_url("assests/images/dummy_banner.jpg?v=2"); ?>">
</div>
</div>

<div class="row passord_section" style="margin-bottom: 50px;padding-left: 50px; padding-right: 50px;" >
    <h2 style="margin-top: 10px;">Forgot Password</h2>

    <div >
        <p>Enter your Mobile number and we will send you a password.</p>
        <form class="basic_form"  style="  margin-left: 16px;"  id="forgot_password_form" action="/home/forgot_password" method="post">       
            <div class="row clearfix">
                <label for="email" class="required">Mobile  Number<span class="required">*</span></label>                            <div>
                    <input name="mobile_number" id="mobile_number" type="text">                                <div class="errorMessage" id="ContactForm_name_em_" style="display:none"></div>                            </div>
            </div>

            <div class="row clearfix">
                <label >&nbsp;</label><div style="  float: left;">
                    <input type='submit' id='forgot_password_button' tabindex="3" class="login_button" value='Login' >  
                </div><br/><br/>
                <div class="errorMessage" id="ContactForm_message_em_" ><?php
                    if($this->session->flashdata()){
  $message = $this->session->flashdata('forgot_password');
  ?>
<div style="float: left; margin-left: 207px;" class="<?php echo $message['class'] ?>"><?php echo $message['message']; ?></div>
<?php
}
?></div>                            
            </div>


        </form>                    </div>
</div>

<script type="text/javascript">
        $(document).ready(function () {
            
            $("#forgot_password_button").click(function(){
                $("#forgot_password_form").validate({
                    ignore: "",
                    rules: {
                        'mobile_number': {
                            required: true,
                            number: true
                        }
                    },
                    errorPlacement: function (error, element) {
                    }

                });
               });

            
        });
    </script>
    <style>
          .passord_section .session_success {
                color: green;
            }
            .passord_section .session_error{
                color: red;
            }
        </style>