
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
                                    <th>Post Comment ID</th>
                                    <th>Comment</th>
                                    <th>Employee Id</th>
                                    <th>Created By</th>
                                    <th>Status</th>
                                    <th>Created Date</th> 
                                    <th></th>
                                    <th></th>
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
                                        <td><?php echo $comment['post_comment_id']; ?></td>
                                        <td><?php echo $comment['comment']; ?></td> 
                                        <td><?php echo $comment['employee_id']; ?></td> 
                                        <td><?php echo $comment['name']; ?></td>
                                        <td><?php 
                                        if($comment['post_comment_status'] == 1) {
                                            echo "Active";
                                        } else if($comment['post_comment_status'] == 2) {
                                             echo "Deactive";
                                        } else {
                                            echo "Ignore";
                                        }
                                        
                                         ?></td>
                                        <td><?php echo $comment['post_commented_date']; ?></td>

                                        <td class="td-actions">
                                            <a href="/post/change_comment_status/<?php echo $comment['post_comment_id']; ?>/1/<?php echo $comment['post_id'];?>" >Approve</a>                                                                                   
                                        </td>
                                        <td class="td-actions">
                                            <a href="/post/change_comment_status/<?php echo $comment['post_comment_id']; ?>/2/<?php echo $comment['post_id'];?>">Deactive</a>                                                                                   
                                        </td>
                                        <td class="td-actions">
                                             <a href="/post/change_comment_status/<?php echo $comment['post_comment_id']; ?>/3/<?php echo $comment['post_id'];?>">Ignore</a>
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
            aaSorting: [[0, 'desc']]
            });


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