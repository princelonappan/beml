<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php 
        if(is_logged_in()) : ?>
            <?php echo $this->template->load_view('partials/logged_header.php'); ?>
        <?php else : ?>
            <?php echo $this->template->load_view('partials/header.php'); ?>
        <?php endif; ?>
        
    </head>
    <body class="login-layout"> 
        <?php if(is_logged_in()) : ?>
            <?php echo $this->template->load_view('layouts/inner.php'); ?>
        <?php else : ?>
        <div class="wrapper">
            <?php echo $this->template->load_view('layouts/outer.php'); ?>
            </div>
        <?php endif; ?>
        <?php //echo $this->template->load_view('partials/modal_popups.php'); ?>
        
    </body>
</html>
