

<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="icon-home home-icon"></i>
                <a href="/user">Home</a>

                <span class="divider">
                    <i class="icon-angle-right arrow-icon"></i>
                </span>
            </li>
            <li class="active"> Employees</li>
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
                Employees
            </h1>
        </div><!--/.page-header-->

        <div class="row-fluid">
            <div class="span12">
                <!--PAGE CONTENT BEGINS-->


                <div class="row-fluid">
                    <div class="table-header">
                        Manage Employees
                    </div>
                    <?php
                    if (isset($user_details) && !empty($user_details))
                    {
                        ?>
                        <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Employee Id</th>
                                    <th>Employee Name</th>
                                    <th>Date of Birth</th>
                                    <th>Date of Join</th>
                                    <th>Email</th>
                                    <th>Is Admin User?</th>
                                    <th>User Role</th>
                                    <th>Status</th>
                                    <th class="hidden-480"></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($user_details as $user)
                                {
                                    $new_status = $user->status == 1 ? 2 : 1;
                                    $status = $user->status == 1 ? 'Active' : 'Deactive';
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $user->employee_id; ?></td>
                                        <td>
                                            <a href="#"><?php echo $user->name; ?></a>
                                        </td>
                                        <td><?php echo $user->date_of_birth; ?></td>
                                        <td ><?php echo $user->date_of_join; ?></td>
                                        <td ><?php echo $user->email; ?></td>
                                        <td ><?php echo $user->is_admin_user == '1' ? 'Yes': 'No'; ?></td>
                                        <td>
                                            <?php
                                            if($user->is_admin_user == $this->config->item('is_admin_user')) 
                                            {
                                                if($user->admin_role == $this->config->item('super_admin_role')) {
                                                    echo 'Super Admin';
                                                } else if($user->admin_role == $this->config->item('post_admin_role')) {
                                                     echo 'Post Management Admin';
                                                } else {
                                                     echo 'User Management Admin';
                                                }
                                            }
                                            else 
                                            {
                                                echo 'Normal User';
                                            } ?>
                                        <td><?php echo $user->status == 1 ? 'Active' : 'Deactive'; ?></td>
                                        <td class="td-actions">
                                            <div class="hidden-phone visible-desktop action-buttons">
                                                <a href="<?php echo 'user/edit/' . $user->id; ?>" class="green"  data-rel="tooltip" title="Edit Employee details">
                                                    <i class="icon-pencil bigger-130"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                        <?php $i++; } ?>
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
                {"bSortable": true},
                {"bSortable": true},
                {"bSortable": true},
                {"bSortable": true},
                {"bSortable": true},
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
    });
    
    function change_user_status(id, status) 
    {
           var strconfirm = confirm("Are you sure you want to change status?");
           if (strconfirm == true)
            {
                window.location = "/user/change_status/"+id+"/"+status;
            }
       }
</script>
</body>
</html>
