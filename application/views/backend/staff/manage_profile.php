<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" >
            <div class="panel-heading">
                <div class="panel-title">
                    <?php echo get_phrase('edit_profile');?>
                </div>
            </div>
            <div class="panel-body">
                <?php 
                foreach($edit_data as $row):
                    ?>
                    <?php echo form_open(base_url() . 'index.php?staff/manage_profile/update_profile_info' , array('class' => 'form-horizontal form-groups validate','target'=>'_top', 'enctype' => 'multipart/form-data'));?>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                            <div class="col-sm-5">
                                <div class="input-group ">
                                    <span class="input-group-addon"><i class="entypo-user"></i></span>
                                    <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('email');?></label>
                            <div class="col-sm-5">
                                <div class="input-group ">
                                    <span class="input-group-addon"><i class="entypo-mail"></i></span>
                                    <input type="text" class="form-control" name="email" value="<?php echo $row['email'];?>"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('phone'); ?></label>

                            <div class="col-sm-5">
                                <div class="input-group ">
                                    <span class="input-group-addon"><i class="entypo-phone"></i></span>
                                    <input type="text" class="form-control" name="phone" value="<?php echo $row['phone'];?>"  >
                                </div>
                            </div> 
                        </div>

                        <div class="form-group">
                            <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('skype_id'); ?></label>

                            <div class="col-sm-5">
                                <div class="input-group ">
                                    <span class="input-group-addon"><i class="entypo-skype"></i></span>
                                    <input type="text" class="form-control" name="skype_id" value="<?php echo $row['skype_id'];?>" >
                                </div>
                            </div> 
                        </div>

                        <div class="form-group">
                            <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('facebook_profile_link'); ?></label>

                            <div class="col-sm-5">
                                <div class="input-group ">
                                    <span class="input-group-addon"><i class="entypo-facebook-squared"></i></span>
                                    <input type="text" class="form-control" name="facebook_profile_link" value="<?php echo $row['facebook_profile_link'];?>" >
                                </div>
                            </div> 
                        </div>

                        <div class="form-group">
                            <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('linkedin_profile_link'); ?></label>

                            <div class="col-sm-5">
                                <div class="input-group ">
                                    <span class="input-group-addon"><i class="entypo-linkedin"></i></span>
                                    <input type="text" class="form-control" name="linkedin_profile_link" value="<?php echo $row['linkedin_profile_link'];?>" >
                                </div>
                            </div> 
                        </div>

                        <div class="form-group">
                            <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('twitter_profile_link'); ?></label>

                            <div class="col-sm-5">
                                <div class="input-group ">
                                    <span class="input-group-addon"><i class="entypo-twitter"></i></span>
                                    <input type="text" class="form-control" name="twitter_profile_link" value="<?php echo $row['twitter_profile_link'];?>" >
                                </div>
                            </div> 
                        </div>


                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('image'); ?></label>

                            <div class="col-sm-5">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                        <img src="<?php echo $this->crud_model->get_image_url('staff' , $row['staff_id']);?>" alt="...">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                    <div>
                                        <span class="btn btn-white btn-file">
                                            <span class="fileinput-new">Select image</span>
                                            <span class="fileinput-exists">Change</span>
                                            <input type="file" name="image" accept="image/*">
                                        </span>
                                        <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                
                        <div class="form-group">
                          <div class="col-sm-offset-3 col-sm-5">
                              <button type="submit" class="btn btn-info"><?php echo get_phrase('update_profile');?></button>
                          </div>
                        </div>
                    </form>
                    <?php
                endforeach;
                ?>
            </div>
        </div>
    </div>
</div>
    

<!--password-->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" >
            <div class="panel-heading">
                <div class="panel-title">
                    <?php echo get_phrase('change_password');?>
                </div>
            </div>
            <div class="panel-body">
                    <?php 
                    foreach($edit_data as $row):
                        ?>
                        <?php echo form_open(base_url() . 'index.php?staff/manage_profile/change_password' , array('class' => 'form-horizontal form-groups validate','target'=>'_top'));?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('current_password');?></label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" name="password" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('new_password');?></label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" name="new_password" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('confirm_new_password');?></label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" name="confirm_new_password" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('update_password');?></button>
                              </div>
                                </div>
                        </form>
                        <?php
                    endforeach;
                    ?>
            </div>
        </div>
    </div>
</div>