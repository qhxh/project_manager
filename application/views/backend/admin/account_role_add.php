<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('account_role_creation_form');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/account_role/create/' , array('class' => 'form-horizontal form-groups validate ajax-submit', 'enctype' => 'multipart/form-data'));?>
	
					<div class="form-group">
						<label for="field-1" class="col-sm-4 control-label"><?php echo get_phrase('role_name');?></label>
                        
						<div class="col-sm-7">
                      	<div class="input-group">
								<span class="input-group-addon"><i class="entypo-user"></i></span>
								<input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus placeholder="e.g. manager,support staff">
                         </div>
						</div>
					</div>
					<hr />
                  <center>
                  	<span class="badge "><?php echo get_phrase('permissions');?></span>
                  </center><br>
                  <?php 
				  	$account_roles	=	$this->db->get('account_permission')->result_array();
					foreach ($account_roles as $row):
					?>
					<div class="form-group">
						<label for="field-1" class="col-sm-5 control-label"><?php echo $row['name'];?></label>
                        
						<div class="col-sm-6">
                      	<div class="make-switch">
							    <input type="checkbox" name="permission[]" value="<?php echo $row['account_permission_id'];?>">
							</div>
                         <i class="entypo-info-circled popover-primary" style="margin-left:20px;" 
                         		data-toggle="popover" data-trigger="hover" data-placement="top" 
                                	data-content="<?php echo $row['description'];?>" 
                                    data-original-title="<?php echo $row['name'];?>">
                                    	</i>
						</div>
					</div>
                  <?php
				  	endforeach;
					?>
                    
					
                    
                    <div class="form-group">
						<div class="col-sm-offset-4 col-sm-7">
							<button type="submit" class="btn btn-info" id="submit-button"><?php echo get_phrase('add_account_role');?></button>
                         <span id="preloader-form"></span>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>

<script>
	// url for refresh data after ajax form submission
	var post_refresh_url	=	'<?php echo base_url();?>index.php?admin/reload_account_role_list';
	var post_message		=	'Data Created Successfully';
</script>

<!-- calling ajax form submission plugin for specific form -->
<script src="assets/js/ajax-form-submission.js"></script>

<!-- switch ui for checkbox -->
<script src="assets/js/bootstrap-switch.min.js"></script>