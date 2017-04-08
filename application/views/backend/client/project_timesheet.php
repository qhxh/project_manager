<?php 
	$current_project = $this->db->get_where('project' , array(
		'project_code' => $project_code
	))->result_array();
	foreach ($current_project as $row):
?>

<div class="col-md-9">
   <!-- table for timer entries -->

    <div class="panel panel-primary" data-collapsed="0">

        <div class="panel-heading">
            <div class="panel-title">
                <?php echo get_phrase('timer_entries');?>
            </div>
            
        </div>
        
        <div class="panel-body" style="padding: 0px;">
            <table class="table table-striped">
                <tr>
					<td><?php echo get_phrase('start');?></td>
					<td><?php echo get_phrase('end');?></td>
					<td><?php echo get_phrase('total_time');?></td>
				<tr>

				<?php 
				$total_duration 	=	0;
				$this->db->order_by('project_timesheet_id' , 'desc');
				$project_timesheet	=	$this->db->get_where('project_timesheet' , array('project_id' => $row['project_id']))->result_array();
				foreach ($project_timesheet as $row2):
					?>
				<tr>
					<td><?php echo date("H:i, d M" , $row2['start_timestamp']);?></td>
					<td><?php echo date("H:i, d M" , $row2['end_timestamp']);?></td>
					<td>
						<?php 
						$duration 		=	$row2['end_timestamp'] - $row2['start_timestamp'];
			            $total_duration += $duration;

						$total_hour 	= 	intval($duration / 3600);
						$duration 		-= $total_hour * 3600;
			            $total_minute 	= intval($duration / 60);
			            $total_second 	= intval($duration % 60);
						?>
						<?php if ($total_hour > 0)echo $total_hour . 'h : '; ?>
						<?php if ($total_minute > 0)echo $total_minute . 'm : '; ?>
						<?php if ($total_second > 0)echo $total_second . 's '; ?>
					</td>
				</tr>
				<?php endforeach;?>
            </table>
            

        </div>

    </div>

    <!-- total time calculation -->
	<div class="alert alert-default">
        <strong style="color: #818da1;">
            <?php echo get_phrase('total_time_completed');?> : 
            <?php 
			// calculating total hour, minute, second
			$total_hour 		= 	intval($total_duration / 3600);
			$total_duration 	-= $total_hour * 3600;
            $total_minute 		= intval($total_duration / 60);
            $total_second 		= intval($total_duration % 60);
		 	if ($total_hour > 0)echo $total_hour . 'h : '; 
		 	if ($total_minute > 0)echo $total_minute . 'm : ';  
		 	echo $total_second . 's '; 
		 ?>
        </strong>
    </div>
    <!-- total time calculation -->

</div>

<?php endforeach;?>
