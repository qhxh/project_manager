<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/expense_add/');" 
    class="btn btn-primary pull-right">
        <i class="entypo-plus-circled"></i>
        <?php echo get_phrase('add_expense');?>
    </a>
<br><br>
<div class="main_data">
	<?php include 'expense_list.php';?>
</div>