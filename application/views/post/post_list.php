
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
                    if (isset($posts) && !empty($posts))
                    {
                        ?>
                        <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Title</th>
                                    <th>Body</th>
                                    <th>Category</th>
                                    <th>Created Date</th> 
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php 
                                $i = 1;
                                foreach ($posts as $post)
                                {
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $post['title']; ?></td>                  
                                        <td><?php echo $post['body']; ?></td>
                                        <td><?php echo $post['category_name']; ?></td>
                                        <td><?php echo $post['post_created_date']; ?></td>

                                        <td class="td-actions">
                                            <div class="hidden-phone visible-desktop action-buttons">
                                                <a href="<?php echo 'post/post_view/' . $post['post_id']; ?>" onclick='' name='view_post' class="green view_post" id ="<?php echo $post['post_id']; ?>" data-rel="tooltip" title="View Post">
                                                    <i class="icon-eye-open bigger-130"></i>
                                                </a>
                                                
                                                <a href="<?php echo 'post/edit/' . $post['post_id']; ?>" onclick='' name='view_post' class="green view_post" id ="<?php echo $post['post_id']; ?>" data-rel="tooltip" title="Edit Post">
                                                    <i class="icon-pencil bigger-130"></i>
                                                </a>
                                                
                                                <a onclick="delete_post(<?php echo $post['post_id']; ?>)"  name='view_post' class="green view_post" id ="<?php echo $post['post_id']; ?>" data-rel="tooltip" title="Delete Post">
                                                    <i class="icon-remove-sign bigger-130"></i>
                                                </a>
                                                
                                                <a  href="<?php echo 'post/view_comments/' . $post['post_id']; ?>" name='view_post' class="green view_post" id ="<?php echo $post['post_id']; ?>" data-rel="tooltip" title="Display Comments">
                                                    <i class="icon-eye-open bigger-130"></i>
                                                </a>
                                            </div>
                                            <div class="hidden-desktop visible-phone">
                                                <div class="inline position-relative">
                                                    <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
                                                        <i class="icon-caret-down icon-only bigger-120"></i>
                                                    </button>

                                                    <ul class="dropdown-menu dropdown-icon-only dropdown-yellow pull-right dropdown-caret dropdown-close">
                                                        <li>
                                                            <a href="" class="tooltip-success" data-rel="tooltip" title="View Post">
                                                                <span class="green">
                                                                    <i name='view_post' class="view_post icon-delete bigger-120" ></i>
                                                                </span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
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
</body>
</html>


<script type="text/javascript">
    $(function () {
        var oTable1 = $('#sample-table-2').dataTable({
            "aoColumns": [
                {"bSortable": false},
                {"bSortable": false},
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
       
       
    });
    
    function delete_post(id) 
    {
           var strconfirm = confirm("Are you sure you want to delete?");
           if (strconfirm == true)
            {
                window.location = "post/delete/"+id;
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