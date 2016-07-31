

<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="icon-home home-icon"></i>
                <a href="index.html">Home</a>

                <span class="divider">
                    <i class="icon-angle-right arrow-icon"></i>
                </span>
            </li>
            <li class="active">Employee</li>
        </ul><!--.breadcrumb-->
    </div>

    <div class="page-content">
        <div class="page-header position-relative">
            <h1>
                Employee
            </h1>
        </div><!--/.page-header-->

        <div class="row-fluid">
            <div class="span12">
                <!--PAGE CONTENT BEGINS-->
                
                <form class="form-horizontal style-form" id="validation-form" method="POST" action="<?php echo $this->config->base_url(); ?>user/save_details" enctype="multipart/form-data">
                                        <div class="step-content row-fluid position-relative" id="step-container">
                                            <div class="alert ">
                                             <?php $message = $this->session->flashdata('message'); 
                                             echo $message; ?>
                                            </div>
                                            <div class="active" >
                                                <div class="control-group">
                                                    <label class="control-label" for="employee_id">Employee Id</label>
                                                    <div class="controls">
                                                        <div class="span12">
                                                            <input type="text" name="employee_id" id="employee_id" class="span6" required="required"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="active" >
                                                <div class="control-group">
                                                    <label class="control-label" for="dob">Date Of Birth</label>
                                                    <div class="controls">
                                                        <div class="span12">
                                                            <input type="text" name="dob" id="dob" class="span6" required="required"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="active">
                                                <div class="control-group">
                                                    <label class="control-label" for="doj">Date Of Join</label>
                                                    <div class="controls">
                                                        <div class="span12">
                                                            <input type="text" name="doj" id="doj" class="span6" required="required"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                    <div class="form-actions">
                                                <button class="btn btn-info" id="course_save" type="button">
                                                    <i class="icon-ok bigger-110"></i>
                                                    Save
                                                </button>

                                                &nbsp; &nbsp; &nbsp;
                                                <button class="btn" type="reset">
                                                    <i class="icon-undo bigger-110"></i>
                                                    Reset
                                                </button>
                                            </div>
                    
                </form>

            </div><!--/.span-->
        </div><!--/.row-fluid-->
    </div><!--/.page-content-->
</div><!--/.main-content-->
<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
    <i class="icon-double-angle-up icon-only bigger-110"></i>
</a>


<script src="<?php echo base_url("assests/js/jquery.validate.min.js"); ?>"></script>
<script type="text/javascript">
    $(function () {
        $("#dob" ).datepicker();
        $("#doj" ).datepicker();
        var media_type_value = $('input[type=radio][name=media_type]').val();
        if (media_type_value == '6') {
            $("#media_url_upload_link").hide();
            $("#image_upload_div").show();
        }
        else {
            $("#media_url_upload_link").show();
            $("#image_upload_div").hide();
        }
        $("#course_save").click(function () {
            if($('#validation-form').valid())
            {
                $("form")[0].submit()
            }
            
        });
        
    $('input[type=radio][name=media_type]').change(function() {
         if (this.value == '6') {
            $("#media_url_upload_link").hide();
            $("#image_upload_div").show();
        }
        else {
            $("#media_url_upload_link").show();
            $("#image_upload_div").hide();
        }
    });
        
        $('#validation-form').validate({
            errorElement: 'span',
            errorClass: 'help-inline',
            focusInvalid: false,
            rules: {
                title: {
                    required: true
                },
                body: {
                    required: true
                },
                category: {
                    required: true
                }
            },
//            messages: {
//                email: {
//                    required: "Please provide a valid email.",
//                    email: "Please provide a valid email."
//                },
//                password: {
//                    required: "Please specify a password.",
//                    minlength: "Please specify a secure password."
//                },
//                subscription: "Please choose at least one option",
//                gender: "Please choose gender",
//                agree: "Please accept our policy"
//            },
            invalidHandler: function (event, validator) { //display error alert on form submit   
                $('.alert-error', $('.login-form')).show();
            },
            highlight: function (e) {
                $(e).closest('.control-group').removeClass('info').addClass('error');
            },
            success: function (e) {
                $(e).closest('.control-group').removeClass('error').addClass('info');
                $(e).remove();
            },
            errorPlacement: function (error, element) {
                if (element.is(':checkbox') || element.is(':radio')) {
                    var controls = element.closest('.controls');
                    if (controls.find(':checkbox,:radio').length > 1)
                        controls.append(error);
                    else
                        error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
                }
                else if (element.is('.select2')) {
                    error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
                }
                else if (element.is('.chzn-select')) {
                    error.insertAfter(element.siblings('[class*="chzn-container"]:eq(0)'));
                }
                else
                    error.insertAfter(element);
            },
            submitHandler: function (form) {
            },
            invalidHandler: function (form) {
            }
        });
    });
</script>
</body>
</html>
