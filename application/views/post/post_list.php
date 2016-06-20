

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


                <div class="row-fluid">
                    <div class="table-header">
                        Manage Posts
                    </div>
                    <?php
                    if (isset($students) && !empty($students))
                    {
                        ?>
                        <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Student Number</th>
                                    <th>Student Name</th>
                                    <th>Email Address</th>
                                    <th>Tele phone</th>
                                    <th class="hidden-480"><i class="icon-time bigger-110 hidden-phone"></i> Date of Registration</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                foreach ($students as $student)
                                {
                                    ?>
                                    <tr>
                                        <td><?php echo $student->id; ?></td>
                                        <td>
                                            <a href="#"><?php echo $student->first_name . ' ' . $student->middle_name . ' ' . $student->last_name; ?></a>
                                        </td>
                                        <td><?php echo $student->email; ?></td>
                                        <td ><?php echo $student->telephone_number; ?></td>
                                        <td ><?php echo $student->date_of_registration; ?></td>

                                        <td class="td-actions">
                                            <div class="hidden-phone visible-desktop action-buttons">
                                                <a class="blue" href="#" data-rel="tooltip" title="View enrolled course details">
                                                    <i class="icon-zoom-in bigger-130"></i>
                                                </a>

                                                <a class="green" href="#" data-rel="tooltip" title="Edit student details">
                                                    <i class="icon-pencil bigger-130"></i>
                                                </a>

                                                <a class="red" href="#" data-rel="tooltip" title="Delete student details">
                                                    <i class="icon-trash bigger-130"></i>
                                                </a>
                                            </div>

                                            <div class="hidden-desktop visible-phone">
                                                <div class="inline position-relative">
                                                    <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
                                                        <i class="icon-caret-down icon-only bigger-120"></i>
                                                    </button>

                                                    <ul class="dropdown-menu dropdown-icon-only dropdown-yellow pull-right dropdown-caret dropdown-close">
                                                        <li>
                                                            <a href="#" class="tooltip-info" data-rel="tooltip" title="View enrolled course details">
                                                                <span class="blue">
                                                                    <i class="icon-zoom-in bigger-120"></i>
                                                                </span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit student details">
                                                                <span class="green">
                                                                    <i class="icon-edit bigger-120"></i>
                                                                </span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete student details">
                                                                <span class="red">
                                                                    <i class="icon-trash bigger-120"></i>
                                                                </span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                        <?php } ?>
                            </tbody>
                        </table>
<?php }
else
{ ?>
                        <div>
                            No records found.  
                        </div>
<?php } ?>
                </div>


            </div><!--/.span-->
        </div><!--/.row-fluid-->
    </div><!--/.page-content-->
</div><!--/.main-content-->
<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
    <i class="icon-double-angle-up icon-only bigger-110"></i>
</a>



<script type="text/javascript">
    $(function () {
        var oTable1 = $('#sample-table-2').dataTable({
            "aoColumns": [
                {"bSortable": false},
                {"bSortable": true},
                {"bSortable": false},
                {"bSortable": false},
                {"bSortable": false},
                {"bSortable": false}
            ]});


        $('table th input:checkbox').on('click', function () {
            var that = this;
            $(this).closest('table').find('tr > td:first-child input:checkbox')
                    .each(function () {
                        this.checked = that.checked;
                        $(this).closest('tr').toggleClass('selected');
                    });

        });


        $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
        function tooltip_placement(context, source) {
            var $source = $(source);
            var $parent = $source.closest('table')
            var off1 = $parent.offset();
            var w1 = $parent.width();

            var off2 = $source.offset();
            var w2 = $source.width();

            if (parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2))
                return 'right';
            return 'left';
        }
    })
</script>
</body>
</html>
