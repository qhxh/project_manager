<?php $edit_data	=	$this->db->get_where('account_role' , array('account_role_id' => $param2))->result_array();
foreach ($edit_data as $row):
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('account_creation_form');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?staff/account_role/edit/'.$row['account_role_id'], array('class' => 'form-horizontal form-groups-bordered validate ajax-submit', 'enctype' => 'multipart/form-data'));?>
	
					<div class="form-group">
						<label for="field-1" class="col-sm-4 control-label"><?php echo get_phrase('name');?></label>
                        
						<div class="col-sm-7">
                      	<div class="input-group">
								<span class="input-group-addon"><i class="entypo-user"></i></span>
								<input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $row['name'];?>" >
                         </div>
						</div>
					</div>
                    
					<hr />
                  <center>
                  	<span class="badge "><?php echo get_phrase('permissions');?></span>
                  </center><br>
                  <?php 
				  	$account_roles	=	$this->db->get('account_permission')->result_array();
					foreach ($account_roles as $row2):
					?>
					<div class="form-group">
						<label for="field-1" class="col-sm-5 control-label"><?php echo $row2['name'];?></label>
                        
						<div class="col-sm-6">
                      	<div class="make-switch">
							    <input type="checkbox" name="permission[]" value="<?php echo $row2['account_permission_id'];?>"
                                <?php if (in_array($row2['account_permission_id'] , explode(',' , $row['account_permissions']) ) )
											echo 'checked';?> >
							</div>
                         <i class="entypo-info-circled popover-primary" style="margin-left:20px;" 
                         		data-toggle="popover" data-trigger="hover" data-placement="top" 
                                	data-content="<?php echo $row2['description'];?>" 
                                    data-original-title="<?php echo $row2['name'];?>">
                                    	</i>
						</div>
					</div>
                  <?php
				  	endforeach;
					?>
                    
                    <div class="form-group">
						<div class="col-sm-offset-4 col-sm-7">
							<button type="submit" class="btn btn-info" id="submit-button"><?php echo get_phrase('edit_account_role');?></button>
                         <span id="preloader-form"></span>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>
<?php endforeach;?>
<script>
	// url for refresh data after ajax form submission
	var post_refresh_url	=	'<?php echo base_url();?>index.php?staff/reload_account_role_list';
	var post_message		=	'Data Updated Successfully';
</script>

<!-- calling ajax form submission plugin for specific form -->
<script src="assets/js/ajax-form-submission.js"></script>

<!-- switch ui for checkbox -->
<script src="assets/js/bootstrap-switch.min.js"></script>