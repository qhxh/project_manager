<?php
$ticket_code	=	$param2;
$ticket_data	=	$this->db->get_where('ticket' , array('ticket_code' => $ticket_code))->result_array();
foreach ($ticket_data as $row):
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('update_ticket_status');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?staff/support_ticket/update_status/'.$ticket_code , 
						array('class' => 'form-horizontal form-groups-bordered validate ticket-update', 
								'enctype' => 'multipart/form-data'));?>
	
					<div class="form-group">
						<label for="field-1" class="col-sm-4 control-label"><?php echo get_phrase('ticket_status');?></label>
                        
						<div class="col-sm-6">
							<select name="status" class="selectboxit">
                                <option value="opened" <?php if ($row['status'] == 'opened') echo 'selected';?>>
                                		<?php echo get_phrase('opened');?></option>
                                <option value="closed" <?php if ($row['status'] == 'closed') echo 'selected';?>>
                                		<?php echo get_phrase('closed');?></option>
                         </select>
						</div>
					</div>
	
					
                    
                  <div class="form-group">
						<div class="col-sm-offset-4 col-sm-6">
							<button type="submit" class="btn btn-info" id="submit-button">
								<?php echo get_phrase('update_status');?></button>
                         <span id="preloader-form"></span>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>
<div class="progress progress-striped active" id="progress_bar_holder" style="visibility:hidden;">
    <div class="progress-bar progress-bar-info" id="progress_bar" style="width:0%; ">
    </div>
</div>
<script>
	$(document).ready(function() { 
	
		var options = { 
			beforeSubmit		:	validate_ticket,  
			success				:	show_response_update_ticket,  
			resetForm			:	true 
		}; 
		$('.ticket-update').submit(function() { 
			$(this).ajaxSubmit(options); 
			return false; 
		}); 
	}); 
	function validate_ticket(formData, jqForm, options) { 
		
		
		$('#preloader-form').html('<img src="assets/images/preloader.gif" style="height:15px;margin-left:20px;" />');
		document.getElementById("submit-button").disabled=true;
	}
	
	function show_response_update_ticket(responseText, statusText, xhr, $form)  { 
		
		// calling ticket body reload function
		reload_ticket_view_body();
		
		$('#preloader-form').html('');
		toastr.success("Ticket updated", "Success");
		$('#modal_ajax').modal('hide');
		document.getElementById("submit-button").disabled=false;
		
	}
</script>

<?php endforeach;?>