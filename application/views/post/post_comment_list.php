
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
    </div>

    <div class="page-content">
        <div class="page-header position-relative">
            <h1>
                <?php echo  isset($post[0]['title']) ? $post[0]['title'].' - Comments' : ''; ?>
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
                    if (isset($comments) && !empty($comments))
                    {
                        ?>
                        <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Comment</th>
                                    <th>Employee Id</th>
                                    <th>Created By</th>
                                    <th>Status</th>
                                    <th>Created Date</th> 
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php      
                                $i = 1;
                                foreach ($comments as $comment)
                                {
                                    
                                    $status = $comment['post_comment_status'] == 1 ? 2 : 1;
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $comment['comment']; ?></td> 
                                        <td><?php echo $comment['employee_id']; ?></td> 
                                        <td><?php echo $comment['name']; ?></td>
                                        <td><?php echo $comment['post_comment_status'] == 1 ? "Active" : "Deactive"; ?></td>
                                        <td><?php echo $comment['post_commented_date']; ?></td>

                                        <td class="td-actions">
                                            <div class="hidden-phone visible-desktop action-buttons">
                                                <a onclick="change_status_post(<?php echo $comment['post_comment_id']; ?>, <?php echo $status;?>, <?php echo $comment['post_id'];?>)"  name='view_post' class="green view_post" id ="<?php echo $comment['post_comment_id']; ?>" data-rel="tooltip" title="Change Status">
                                                    <i class="icon-pencil bigger-130"></i>
                                                </a>                                             
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
</body>
</html>


<script type="text/javascript">
    $(function () {
        var oTable1 = $('#sample-table-2').dataTable({
            "aoColumns": [
                {"bSortable": false},
                {"bSortable": true},
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

        $('.view_post').on('click', function () {
           console.log("Fgdfgdfg");
           

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
    
 function change_status_post(id,status, post_id) 
    {
           var strconfirm = confirm("Are you sure you want change the status?");
           if (strconfirm == true)
            {
                window.location = "/post/change_comment_status/"+id+"/"+status+"/"+post_id;
            }
       }
    var newwin = function()
    {
          console.log($(this).attr('id'));
    }
    $(document).on('click' , '.view_post' , function(){
    var idProp= $(this).prop('id'); // or attr() 
});
</script>