<?php $edit_data	=	$this->db->get_where('staff' , array('staff_id' => $param2))->result_array();
foreach ($edit_data as $row):
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('update_informations');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?staff/staff/edit/'.$row['staff_id'], array('class' => 'form-horizontal form-groups-bordered validate ajax-submit', 'enctype' => 'multipart/form-data'));?>
	
					<div class="form-group">
						<label for="field-1" class="col-sm-4 control-label"><?php echo get_phrase('name');?></label>
                        
						<div class="col-sm-7">
                      	<div class="input-group">
								<span class="input-group-addon"><i class="entypo-user"></i></span>
								<input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $row['name'];?>" >
                         </div>
						</div>
					</div>
                    
					<div class="form-group">
						<label for="field-1" class="col-sm-4 control-label"><?php echo get_phrase('account_role');?></label>
						<div class="col-sm-7">
                          <select class="selectboxit" name="account_role_id">
                              <option><?php echo get_phrase('select_a_role');?></option>
                              <?php 
                                  $account_roles		=	$this->db->get('account_role')->result_array();
                                  foreach($account_roles as $row2):
                                  ?>
                                      <option value="<?php echo $row2['account_role_id'];?>"
                                      	<?php if($row['account_role_id'] == $row2['account_role_id'])echo 'selected';?>>
												<?php echo $row2['name'];?></option>
                               <?php
                              endforeach;
                              ?>
                       	</select>
						</div>
					</div>
                    
					<div class="form-group">
						<label for="field-1" class="col-sm-4 control-label"><?php echo get_phrase('email');?></label>
						<div class="col-sm-7">
                      	<div class="input-group ">
								<span class="input-group-addon"><i class="entypo-mail"></i></span>
								<input type="text" class="form-control" name="email" value="<?php echo $row['email'];?>">
                         </div>
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-4 control-label"><?php echo get_phrase('phone');?></label>
                        
						<div class="col-sm-7">
                      	<div class="input-group ">
								<span class="input-group-addon"><i class="entypo-phone"></i></span>
								<input type="text" class="form-control" name="phone" value="<?php echo $row['phone'];?>"  >
							</div>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-4 control-label"><?php echo get_phrase('skype_id');?></label>
                        
						<div class="col-sm-7">
                      	<div class="input-group ">
								<span class="input-group-addon"><i class="entypo-skype"></i></span>
								<input type="text" class="form-control" name="skype_id" value="<?php echo $row['skype_id'];?>" >
                         </div>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-4 control-label"><?php echo get_phrase('facebook_profile_link');?></label>
                        
						<div class="col-sm-7">
                      	<div class="input-group ">
								<span class="input-group-addon"><i class="entypo-facebook-squared"></i></span>
								<input type="text" class="form-control" name="facebook_profile_link" value="<?php echo $row['facebook_profile_link'];?>" >
                         </div>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-4 control-label"><?php echo get_phrase('linkedin_profile_link');?></label>
                        
						<div class="col-sm-7">
                      	<div class="input-group ">
								<span class="input-group-addon"><i class="entypo-linkedin"></i></span>
								<input type="text" class="form-control" name="linkedin_profile_link" value="<?php echo $row['linkedin_profile_link'];?>" >
                         </div>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-4 control-label"><?php echo get_phrase('twitter_profile_link');?></label>
                        
						<div class="col-sm-7">
                      	<div class="input-group ">
								<span class="input-group-addon"><i class="entypo-twitter"></i></span>
								<input type="text" class="form-control" name="twitter_profile_link" value="<?php echo $row['twitter_profile_link'];?>" >
                         </div>
						</div> 
					</div>
	
					<div class="form-group">
						<label for="field-1" class="col-sm-4 control-label"><?php echo get_phrase('photo');?></label>
                        
						<div class="col-sm-7">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
									<img src="<?php echo $this->crud_model->get_image_url('staff' , $row['staff_id']);?>" alt="...">
								</div>
								<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
								<div>
									<span class="btn btn-white btn-file">
										<span class="fileinput-new">Select image</span>
										<span class="fileinput-exists">Change</span>
										<input type="file" name="userfile" accept="image/*">
									</span>
									<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div>
							</div>
						</div>
					</div>
                    
                    <div class="form-group">
						<div class="col-sm-offset-4 col-sm-7">
							<button type="submit" class="btn btn-info" id="submit-button"><?php echo get_phrase('edit_staff');?></button>
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
	var post_refresh_url	=	'<?php echo base_url();?>index.php?staff/reload_staff_list';
	var post_message		=	'Data Updated Successfully';
</script>

<!-- calling ajax form submission plugin for specific form -->
<script src="assets/js/ajax-form-submission.js"></script>