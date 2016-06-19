<div class="sidebar-nav col-md-3 col-lg-3 col-sm-3 sidebar-wrapper ">
    <img src="<?php echo image_url('icon-grid.png') ?>" class="icon-inside-grid-sd pull-right" id="">
    <div class="dp-column">
        <div class="sidebar-child-div"
             style='background-image: url("<?php echo student_image('big_' .$childs[$selected_child]->STU_PICTURE); ?>")'>


        </div>

        <div class="btn-group" role="group">
            <button type="button"
                    class="btn btn-default dropdown-toggle <?php echo (count($childs) > 1) ? 'student-dropdown-toggle' : ''; ?>  child-name-sidebar"
                    data-toggle="dropdown" aria-expanded="false">
                <?php echo $childs[$selected_child]->STU_FIRST_NAME . ' ' . $childs[$selected_child]->STU_LAST_NAME ?>
                <?php if (count($childs) > 1) { ?>
                <span class="caret"></span>
                <?php } ?>
            </button>

        </div>
    </div>
    <div class="select-student">
        <?php foreach ($childs as $child) {
            if ($child->STU_ID != $selected_child) {

                ?>
                <a class="sidebar-child-list" href="<?php echo '/parent/child/report/' . $child->STU_ID ?>">
                    <div class="row-select-student">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 row-select-student-col-1-1">
                                <div class="sidebar-child-small-div"
                                     style='background-image: url("<?php echo student_image('big_' . $child->STU_PICTURE); ?>")'></div>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 row-select-student-col-1-2">
                                <span
                                    class="child-name-sidebar"><?php echo $child->STU_FIRST_NAME . ' ' . $child->STU_LAST_NAME ?></span>

                                <p><?php echo $child->DC_NAME; ?></p>
                            </div>
                        </div>
                    </div>
                </a>
            <?php }
        }
        ?>

    </div>
    <div class="student-info-outer">
        <div class="institution-info text-center">
            <span><?php echo $childs[$selected_child]->DC_NAME; ?></span>

            <p><?php echo $childs[$selected_child]->DC_ADDRESS . ', ' . $childs[$selected_child]->DC_CITY . ', ' . $childs[$selected_child]->DC_STATE; ?></p>

            <p><?php echo $childs[$selected_child]->DC_COUNTRY . ', ' . $childs[$selected_child]->DC_ZIPCODE ?></p>

            <p><?php echo $childs[$selected_child]->DC_PHONE; ?></p>
        </div>
        <?php
        $menu = $this->load->config('menu', true);
        $uri = $this->uri->segment(1) . '/' . $this->uri->segment(2);

        ?>

        <ul class="nav in" id="side-menu">
            <?php if (!empty($menu['menu']))
                foreach ($menu['menu'] as $item) {
                    $active = "";
                    if (in_array(uri_string(), $item['active_urls']) || in_array($uri, $item['active_urls'])) {
                        $active = 'active';
                    }
                    ?>

                    <li class="<?php echo $active; ?>">
                        <a href="<?php echo $item['url'] . '/' . $selected_child; ?>"
                           class="active <?php echo $item['class']; ?>">
                            <i class=""></i><?php echo $item['name']; ?></a>
                    </li>

                <?php } ?>

        </ul>
    </div>
</div>