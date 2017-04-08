<div class="row">
	<div class="col-md-3">

	<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/team_task_add/');" 
    class="btn btn-info btn-block">
        <i class="entypo-plus"></i>
        <?php echo get_phrase('add_a_new_team_task');?>
    </a>
    <br>
		
		<?php
			$this->db->where('task_status' , 1);
			$this->db->order_by('creation_timestamp', 'desc'); 
			$query	=	$this->db->get('team_task');
			if ($query->num_rows() > 0):
				$team_tasks = $query->result_array();
				foreach ($team_tasks as $row):
		?>
		<a style="text-align: left;" href="<?php echo base_url();?>index.php?admin/team_task_view/<?php echo $row['team_task_id'];?>" 
			class="<?php //if ($room_page == 'project_overview') 
								echo 'btn btn-default';
							//else 
								//echo 'btn btn-default';?> btn-block">
			
			<i class="entypo-right-open"></i> <?php echo $row['task_title'];?>
		</a>
		<?php 
			endforeach;
				endif;
		?>

	</div>
	<div class="col-md-9">
		<h3 class="text-center" style="color: #ccc;">
		<?php
			if ($query->num_rows() > 0)
				echo 'Please select a task first.....';
			if ($query->num_rows() < 1)
				echo 'No running tasks......';
		?>
		</h3>
	</div>
</div>