<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title" >
                    <i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('category add form'); ?>
                </div>
            </div>
            <div class="panel-body">

                <?php echo form_open(base_url() . 'index.php?admin/cat_add', array('class' => 'form-horizontal form-groups-bordered validate ajax-submit', 'enctype' => 'multipart/form-data')); ?>

                <div class="form-group">
                    <label for="field-1" class="col-sm-4 control-label"><?php echo get_phrase('name'); ?></label>

                    <div class="col-sm-7">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="entypo-user"></i></span>
                            <input type="text" class="form-control" name="cat_name" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" value="" autofocus>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('description'); ?></label>

                    <div class="col-sm-8">
                        <textarea class="form-control wysihtml5" rows="10" name="cat_description" id="post_content" 
                                  data-stylesheet-url="assets/css/wysihtml5-color.css"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-2" class="col-sm-4 control-label"><?php echo get_phrase('budget'); ?></label>

                    <div class="col-sm-7">
                        <div class="input-group ">
                            <span class="input-group-addon"><i class="entypo-key"></i></span>
                             <input type="text" class="form-control" name="cat_budget" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" value="">
                        </div>
                    </div> 
                </div>

                <div class="form-group">
                    <label for="field-2" class="col-sm-4 control-label"><?php echo get_phrase('time'); ?></label>

                    <div class="col-sm-7">
                        <div class="input-group ">
                            <span class="input-group-addon"><i class="entypo-location"></i></span>
                            <input type="text" class="form-control" name="cat_time" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" value="">
                        </div>
                    </div> 
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-7">
                        <button type="submit" class="btn btn-info" id="submit-button"><?php echo get_phrase('add_category'); ?></button>
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
    var post_refresh_url = '<?php echo base_url(); ?>index.php?admin/cat_reload_list';
    var post_message = 'Data Created Successfully';
</script>

<!-- calling ajax form submission plugin for specific form -->
<script src="assets/js/ajax-form-submission.js"></script>
<!-- ajax -->
