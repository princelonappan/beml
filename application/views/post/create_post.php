

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
            <li class="active"> Posts</li>
        </ul><!--.breadcrumb-->

        <?php if (isset($studetns) && !empty($studetns))
        {
            ?>
            <div class="nav-search" id="nav-search">
                <form class="form-search" />
                <span class="input-icon">
                    <input type="text" placeholder="Search ..." class="input-small nav-search-input" id="nav-search-input" autocomplete="off" />
                    <i class="icon-search nav-search-icon"></i>
                </span>
                </form>
            </div><!--#nav-search-->
<?php } ?>
    </div>

    <div class="page-content">
        <div class="page-header position-relative">
            <h1>
                Posts
            </h1>
        </div><!--/.page-header-->

        <div class="row-fluid">
            <div class="span12">
                <!--PAGE CONTENT BEGINS-->
                
                <form class="form-horizontal style-form" id="validation-form" method="POST" action="<?php echo $this->config->base_url(); ?>post/save_details" enctype="multipart/form-data">
                                        <div class="step-content row-fluid position-relative" id="step-container">
                                            <div class="alert alert-success"">
                                             <?php $message = $this->session->flashdata('message'); 
                                             echo $message; ?>
                                            </div>
                                            <div class="step-pane active" id="step1">
                                                <div class="control-group">
                                                    <label class="control-label" for="title">Title</label>
                                                    <div class="controls">
                                                        <div class="span12">
                                                            <input type="text" name="title" id="title" class="span6" required="required"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="body">Body</label>
                                                    <div class="controls">
                                                        <div class="span12">
                                                            
                                                            <textarea name="body" id="body" style="width: 407px;height: 120px;"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="category">Category</label>
                                                    <div class="controls">
                                                        <div class="span12">
                                                            
                                                             <select name="category" id="category" required="required" class="span6">
                                                                <option value="">Select Category</option>
                                                               <?php
                                                                if(!empty($categories))
                                                                {
                                                                        foreach ($categories as $category)
                                                                        { ?>
                                                                <option value="<?php echo $category->id;?>"><?php echo $category->category_name;?></option>
                                                                       <?php } } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="email">Media Type</label>
                                                    <div class="controls">
                                                        <span class="span12">
                                                            <label class="blue" style="display: inline;">
                                                                <input name="media_type" value="1" type="radio" checked="checked"/>
                                                                <span class="lbl">Upload media link</span>
                                                            </label>

                                                            <label class="blue" style="display: inline;padding-left: 5px;">
                                                                <input name="media_type" value="2" type="radio" />
                                                                <span class="lbl">Upload a image </span>
                                                            </label>
                                                        </span>
                                                    </div>
                                                </div>
                                                
                                                <div class="control-group" id="media_url_upload_link">
                                                    <label class="control-label" for="media_url">Media URL</label>
                                                    <div class="controls">
                                                        <div class="span12">
                                                            <input type="text" name="media_url" id="media_url" class="span6" required="required"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="control-group" id="image_upload_div" style="display: none;">
                                                    <label class="control-label" for="image">Upload Image</label>
                                                    <div class="controls">
                                                        <div class="span12">
                                                            <input type="file" name="image" id="image" class="span6" required="required"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                  <div class="control-group">
                                                    <label class="control-label" for="email">Can Share?</label>
                                                    <div class="controls">
                                                        <span class="span12">
                                                            <label class="blue" style="display: inline;">
                                                                <input name="can_share" value="1" type="radio" checked="checked"/>
                                                                <span class="lbl">Yes</span>
                                                            </label>

                                                            <label class="blue" style="display: inline;padding-left: 5px;">
                                                                <input name="can_share" value="2" type="radio" />
                                                                <span class="lbl">No</span>
                                                            </label>
                                                        </span>
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
        
        var media_type_value = $('input[type=radio][name=media_type]').val();
        if (media_type_value == '1') {
            $("#media_url_upload_link").show();
            $("#image_upload_div").hide();
        }
        else {
            $("#media_url_upload_link").hide();
            $("#image_upload_div").show();
        }
        $("#course_save").click(function () {
            if($('#validation-form').valid())
            {
                $("form")[0].submit()
            }
            
        });
        
    $('input[type=radio][name=media_type]').change(function() {
        if (this.value == '1') {
            $("#media_url_upload_link").show();
            $("#image_upload_div").hide();
        }
        else {
            $("#media_url_upload_link").hide();
            $("#image_upload_div").show();
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
