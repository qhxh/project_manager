<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title" >
                    <i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('ticket_form'); ?>
                </div>
            </div>
            <div class="panel-body">

                <?php echo form_open(base_url() . 'index.php?client/support_ticket/create/', array('class' => 'form-horizontal form-groups-bordered validate ticket-add', 'enctype' => 'multipart/form-data')); ?>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('ticket_title'); ?></label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="title" id="title" data-validate="required" 
                               data-message-required="<?php echo get_phrase('value_required'); ?>" value="" autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('project'); ?></label>

                    <div class="col-sm-5">
                        <select name="project_id" class="selectboxit">
                            <option><?php echo get_phrase('select_a_project'); ?></option>
                            <?php
                            $projects = $this->db->get_where('project' , array('client_id' => $this->session->userdata('login_user_id')))->result_array();
                            foreach ($projects as $row):
                                ?>
                                <option value="<?php echo $row['project_id']; ?>">
                                    <?php echo $row['title']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                
                

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('priority'); ?></label>

                    <div class="col-sm-5">
                        <select name="priority" class="selectboxit">
                            <option value="low"><?php echo get_phrase('low'); ?></option>
                            <option value="medium"><?php echo get_phrase('medium'); ?></option>
                            <option value="high"><?php echo get_phrase('high'); ?></option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('description'); ?></label>

                    <div class="col-sm-8">
                        <textarea class="form-control wysihtml5" rows="10" name="description" id="post_content" 
                                  data-stylesheet-url="assets/css/wysihtml5-color.css"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('select_file'); ?></label>

                    <div class="col-sm-6">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <span class="btn btn-primary btn-file">
                                <span class="fileinput-new"><?php echo get_phrase('choose'); ?></span>
                                <span class="fileinput-exists"><?php echo get_phrase('change'); ?></span>
                                <input type="file" name="file" id="userfile">
                            </span>
                            <span class="fileinput-filename"></span>
                            <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-8">
                        <button type="submit" class="btn btn-info" id="submit-button">
                            <?php echo get_phrase('submit_support_ticket'); ?></button>
                        <span id="preloader-form"></span>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>




<script>
    $(document).ready(function () {

        var options = {
            beforeSubmit: validate_ticket_add,
            success: show_response_ticket_add,
            resetForm: true
        };
        $('.ticket-add').submit(function () {
            $(this).ajaxSubmit(options);
            return false;
        });
    });
    function validate_ticket_add(formData, jqForm, options) {

        if (!jqForm[0].title.value)
        {
            return false;
        }
        $('#preloader-form').html('<img src="assets/images/preloader.gif" style="height:15px;margin-left:20px;" />');
        document.getElementById("submit-button").disabled = true;
    }

    function show_response_ticket_add(responseText, statusText, xhr, $form) {
        $('#preloader-form').html('');
        toastr.success("Support ticket submitted successfully", "Success");
        document.getElementById("submit-button").disabled = false;
    }


</script>