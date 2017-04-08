<div class="row">

	<!-- staffs-->
	<div class="col-sm-6">
	
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">
					<i class="entypo-user"></i>
					<?php echo get_phrase('staff');?>
					<a href="<?php echo base_url();?>index.php?admin/staff" class="pull-right tooltip-primary" 
						data-toggle="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('view_all_staff');?>"> 
							<i class="entypo-right-open-mini"></i></a>
				</div>
					
				
			</div>
	
			<div class="panel-body with-table">
				<table class="table  table-bordered table-hover table-striped">
					
					<tbody>
						<?php 
							$this->db->like('name' , $search_key);
							$this->db->or_like('email' , $search_key);
							$this->db->or_like('phone' , $search_key);
							$staff_query = $this->db->get('staff');
						?>
						<?php 
							if ($staff_query->num_rows() > 0):
								$staffs = $staff_query->result_array();
								foreach ($staffs as $row):
						?>
						<tr>
							<td><?php echo $row['name'];?></td>
							<td>
				            	<a href="#" class="btn btn-primary btn-xs" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/staff_profile/<?php echo $row['staff_id']; ?>');">
                                	<i class="entypo-user"></i>
                            	</a>
				           </td>
						</tr>
						<?php 
							endforeach;
							endif;
						?>

						<?php if ($staff_query->num_rows() < 1):?>
							<td class="text-center">
								 <strong><?php echo get_phrase('no_results_found');?></strong>
							</td>
						<?php endif;?>

					</tbody>
				</table>
			</div>
		</div>
	</div>

	<!-- clients-->
	<div class="col-sm-6">
	
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">
					<i class="entypo-user"></i>
					<?php echo get_phrase('client');?>
					<a href="<?php echo base_url();?>index.php?admin/client" class="pull-right tooltip-primary" 
						data-toggle="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('view_all_client');?>"> 
							<i class="entypo-right-open-mini"></i></a>
				</div>
					
				
			</div>
	
			<div class="panel-body with-table">
				<table class="table  table-bordered table-hover table-striped">
					
					<tbody>
						<?php 
							$this->db->like('name' , $search_key);
							$this->db->or_like('email' , $search_key);
							$this->db->or_like('phone' , $search_key);
							$this->db->or_like('address' , $search_key);
							$client_query = $this->db->get('client');
						?>
						<?php 
							if ($client_query->num_rows() > 0):
								$clients = $client_query->result_array();
								foreach ($clients as $row):
						?>
						<tr>
							<td><?php echo $row['name'];?></td>
							<td>
				            	<a href="#" class="btn btn-primary btn-xs" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/client_profile/<?php echo $row['client_id']; ?>');">
                                	<i class="entypo-user"></i>
                            	</a>
				           </td>
						</tr>
						<?php 
							endforeach;
							endif;
						?>

						<?php if ($client_query->num_rows() < 1):?>
							<td class="text-center">
								 <strong><?php echo get_phrase('no_results_found');?></strong>
							</td>
						<?php endif;?>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>



<div class="row">

	<!-- client projects-->
	<div class="col-sm-6">
	
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">
					<i class="entypo-paper-plane"></i>
					<?php echo get_phrase('client_projects');?>
					<a href="<?php echo base_url();?>index.php?admin/project" class="pull-right tooltip-primary" 
						data-toggle="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('view_all_projects');?>"> 
							<i class="entypo-right-open-mini"></i></a>
				</div>
					
			</div>
	
			<div class="panel-body with-table">
				<table class="table  table-bordered table-hover table-striped">
					
					<tbody>
						<?php 
							$this->db->like('project_code' , $search_key);
							$this->db->or_like('title' , $search_key);
							$project_query = $this->db->get('project');
						?>
						<?php 
							if ($project_query->num_rows() > 0):
								$projects = $project_query->result_array();
								foreach ($projects as $row):
						?>
						<tr>
							<td><?php echo $row['title'];?></td>
							<td>
				            	<a href="<?php echo base_url();?>index.php?admin/projectroom/wall/<?php echo $row['project_code'];?>" 
				            		class="btn btn-primary btn-xs">
                                	<i class="entypo-target"></i>
                            	</a>
				           </td>
						</tr>
						<?php 
							endforeach;
							endif;
						?>

						<?php if ($project_query->num_rows() < 1):?>
							<td class="text-center">
								 <strong><?php echo get_phrase('no_results_found');?></strong>
							</td>
						<?php endif;?>

					</tbody>
				</table>
			</div>
		</div>
	</div>

	<!-- team tasks-->
	<div class="col-sm-6">
	
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">
					<i class="entypo-traffic-cone"></i>
					<?php echo get_phrase('team_tasks');?>
					<a href="<?php echo base_url();?>index.php?admin/team_task" class="pull-right tooltip-primary" 
						data-toggle="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('view_running_tasks');?>"> 
							<i class="entypo-right-open-mini"></i></a>
				</div>
					
			</div>
	
			<div class="panel-body with-table">
				<table class="table  table-bordered table-hover table-striped">
					
					<tbody>
						<?php 
							$this->db->like('task_title' , $search_key);
							$team_task_query = $this->db->get('team_task');
						?>
						<?php 
							if ($team_task_query->num_rows() > 0):
								$tasks = $team_task_query->result_array();
								foreach ($tasks as $row):
						?>
						<tr>
							<td><?php echo $row['task_title'];?></td>
							<td>
				            	<a href="<?php echo base_url();?>index.php?admin/team_task_view/<?php echo $row['team_task_id'];?>" 
				            		class="btn btn-primary btn-xs">
                                	<i class="entypo-target"></i>
                            	</a>
				           </td>
						</tr>
						<?php 
							endforeach;
							endif;
						?>

						<?php if ($team_task_query->num_rows() < 1):?>
							<td class="text-center">
								 <strong><?php echo get_phrase('no_results_found');?></strong>
							</td>
						<?php endif;?>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>





<div class="row">

	<!-- support tickets-->
	<div class="col-sm-6">
	
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">
					<i class="entypo-lifebuoy"></i>
					<?php echo get_phrase('support_tickets');?>
					<a href="<?php echo base_url();?>index.php?admin/support_ticket" class="pull-right tooltip-primary" 
						data-toggle="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('view_all_tickets');?>"> 
							<i class="entypo-right-open-mini"></i></a>
				</div>
					
			</div>
	
			<div class="panel-body with-table">
				<table class="table  table-bordered table-hover table-striped">
					
					<tbody>
						<?php 
							$this->db->like('ticket_code' , $search_key);
							$this->db->or_like('title' , $search_key);
							$this->db->or_like('status' , $search_key);
							$this->db->or_like('priority' , $search_key);
							$support_query = $this->db->get('ticket');
						?>
						<?php 
							if ($support_query->num_rows() > 0):
								$tickets = $support_query->result_array();
								foreach ($tickets as $row):
						?>
						<tr>
							<td><?php echo $row['title'];?></td>
							<td>
				            	<a href="<?php echo base_url();?>index.php?admin/support_ticket_view/<?php echo $row['ticket_code'];?>" 
				            		class="btn btn-primary btn-xs">
                                	<i class="entypo-target"></i>
                            	</a>
				           </td>
						</tr>
						<?php 
							endforeach;
							endif;
						?>

						<?php if ($support_query->num_rows() < 1):?>
							<td class="text-center">
								 <strong><?php echo get_phrase('no_results_found');?></strong>
							</td>
						<?php endif;?>

					</tbody>
				</table>
			</div>
		</div>
	</div>

	<!-- files -->
	<div class="col-sm-6">
	
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">
					<i class="entypo-doc-text"></i>
					<?php echo get_phrase('files');?>
				</div>
			</div>
	
			<div class="panel-body with-table">
				<table class="table  table-bordered table-hover table-striped">
					
					<tbody>
						<?php 
							$this->db->like('name' , $search_key);
							$project_file_query = $this->db->get('project_file');

							$this->db->like('message_file_name' , $search_key);
							$project_message_file_query = $this->db->get('project_message');

							$this->db->like('file' , $search_key);
							$ticket_file_query = $this->db->get('ticket_message');

							$this->db->like('name' , $search_key);
							$team_task_file_query = $this->db->get('team_task_file');

							$this->db->like('files' , $search_key);
							$quote_file_query = $this->db->get('quote');

							$all_result_for_files = array();

							if ($project_file_query->num_rows() > 0) {
								$project_files = $project_file_query->result_array();
								foreach ($project_files as $row) {
									$data['name']	=	$row['name'];
									$data['link']	=   base_url() . 'uploads/project_file/' . $row['name'];
									array_push($all_result_for_files , $data);
								}
							}

							if ($project_message_file_query->num_rows() > 0) {
								$project_message_files = $project_message_file_query->result_array();
								foreach ($project_message_files as $row) {
									$data['name']	=	$row['message_file_name'];
									$data['link']	=   base_url() . 'uploads/project_message_file/' . $row['message_file_name'];
									array_push($all_result_for_files , $data);
								}
							}

							if ($team_task_file_query->num_rows() > 0) {
								$team_task_files = $team_task_file_query->result_array();
								foreach ($team_task_files as $row) {
									$data['name']	=	$row['name'];
									$data['link']	=   base_url() . 'uploads/team_task_file/' . $row['name'];
									array_push($all_result_for_files , $data);
								}
							}

							if ($quote_file_query->num_rows() > 0) {
								$quote_files = $quote_file_query->result_array();
								foreach ($quote_files as $row) {
									$data['name']	=	$row['files'];
									$data['link']	=   base_url() . 'uploads/quote_file/' . $row['files'];
									array_push($all_result_for_files , $data);
								}
							}
						?>
						<?php 
							if ($all_result_for_files != ''):
								foreach ($all_result_for_files as $row):
						?>
						<tr>
							<td><?php echo $row['name'];?></td>
							<td>
				            	<a href="<?php echo $row['link'];?>" 
				            		class="btn btn-primary btn-xs">
                                	<i class="entypo-download"></i>
                            	</a>
				           </td>
						</tr>
						<?php 
							endforeach;
							endif;
						?>

						<?php if ($all_result_for_files == ''):?>
							<td class="text-center">
								 <strong><?php echo get_phrase('no_results_found');?></strong>
							</td>
						<?php endif;?>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>