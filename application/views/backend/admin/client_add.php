<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title" >
                    <i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('account_creation_form'); ?>
                </div>
            </div>
            <div class="panel-body">

                <?php echo form_open(base_url() . 'index.php?admin/client/create/', array('class' => 'form-horizontal form-groups-bordered validate ajax-submit', 'enctype' => 'multipart/form-data')); ?>

                <div class="form-group">
                    <label for="field-1" class="col-sm-4 control-label"><?php echo get_phrase('name'); ?></label>

                    <div class="col-sm-7">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="entypo-user"></i></span>
                            <input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" value="" autofocus>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-4 control-label"><?php echo get_phrase('email'); ?></label>
                    <div class="col-sm-7">
                        <div class="input-group ">
                            <span class="input-group-addon"><i class="entypo-mail"></i></span>
                            <input type="text" class="form-control" name="email" value="">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-2" class="col-sm-4 control-label"><?php echo get_phrase('password'); ?></label>

                    <div class="col-sm-7">
                        <div class="input-group ">
                            <span class="input-group-addon"><i class="entypo-key"></i></span>
                            <input type="text" class="form-control" name="password" value="" >
                        </div>
                    </div> 
                </div>

                <div class="form-group">
                    <label for="field-2" class="col-sm-4 control-label"><?php echo get_phrase('address'); ?></label>

                    <div class="col-sm-7">
                        <div class="input-group ">
                            <span class="input-group-addon"><i class="entypo-location"></i></span>
                            <input type="text" class="form-control" name="address" value="" >
                        </div>
                    </div> 
                </div>

                <div class="form-group">
                    <label for="field-2" class="col-sm-4 control-label"><?php echo get_phrase('phone'); ?></label>

                    <div class="col-sm-7">
                        <div class="input-group ">
                            <span class="input-group-addon"><i class="entypo-phone"></i></span>
                            <input type="text" class="form-control" name="phone" value=""  >
                        </div>
                    </div> 
                </div>

                <div class="form-group">
                    <label for="field-2" class="col-sm-4 control-label"><?php echo get_phrase('website'); ?></label>

                    <div class="col-sm-7">
                        <div class="input-group ">
                            <span class="input-group-addon"><i class="entypo-network"></i></span>
                            <input type="text" class="form-control" name="website" value="" >
                        </div>
                    </div> 
                </div>

                <div class="form-group">
                    <label for="field-2" class="col-sm-4 control-label"><?php echo get_phrase('skype_id'); ?></label>

                    <div class="col-sm-7">
                        <div class="input-group ">
                            <span class="input-group-addon"><i class="entypo-skype"></i></span>
                            <input type="text" class="form-control" name="skype_id" value="" >
                        </div>
                    </div> 
                </div>

                <div class="form-group">
                    <label for="field-2" class="col-sm-4 control-label"><?php echo get_phrase('facebook_profile_link'); ?></label>

                    <div class="col-sm-7">
                        <div class="input-group ">
                            <span class="input-group-addon"><i class="entypo-facebook-squared"></i></span>
                            <input type="text" class="form-control" name="facebook_profile_link" value="" >
                        </div>
                    </div> 
                </div>

                <div class="form-group">
                    <label for="field-2" class="col-sm-4 control-label"><?php echo get_phrase('linkedin_profile_link'); ?></label>

                    <div class="col-sm-7">
                        <div class="input-group ">
                            <span class="input-group-addon"><i class="entypo-linkedin"></i></span>
                            <input type="text" class="form-control" name="linkedin_profile_link" value="" >
                        </div>
                    </div> 
                </div>

                <div class="form-group">
                    <label for="field-2" class="col-sm-4 control-label"><?php echo get_phrase('twitter_profile_link'); ?></label>

                    <div class="col-sm-7">
                        <div class="input-group ">
                            <span class="input-group-addon"><i class="entypo-twitter"></i></span>
                            <input type="text" class="form-control" name="twitter_profile_link" value="" >
                        </div>
                    </div> 
                </div>


                <div class="form-group">
                    <label for="field-2" class="col-sm-4 control-label"><?php echo get_phrase('short_note'); ?></label>

                    <div class="col-sm-7">
                        <div class="input-group ">
                            <span class="input-group-addon"><i class="entypo-pencil"></i></span>
                            <textarea class="form-control autogrow" name="short_note" style="height:48px;"></textarea>
                        </div>
                    </div> 
                </div>


                <div class="form-group">
                    <label for="field-1" class="col-sm-4 control-label"><?php echo get_phrase('photo'); ?></label>

                    <div class="col-sm-7">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                <img src="uploads/user.jpg" alt="...">
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
                    <label for="field-1" class="col-sm-4 control-label"></label>

                    <div class="col-sm-7">
                        <div class="checkbox checkbox-replace color-blue">
                            <input type="checkbox" name="notify_check" id="notify" value="yes" checked>
                            <label> <?php echo get_phrase('notify_client'); ?></label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-7">
                        <button type="submit" class="btn btn-info" id="submit-button"><?php echo get_phrase('add_client'); ?></button>
                        <span id="preloader-form"></span>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<script>
    // url for refresh data after ajax form submission
    var post_refresh_url = '<?php echo base_url(); ?>index.php?admin/reload_client_list';
    var post_message = 'Data Created Successfully';
</script>

<!-- calling ajax form submission plugin for specific form -->
<script src="assets/js/ajax-form-submission.js"></script>