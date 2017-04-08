<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_new_company');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?staff/company/create/' , array('class' => 'form-horizontal form-groups-bordered validate ajax-submit', 'enctype' => 'multipart/form-data'));?>
	
					<div class="form-group">
						<label for="field-1" class="col-sm-4 control-label"><?php echo get_phrase('name');?></label>
                        
						<div class="col-sm-7">
                      	<div class="input-group">
								<span class="input-group-addon"><i class="entypo-star"></i></span>
								<input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus>
                         </div>
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-4 control-label"><?php echo get_phrase('address');?></label>
                        
						<div class="col-sm-7">
                      	<div class="input-group">
								<span class="input-group-addon"><i class="entypo-location"></i></span>
								<input type="text" class="form-control" name="address">
                         </div>
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-4 control-label"><?php echo get_phrase('phone');?></label>
                        
						<div class="col-sm-7">
                      	<div class="input-group">
								<span class="input-group-addon"><i class="entypo-phone"></i></span>
								<input type="text" class="form-control" name="phone">
                         </div>
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-4 control-label"><?php echo get_phrase('email');?></label>
                        
						<div class="col-sm-7">
                      	<div class="input-group">
								<span class="input-group-addon"><i class="entypo-mail"></i></span>
								<input type="text" class="form-control" name="email">
                         </div>
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-4 control-label"><?php echo get_phrase('website');?></label>
                        
						<div class="col-sm-7">
                      	<div class="input-group">
								<span class="input-group-addon"><i class="entypo-globe"></i></span>
								<input type="text" class="form-control" name="website">
                         </div>
						</div>
					</div>

					<div class="form-group">
	                    <label for="field-1" class="col-sm-4 control-label"><?php echo get_phrase('associated_person'); ?></label>

	                    <div class="col-sm-7">
	                        <select name="client_id" class="select2">
	                            <option><?php echo get_phrase('select_associated_person'); ?></option>
	                            <?php
	                            $clients = $this->db->get('client')->result_array();
	                            foreach ($clients as $row):
	                                ?>
	                                <option value="<?php echo $row['client_id']; ?>">
	                                    <?php echo $row['name']; ?></option>
	                            <?php endforeach; ?>
	                        </select>
	                    </div>
	                </div>
                    
                    <div class="form-group">
						<div class="col-sm-offset-4 col-sm-7">
							<button type="submit" class="btn btn-info" id="submit-button"><?php echo get_phrase('add_company');?></button>
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
	var post_refresh_url	=	'<?php echo base_url();?>index.php?staff/reload_company_list';
	var post_message		=	'Data Created Successfully';
</script>

<!-- calling ajax form submission plugin for specific form -->
<script src="assets/js/ajax-form-submission.js"></script>

<script type="text/javascript">
	// Select2 Dropdown replacement
    if($.isFunction($.fn.select2))
    {
        $(".select2").each(function(i, el)
        {
            var $this = $(el),
                opts = {
                    allowClear: attrDefault($this, 'allowClear', false)
                };
            
            $this.select2(opts);
            $this.addClass('visible');
            
            //$this.select2("open");
        });
    }
</script>