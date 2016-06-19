<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php echo $this->template->load_view('partials/logged_header.php'); ?>
    </head>
    <body> 
        <section id="container" >
            <?php echo $this->template->load_view('partials/inner_header.php'); ?>
            <div class="main-container container-fluid">
                <a class="menu-toggler" id="menu-toggler" href="#">
                    <span class="menu-text"></span>
                </a>
                <?php //echo $this->template->load_view('partials/inner_left_menu.php'); ?>
                <?php echo $template['body']; ?>           
            </div>
        </section>
    </body>
</html>
