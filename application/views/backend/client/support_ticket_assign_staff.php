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
					<?php echo get_phrase('assign_staff_for_ticket');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open('admin/support_ticket/assign_staff/'.$ticket_code , 
						array('class' => 'form-horizontal form-groups-bordered validate ticket-update', 
								'enctype' => 'multipart/form-data'));?>
	
					<div class="form-group">
						<label for="field-1" class="col-sm-4 control-label"><?php echo get_phrase('staff_list');?></label>
                        
						<div class="col-sm-6">
							<select name="staff_id" class="selectboxit">
                            <option value=""><?php echo get_phrase('select_a_staff');?></option>
                            <?php 
                                $staffs		=	$this->db->get('staff')->result_array();
                                foreach ($staffs as $row2):
                                ?>
                                <option value="<?php echo $row2['staff_id'];?>"
                                		<?php if ($row['assigned_staff_id'] == $row2['staff_id']) echo 'selected';?>>
                                        <?php echo $row2['name'];?></option>
                            <?php endforeach;?>
                         </select>
						</div>
					</div>
	
					<div class="form-group">
						<label for="field-1" class="col-sm-4 control-label"></label>
                        
						<div class="col-sm-7">
                        	<div class="checkbox checkbox-replace color-blue">
								<input type="checkbox" name="notify_check" id="notify" value="yes" checked>
								<label> <?php echo get_phrase('notify_staff');?></label>
							</div>
						</div>
					</div>
                    
                  	<div class="form-group">
						<div class="col-sm-offset-4 col-sm-6">
							<button type="submit" class="btn btn-info" id="submit-button">
								<?php echo get_phrase('assign_staff');?></button>
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