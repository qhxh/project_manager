<div class="row">
	<div class="col-md-12">
		<ol class="breadcrumb bc-3">
			<li>
				<a href="<?php echo base_url();?>index.php?staff/dashboard">
					<i class="entypo-folder"></i>
					<?php echo get_phrase('dashboard');?>
				</a>
			</li>
			<li><a href="<?php echo base_url();?>index.php?staff/project"><?php echo get_phrase('project_list');?></a></li>
		</ol>
	</div>
</div>
<div class="row">

	<div class="col-md-2">

		<a style="text-align: left;" href="<?php echo base_url();?>index.php?staff/projectroom/overview/<?php echo $project_code;?>" 
			class="<?php if ($room_page == 'project_overview') 
								echo 'btn btn-primary';
							else 
								echo 'btn btn-default';?> btn-block btn-icon icon-left">
			<?php echo get_phrase('overview');?>
			<i class="entypo-info"></i>
		</a>
		
		<a style="text-align: left;" href="<?php echo base_url();?>index.php?staff/projectroom/wall/<?php echo $project_code;?>" 
			class="<?php if ($room_page == 'project_wall') 
								echo 'btn btn-primary';
							else 
								echo 'btn btn-default';?> btn-block btn-icon icon-left">
			<?php echo get_phrase('wall');?>
			<i class="entypo-chat"></i>
		</a>

		<a style="text-align: left;" href="<?php echo base_url();?>index.php?staff/projectroom/file/<?php echo $project_code;?>" 
			class="<?php if ($room_page == 'project_file') 
								echo 'btn btn-primary';
							else 
								echo 'btn btn-default';?> btn-block btn-icon icon-left">
			<?php echo get_phrase('files');?>
			<i class="entypo-attach"></i>
		</a>

		<a style="text-align: left;" href="<?php echo base_url();?>index.php?staff/projectroom/task/<?php echo $project_code;?>" 
			class="<?php if ($room_page == 'project_task') 
								echo 'btn btn-primary';
							else 
								echo 'btn btn-default';?> btn-block btn-icon icon-left">
			<?php echo get_phrase('tasks');?>
			<i class="entypo-flow-tree"></i>
		</a>
                <a style="text-align: left;" href="<?php echo base_url();?>index.php?staff/projectroom/bug/<?php echo $project_code;?>" 
			class="<?php if ($room_page == 'project_bug') 
								echo 'btn btn-primary';
							else 
								echo 'btn btn-default';?> btn-block btn-icon icon-left">
			<?php echo get_phrase('bugs/Issues');?>
			<i class="entypo-feather"></i>
		</a>
		<a style="text-align: left;" href="<?php echo base_url();?>index.php?staff/projectroom/timesheet/<?php echo $project_code;?>" 
			class="<?php if ($room_page == 'project_timesheet') 
								echo 'btn disabled btn-primary';
							else 
								echo 'btn disabled btn-default';?> btn-block btn-icon icon-left">
			<?php echo get_phrase('timesheet');?>
			<i class="entypo-clock"></i>
		</a>

		<a style="text-align: left;" href="<?php echo base_url();?>index.php?staff/projectroom/note/<?php echo $project_code;?>" 
			class="<?php if ($room_page == 'project_note') 
								echo 'btn btn-primary';
							else 
								echo 'btn btn-default';?> btn-block btn-icon icon-left">
			<?php echo get_phrase('note');?>
			<i class="entypo-doc-text-inv"></i>
		</a>

		<!-- QHXH code: add button progress status for staff -->
		<a style="text-align: left;" href="<?php echo base_url();?>index.php?staff/projectroom/project_staff_progress/<?php echo $project_code;?>" 
			class="<?php if ($room_page == 'projectstaff_progress') 
								echo 'btn btn-primary';
							else 
								echo 'btn btn-default';?> btn-block btn-icon icon-left">
			<?php echo 'Cập nhật tiến độ';?>
			<i class="entypo-battery"></i>
		</a>
		
		<!-- end QHXH code-->

	</div>

	<div class="main_data">
		
		<?php include $room_page . '.php';?>

	</div>

</div>