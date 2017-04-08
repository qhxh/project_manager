<?php 
	$current_task_status = $this->db->get_where('team_task' , array(
		'team_task_id' => $team_task_id))->row()->task_status;
?>

<?php if ($current_task_status == 1):?>
<div class="row">
	<div class="main_data">
		<?php include 'team_task_information.php';?>
	</div>
</div>
<?php endif;?>

<?php if ($current_task_status == 0):?>
<div class="row">
	<div class="main_data">
		<?php include 'team_task_information_archived.php';?>
	</div>
</div>
<?php endif;?>
