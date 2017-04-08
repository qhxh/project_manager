
<table class="table table-bordered datatable">
	<thead>
		<tr>
			<th style="width:30px;">
           	
      </th>
			<th><div><?php echo get_phrase('project');?></div></th>
			<th><div><?php echo get_phrase('company');?></div></th>
			<th><div><?php echo get_phrase('progress');?></div></th>
			<th><div><?php echo get_phrase('options');?></div></th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$counter = 1;
		$this->db->where('project_status' , 0);
        $this->db->where('client_id' , $this->session->userdata('login_user_id'));
		$this->db->order_by('project_id' , 'desc');
		$projects	=	$this->db->get('project')->result_array();
		foreach($projects as $row):
		?>
		<tr>
			<td style="width:30px;">
           		<?php echo $counter++;?>
           	</td>
			<td>
				<a href="<?php echo base_url();?>index.php?client/projectroom/wall/<?php echo $row['project_code'];?>">
					<?php echo $row['title'];?>
               </a>
           </td>
            <td>
            	<?php
            		if ($row['company_id'] > 0)
            			echo $this->db->get_where('company' , array('company_id' => $row['company_id']))->row()->name;
            	?>
            </td>
			<td>
            	<?php 
				$status = 'info';
				if ($row['progress_status'] == 100)$status = 'success';
				if ($row['progress_status'] < 50)$status = 'danger';
				?>
              
              <div class="progress progress-striped <?php if ($row['progress_status']!=100)echo 'active';?> tooltip-primary" 
                      style="height:3px !important; cursor:pointer;"  data-toggle="tooltip"  data-placement="top"
                          title="" data-original-title="<?php echo $row['progress_status'];?>% completed" >
                  <div class="progress-bar progress-bar-<?php echo $status;?>" 
                  	role="progressbar" aria-valuenow="<?php echo $row['progress_status'];?>" 
                    		aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $row['progress_status'];?>%">
                      <span class="sr-only">40% Complete (success)</span>
                  </div>
              </div> 
           </td>
			<td>
            	<a class="btn btn-info tooltip-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo get_phrase('project_room');?>" 
            		href="<?php echo base_url();?>index.php?client/projectroom/wall/<?php echo $row['project_code'];?>">
                	<i class="entypo-target"></i>
               </a>
            	
			</td>
		</tr>
		<?php endforeach;?>
	</tbody>
</table>

<script type="text/javascript">




	jQuery(document).ready(function ($)
    {
        var datatable = $(".datatable").dataTable({
            "sPaginationType": "bootstrap",
            "aoColumns": [
                {"bSortable": false},
                null,
                null,
                null,
                null
            ],
            aLengthMenu: [
            [-1 , 25 , 50 , 100 , 200],
            ["All" , 25 , 50 , 100 , 200]
            ],
        });

        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });

    });
		
</script>

<script src="assets/js/neon-custom-ajax.js"></script>