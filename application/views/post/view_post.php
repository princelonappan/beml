

<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="icon-home home-icon"></i>
                <a href="/post">Home</a>

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
                
                <form class="form-horizontal style-form" id="validation-form" method="" action="" enctype="">
                                        <div class="step-content row-fluid position-relative" id="step-container">
                                            <div class="step-pane active" id="step1">
                                                <?php if(isset($post[0]) && $post[0] != NULL && $post[0] !='') {?>
                                                <?php //print_r($post);?>
                                                <div class="control-group">
                                                    <label class="control-label" for="title">Title :</label>
                                                    <div class="controls">
                                                        <div class="span12" style='line-height: 31px;'>
                                                            <?php echo $post[0]['title'];?>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="body">Body :</label>
                                                    <div class="controls">
                                                        <div class="span12" style='line-height: 31px;'>
                                                            
                                                             <?php echo $post[0]['body'];?>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="category">Category :</label>
                                                    <div class="controls">
                                                        <div class="span12" style='line-height: 31px;'>
                                                            <?php echo $post[0]['category_name'];?>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="media_available">Media Available? :</label>
                                                    <div class="controls">
                                                        <div class="span12" style='line-height: 31px;'>
                                                            <?php echo $post[0]['media_available'] == 1 ? 'Yes' : 'NO';?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php 
                                                if($post[0]['media_available'] == 1) { ?>
                                                <div class="control-group" id="media_url_upload_link">
                                                    <label class="control-label" for="media_url">Media URL :</label>
                                                    <div class="controls">
                                                        <div class="span12" style='line-height: 31px;'>
                                                          <?php
                                                          if(isset($post[0]['file_path']) && $post[0]['file_path'] != NULL){?> 
                                                          <a href="<?php echo $this->config->base_url(); ?>uploads/<?php echo $post[0]['file_path'];?>">Link
                                                          </a> 
                                                          <?php }else{?>
                                                            <div class="span12" style='line-height: 31px;'>
                                                            <?php echo $post[0]['media_url'];?>
                                                            </div>
                                                          <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php } ?>
                                               
                                                  <div class="control-group">
                                                    <label class="control-label" for="email">Can Share? :</label>
                                                    <div class="controls">
                                                         <div class="span12" style='line-height: 31px;'>
                                                                  <?php if ($post[0]['is_share'] == 1 ){
                                                                     echo 'Yes';
                                                                  } else {
                                                                      echo 'No';
                                                                  }
                                                                  ?>
                                                             
                                                                  
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php }else { ?> 
                                                    <div class="control-group">
                                                        No records found.
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            
                                        </div>
                    
                </form>

            </div><!--/.span-->
        </div><!--/.row-fluid-->
    </div><!--/.page-content-->
</div><!--/.main-content-->
<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
    <i class="icon-double-angle-up icon-only bigger-110"></i>
</a>

</body>
</html>
