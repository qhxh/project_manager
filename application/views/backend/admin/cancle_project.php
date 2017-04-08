
<table class="table table-bordered datatable">
	<thead>
		<tr>
			<th style="width:30px;">
           	
           	</th>
			<th><div><?php echo get_phrase('project');?></div></th>
			<th><div><?php echo get_phrase('client');?></div></th>
			<th><div><?php echo get_phrase('company');?></div></th>
			<th><div><?php echo get_phrase('progress');?></div></th>
			<th><div><?php echo get_phrase('options');?></div></th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$counter = 1;
		$this->db->where('project_status =' , 4);
		$this->db->order_by('project_id' , 'desc');
		$projects	=	$this->db->get('project')->result_array();
		foreach($projects as $row):
		?>
		<tr>
			<td style="width:30px;">
           		<?php echo $counter++;?>
           	</td>
			<td>
				<a href="<?php echo base_url();?>index.php?admin/projectroom/wall/<?php echo $row['project_code'];?>">
					<?php echo $row['title'];?>
               </a>
           </td>
			<td>
				<?php if ($row['client_id'] > 0)
					echo $this->db->get_where('client' , array('client_id'=>$row['client_id']))->row()->name;?>
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
            		href="<?php echo base_url();?>index.php?admin/projectroom/wall/<?php echo $row['project_code'];?>">
                	<i class="entypo-target"></i>
                </a>
               
                <a class="btn btn-white tooltip-primary" data-toggle="tooltip" data-placement="top" 
              		title="" data-original-title="<?php echo get_phrase('delete_project');?>" href="#" 
                    	onclick="confirm_modal('<?php echo base_url();?>index.php?admin/project/delete/<?php echo $row['project_code'];?>' , '<?php echo base_url();?>index.php?admin/reload_project_list');" >
                  		<i class="entypo-trash"></i>
                </a>

                <a id="archive_link" class="btn btn-default tooltip-primary" data-toggle="tooltip" data-placement="top" 
              		title="" data-original-title="<?php echo get_phrase('mark_as_archive');?>" href="#"
              			onclick="mark_archived('<?php echo base_url();?>index.php?admin/project/mark_as_archive/<?php echo $row['project_code'];?>' , '<?php echo base_url();?>index.php?admin/reload_project_list');">
                  		<i class="entypo-archive"></i>
                </a>
            	
			</td>
		</tr>
		<?php endforeach;?>
	</tbody>
</table>

<script src="assets/js/neon-custom-ajax.js"></script>

<script type="text/javascript">

	// custom function for reloading table data
function reload_data(url)
{
    $.ajax({
        url: url,
        success: function(response)
        {
            // Replace new page data
            jQuery('.main_data').html(response);

        }
    });
}

function mark_archived(archive_url , post_refresh_url)
{
	$.ajax({
        url: archive_url,
        success: function(response)
        {
            
            toastr.info("Marked as Archived", "Success");
            // reload the table
            reload_data(post_refresh_url);
        }
    });
}

function remove_archived(remove_archive_url , post_refresh_url)
{
  $.ajax({
        url: remove_archive_url,
        success: function(response)
        {
            
            toastr.info("Removed from Archive", "Success");
            // reload the table
            reload_data(post_refresh_url);
        }
    });
}

// custom function for data deletion by ajax and post refreshing call
function delete_data(delete_url , post_refresh_url)
{
    // showing user-friendly pre-loader image
    $('#preloader-delete').html('<img src="assets/images/preloader.gif" style="height:15px;margin-top:-10px;" />');
    
    // disables the delete and cancel button during deletion ajax request
    document.getElementById("delete_link").disabled=true;
    document.getElementById("delete_cancel_link").disabled=true;
    
    $.ajax({
        url: delete_url,
        success: function(response)
        {
            // remove the preloader 
            $('#preloader-delete').html('');
            
            // show deletion success msg.
            toastr.info("Data deleted successfully.", "Success");
            
            // hide the delete dialog box
            $('#modal_delete').modal('hide');
            
            // enables the delete and cancel button after deletion ajax request success
            document.getElementById("delete_link").disabled=false;
            document.getElementById("delete_cancel_link").disabled=false;
    
            // reload the table
            reload_data(post_refresh_url);
        }
    });
}
</script>