<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/project_quote_add');" 
    class="btn btn-primary pull-right">
        <i class="entypo-user-add"></i>
        <?php echo get_phrase('add_new_project_quote');?>
</a>     
<br>
<br>
<br>
<div class="main_data">
    <?php include 'project_quote_list.php';?>
</div>