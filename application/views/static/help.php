<div class="row static_banner" >
    <img src="<?php echo base_url("assests/images/dummy_banner.jpg?v=2"); ?>">
</div>

<div class="row" style="margin-bottom: 50px;padding-left: 50px; padding-right: 50px;" >
    <h2 style="margin-top: 10px;">Help</h2>

    <div >
        <p>Please fill up the form and we will contact you shortly</p>
        <form class="basic_form"  style="  margin-left: 16px;" onsubmit="return false;" id="contact-form" action="/contact" method="post">       
            <div class="row clearfix">
                <label for="name" class="required">Full Name <span class="required">*</span></label>                            <div>
                    <input name="name" id="name" type="text">                                <div class="errorMessage" id="ContactForm_name_em_" style="display:none"></div>                            </div>
            </div>
            <div class="row clearfix">
                <label for="number" class="required">Mobile Number <span class="required">*</span></label>                            <div>
                    <input name="number" id="number" type="text">                                <div class="errorMessage" id="ContactForm_email_em_" style="display:none"></div>                            </div>
            </div>
            <div class="row clearfix">
                <label for="email" class="required">Email <span class="required">*</span></label>                            <div>
                    <input name="email" id="email" type="text">                                <div class="errorMessage" id="ContactForm_email_em_" style="display:none"></div>                            </div>
            </div>
            <div class="row clearfix" style="  height: 210px;">
                <label for="question" class="required">Your Question  <span class="required">*</span></label>                            <div>
                    <textarea cols="50" rows="10" name="question" id="question"></textarea>                                <div class="errorMessage" id="ContactForm_message_em_" style="display:none"></div>                            </div>
            </div>

            <div class="row clearfix">
                <label >&nbsp;</label><div>
                    <button id='help_submit_button' type="submit" style="background-color: #E43591 !important;">Submit</button>                                <div class="errorMessage" id="ContactForm_message_em_" style="display:none"></div>                            </div>
            </div>


        </form>                    </div>
</div>


<script type="text/javascript">
    var form = $('form');

    $(document).ready(function () {

        $("#help_submit_button").click(function () {
            $("#contact-form").validate({
                ignore: "",
                rules: {
                    'name': {
                        required: true,
                    },
                    'email': {
                        required: true,
                    },
                    'number': {
                        required: true,
                    },
                    'question': {
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