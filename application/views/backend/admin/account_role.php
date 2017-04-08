<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/account_role_add/');" 
    class="btn btn-primary pull-right">
        <i class="entypo-plus-circled"></i>
        <?php echo get_phrase('add_new_account_role');?>
    </a>
<br><br>
<div class="main_data">
	<?php include 'account_role_list.php';?>
</div>