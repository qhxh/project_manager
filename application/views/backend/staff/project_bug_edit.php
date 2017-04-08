<?php 
    $edit = $this->db->get_where('project_bug' , array('project_bug_id' => $param2))->result_array();
    foreach ($edit as $row):
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title" >
                    <i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('edit_project_bug'); ?>
                </div>
            </div>
            <div class="panel-body">

                <?php echo form_open(base_url() . 'index.php?staff/project_bug/edit/' . $param2, array(
                    'class' => 'form-horizontal form-groups-bordered validate project-bug-edit', 'enctype' => 'multipart/form-data')); ?>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('title'); ?></label>

                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="title" value="<?php echo $row['title']; ?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" value="" autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('description'); ?></label>

                    <div class="col-sm-7">
                        <textarea class="form-control" name="description"><?php echo $row['description']; ?></textarea>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('status'); ?></label>

                    <div class="col-sm-5">
                        <select name="status" class="form-control selectboxit">
                            <option value="0" data-iconurl="" <?php if($row['status'] == 0) echo 'selected'; ?>><?php echo get_phrase('pending'); ?></option>
                            <option value="1" <?php if($row['status'] == 1) echo 'selected';?>><?php echo get_phrase('solved'); ?></option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                            <label for="field-1" class="col-sm-4 control-label"><?php echo get_phrase('select_file'); ?></label>

                            <div class="col-sm-6">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <span class="btn btn-primary btn-file">
                                        <span class="fileinput-new"><?php echo get_phrase('choose'); ?></span>
                                        <span class="fileinput-exists"><?php echo get_phrase('change'); ?></span>
                                        <input type="file" name="userfile" id="userfile">
                                    </span>
                                    <span class="fileinput-filename"></span>
                                    <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
                                </div>
                            </div>
                        </div>
               

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-7">
                        <button type="submit" class="btn btn-info" id="submit-button"><?php echo get_phrase('update'); ?></button>
                        <span id="preloader-form"></span>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<?php 
    $project_code = $row['project_code'];
?>

<script>
    // url for refresh data after ajax form submission
    var post_refresh_url = '<?php echo base_url(); ?>index.php?staff/reload_projectroom_bug/<?php echo $project_code; ?>';
</script>

<?php endforeach;?>


<script type="text/javascript">
    // ajax form plugin calls at each modal loading,
$(document).ready(function() {

   //config for project bug adding
    var options = {
        beforeSubmit: validate_project_bug_edit,
        success: show_response_project_bug_edit,
        resetForm: true
    };
    $('.project-bug-edit').submit(function () {
        $(this).ajaxSubmit(options);
        return false;
    });

     
    
});

function validate_project_bug_edit(formData, jqForm, options) {

    if (!jqForm[0].title.value)
    {
        toastr.error("Please enter a title", "Error");
        return false;
    }
}

// ajax success response after form submission
function show_response_project_bug_edit(responseText, statusText, xhr, $form)  {

    
    toastr.success("Bug edited successfully", "Success");
    $('#modal_ajax').modal('hide');
    reload_data(post_refresh_url);
}



/*-----------------custom functions for ajax post data handling--------------------*/



// custom function for reloading table data
function reload_data(url)
{
    $.ajax({
        url: url,
        success: function(response)
        {
            // Replace new page data
            jQuery('.main_data').html(response);

            

            // calls the tooltip again on ajax success
            $('[data-toggle="tooltip"]').each(function(i, el)
            {
                var $this = $(el),
                    placement = attrDefault($this, 'placement', 'top'),
                    trigger = attrDefault($this, 'trigger', 'hover'),
                    popover_class = $this.hasClass('tooltip-secondary') ? 'tooltip-secondary' : ($this.hasClass('tooltip-primary') ? 'tooltip-primary' : ($this.hasClass('tooltip-default') ? 'tooltip-default' : ''));
                
                $this.tooltip({
                    placement: placement,
                    trigger: trigger
                });

                $this.on('shown.bs.tooltip', function(ev)
                {
                    var $tooltip = $this.next();
                    
                    $tooltip.addClass(popover_class);
                });
            });


               
        }
    });
}

</script>


