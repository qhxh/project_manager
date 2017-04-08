

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title" >
                    <i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('add_project_task'); ?>
                </div>
            </div>
            <div class="panel-body">

                <?php echo form_open(base_url() . 'index.php?admin/project_task/create/'.$param2, array('class' => 'form-horizontal form-groups-bordered validate project-task-add', 'enctype' => 'multipart/form-data')); ?>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('title'); ?></label>

                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" value="" autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('description'); ?></label>

                    <div class="col-sm-7">
                        <textarea class="form-control" name="description"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('assign_staff'); ?></label>

                    <div class="col-sm-5">
                        <select name="staff_id" class="select2">
                            <option><?php echo get_phrase('select_staff'); ?></option>
                            <?php
                            $staffs = $this->db->get('staff')->result_array();
                            foreach ($staffs as $row):
                                ?>
                                <option value="<?php echo $row['staff_id']; ?>">
                                    <?php echo $row['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('status'); ?></label>

                    <div class="col-sm-5">
                        <select name="complete_status" class="form-control selectboxit">
                            <option value="0" data-iconurl=""><?php echo get_phrase('incomplete'); ?></option>
                            <option value="1"><?php echo get_phrase('complete'); ?></option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('start_date'); ?></label>

                    <div class="col-sm-5">
                        <div class="date">
                            <input type="text" name="timestamp_start" class="form-control datepicker" data-format="D, dd MM yyyy" placeholder="start date here">
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('end_date'); ?></label>

                    <div class="col-sm-5">
                        <div class="date">
                            <input type="text" name="timestamp_end" class="form-control datepicker" data-format="D, dd MM yyyy" placeholder="end date here">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('task_label_color'); ?></label>

                    <div class="col-sm-5">
                        <select name="task_color" class="form-control selectboxit">
                            <option value=""><?php echo get_phrase('select_task_colour');?></option>
                            <option value="#E93339" data-iconurl="<?php echo base_url();?>uploads/red.png">
                                <?php echo get_phrase('red'); ?>
                            </option>
                            <option value="#FDA330" data-iconurl="<?php echo base_url();?>uploads/amber.png">
                                <?php echo get_phrase('amber'); ?>
                            </option>
                            <option value="#252A32" data-iconurl="<?php echo base_url();?>uploads/black.png">
                                <?php echo get_phrase('black'); ?>
                            </option>
                            <option value="#279ACB" data-iconurl="<?php echo base_url();?>uploads/blue.png">
                                <?php echo get_phrase('blue'); ?>
                            </option>
                            <option value="#128C48" data-iconurl="<?php echo base_url();?>uploads/green.png">
                                <?php echo get_phrase('green'); ?>
                            </option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-7">
                        <button type="submit" class="btn btn-info" id="submit-button"><?php echo get_phrase('submit'); ?></button>
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
    var post_refresh_url = '<?php echo base_url(); ?>index.php?admin/reload_projectroom_task/<?php echo $param2; ?>';
</script>


<script type="text/javascript">
    // ajax form plugin calls at each modal loading,
$(document).ready(function() {

   //config for project task adding
    var options = {
        beforeSubmit: validate_project_task_add,
        success: show_response_project_task_add,
        resetForm: true
    };
    $('.project-task-add').submit(function () {
        $(this).ajaxSubmit(options);
        return false;
    });

     // Datepicker
        if($.isFunction($.fn.datepicker))
        {
            $(".datepicker").each(function(i, el)
            {
                var $this = $(el),
                    opts = {
                        format: attrDefault($this, 'format', 'mm/dd/yyyy'),
                        startDate: attrDefault($this, 'startDate', ''),
                        endDate: attrDefault($this, 'endDate', ''),
                        daysOfWeekDisabled: attrDefault($this, 'disabledDays', ''),
                        startView: attrDefault($this, 'startView', 0),
                        rtl: rtl()
                    },
                    $n = $this.next(),
                    $p = $this.prev();
                                
                $this.datepicker(opts);
                
                if($n.is('.input-group-addon') && $n.has('a'))
                {
                    $n.on('click', function(ev)
                    {
                        ev.preventDefault();
                        
                        $this.datepicker('show');
                    });
                }
                
                if($p.is('.input-group-addon') && $p.has('a'))
                {
                    $p.on('click', function(ev)
                    {
                        ev.preventDefault();
                        
                        $this.datepicker('show');
                    });
                }
            });
        }

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
    
    
});

function validate_project_task_add(formData, jqForm, options) {

    if (!jqForm[0].name.value)
    {
        toastr.error("Please enter a task", "Error");
        return false;
    }
}

// ajax success response after form submission
function show_response_project_task_add(responseText, statusText, xhr, $form)  {

    
    toastr.success("Project task added successfully", "Success");
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