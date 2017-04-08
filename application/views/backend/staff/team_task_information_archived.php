<div class="col-md-3">

		
		<?php
			$this->db->where('task_status' , 0);
			$this->db->order_by('creation_timestamp', 'desc');
			$query	=	$this->db->get('team_task');
			if ($query->num_rows() > 0):
				$team_tasks = $query->result_array();
				foreach ($team_tasks as $row):
                    if (!in_array($this->session->userdata('login_user_id') , explode(',' , $row['assigned_staff_ids'])))
                        continue;
		?>
		<a style="text-align: left;" href="<?php echo base_url();?>index.php?staff/team_task_view/<?php echo $row['team_task_id'];?>" 
			class="<?php if ($row['team_task_id'] == $team_task_id) 
								echo 'btn btn-primary';
							else 
								echo 'btn btn-default';?> btn-block">
			
			<i class="entypo-right-open"></i> <?php echo $row['task_title'];?>
		</a>
		<?php 
			endforeach;
				endif;
		?>

</div>

<?php 
	$team_task_details	=	$this->db->get_where('team_task' , array(
		'team_task_id' => $team_task_id
	))->result_array();
	foreach ($team_task_details as $row):
?>


<div class="col-md-6">
	<div class="panel panel-primary" data-collapsed="0">
			
		<!-- panel head -->
		<div class="panel-heading">
			<div class="panel-title">
				<?php echo $row['task_title'];?>
			</div>
			
		</div>
		
		<!-- panel body -->
		<div class="panel-body" style="padding:5px; background-color: #FFFCEE;">
			
			<?php echo form_open(base_url() . 'index.php?staff/save_task_note/' . $row['team_task_id'] , array('class' => 'task-note-save'));?>
			
					
				<div class="form-group">
        			<div class="col-md-12" style="padding:0px; background-color: #FFFCEE;">
                        <textarea class="form-control autogrow" rows="10" style="padding: 5px; border:0px; background-color: #FFFCEE;"  
                        	name="task_note" placeholder="Write task note......"><?php echo $row['task_note'];?></textarea>
                    </div>
                </div>
		</div>
				
	</div>
	
		<button type="submit" class="btn btn-info" id="submit-button"><?php echo get_phrase('save_note'); ?></button>

		<?php echo form_close();?>
</div>

<div class="col-md-3">

    <div class="alert alert-warning">
        <?php echo get_phrase('archived_task');?>
        
    </div>

	<div class="panel panel-primary" data-collapsed="0">
		<!-- panel body -->
		<div class="panel-body">
			<table width="100%">
				<tr>
					<td><?php echo get_phrase('date_created');?></td>
					<td> : </td>
					<td> <?php echo date('d/m/Y', $row['creation_timestamp']);?></td>
				</tr>
				<tr>
					<td><?php echo get_phrase('due_date');?></td>
					<td>:</td>
					<td><?php echo date('d/m/Y', $row['due_timestamp']);?></td>
				</tr>
			</table>
		</div>
	</div>

	<?php 
		$staffs = ( explode(',', $row['assigned_staff_ids']));
            $number_of_staffs = count($staffs) - 1;
	?>
	<div class="panel panel-primary" data-collapsed="0">
        <div class="panel-heading">
            <div class="panel-title"><i class="entypo-users"></i> <?php echo get_phrase('assigned_staff'); ?></div>
            
        </div>
        <div class="panel-body" style="padding: 5px;">
        
            <?php
            if ($number_of_staffs > 0):
                for ($i = 0; $i < $number_of_staffs; $i++):
                    $staff_data = $this->db->get_where('staff', array('staff_id' => $staffs[$i]))->result_array();
                    foreach ($staff_data as $row2):
                        ?>
                            <a href="#" class="tooltip-primary" data-toggle="tooltip" 
                            	data-placement="top" data-original-title="<?php echo $row2['name'];?>">        
                                <img src="<?php echo $this->crud_model->get_image_url('staff', $row2['staff_id']); ?>" 
                                    alt="" class="img-circle" width="41">
                            </a>       
                        <?php
                    endforeach;
                endfor;
            endif;
            ?>
            <!--staff list ends here -->
        </div>
    </div>

    <?php 
    	$this->db->order_by('team_task_file_id', 'desc');
        $team_task_files = $this->db->get_where('team_task_file', array('team_task_id' => $row['team_task_id']));
    ?>
    <div class="panel panel-primary" style="padding:0px;">
        <div class="panel-heading">
            <div class="panel-title" style="width:100%;">
                <i class="entypo-docs"></i>
                <?php echo get_phrase('files'); ?>
                <?php if ($team_task_files->num_rows() > 0):?>
                    <a href="#" class="btn btn-default btn-xs pull-right tooltip-primary" data-toggle="tooltip"  data-placement="left"
                            data-placement="top" title="" data-original-title="<?php echo get_phrase('upload_file'); ?>"
                            onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/team_task_file_add_archived/<?php echo $row['team_task_id']; ?>');">
                        <i class="entypo-upload"></i>
                    </a>
            	<?php endif;?>
            </div>
        </div>
        <div class="panel-body" style="padding:0px;">
                
            <table class="table table-striped">
                
                    <?php
                        if ($team_task_files->num_rows() > 0):
                        	$files = $team_task_files->result_array();
                        foreach ($files as $row3):
                    ?>
                        <tr>
                            <td style="padding: 8px 0px 0px 3px;"><i class="entypo-down"></i></td>
                            <td style="padding: 8px 20px 0px 0px;">
                            	<a href="<?php echo base_url(); ?>index.php?staff/team_task_file/download/<?php echo $row3['team_task_file_id']; ?>">
                            	<?php 	if (strlen($row3['name']) >= 22)
                                   			echo substr($row3['name'] , 0 , 20) . '....';
                                   		if (strlen($row3['name']) < 20)
                                   			echo $row3['name'];

                                ?>  
                                </a>
                                
                            </td>
                            <td align="right">
                                <a href="#"
                                	onclick="confirm_modal('<?php echo base_url(); ?>index.php?staff/team_task_file/delete/<?php echo $row3['team_task_file_id']; ?>', '<?php echo base_url(); ?>index.php?staff/reload_team_task_information_archived/<?php echo $row['team_task_id']; ?>');">
                                    <i class="entypo-cancel-circled"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach;
                    endif;
                    ?>

                    <?php if ($team_task_files->num_rows() < 1):?>
                    	<a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/team_task_file_add_archived/<?php echo $row['team_task_id']; ?>');">
                    		<button style="margin-top: 15px;" class="btn btn-default btn-block" type="button">
                    			<i class="entypo-upload"></i>	<?php echo get_phrase('upload_files');?>
                    		</button>
                    	</a>
                    <?php endif;?>

                
            </table>
        </div>
    </div>
	
</div>


<?php endforeach;?>



<script src="assets/js/jquery.form.js"></script>
<script>
    $(document).ready(function () {

        var options = {
            //beforeSubmit: validate_team_task_file_add,
            //uploadProgress: show_upload_progress,
            success: show_response_on_task_note_save,
            resetForm: true
        };
        $('.task-note-save').submit(function () {
            $(this).ajaxSubmit(options);
            return false;
        });
    });

    function show_response_on_task_note_save(responseText, statusText, xhr, $form) {

        // calling project monitor reload function
        reload_team_task_information_archived('<?php echo base_url(); ?>index.php?staff/reload_team_task_information_archived/<?php echo $team_task_id; ?>');


    }

    //reload the project page data after successfull update
    function reload_team_task_information_archived(url)
    {
        $.ajax({
            url: url,
            success: function (response)
            {
                jQuery('.main_data').html(response);

                // Auto Size for Textarea
				$("textarea.autogrow, textarea.autosize").autosize();

				// calls the tooltip again on ajax success
				$('[data-toggle="tooltip"]').each(function(i, el)
				{
					var $this = $(el),
						placement = attrDefault($this, 'placement', 'top'),
						trigger = attrDefault($this, 'trigger', 'hover'),
						popover_class = $this.hasClass('tooltip-secondary') ? 'tooltip-secondary' : ($this.hasClass('tooltip-primary') ? 'tooltip-primary' : ($this.hasClass('tooltip-default') ? 'tooltip-default' : ''));
					
					$this.tooltip({
						placement: placement,
						trigger: trigger
					});

					$this.on('shown.bs.tooltip', function(ev)
					{
						var $tooltip = $this.next();
						
						$tooltip.addClass(popover_class);
					});
				});
				
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
            toastr.info("File deleted successfully.", "Success");
            
            // hide the delete dialog box
            $('#modal_delete').modal('hide');
            
            // enables the delete and cancel button after deletion ajax request success
            document.getElementById("delete_link").disabled=false;
            document.getElementById("delete_cancel_link").disabled=false;
    
            
            reload_team_task_information_archived('<?php echo base_url(); ?>index.php?staff/reload_team_task_information_archived/<?php echo $team_task_id; ?>');
        }
    });
}
</script>