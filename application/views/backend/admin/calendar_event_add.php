
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title" >
                    <i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('add_event'); ?>
                </div>
            </div>
            <div class="panel-body">

                <?php echo form_open(base_url() . 'index.php?admin/calendar/create_event/' , array(
                'class' => 'form-horizontal form-groups-bordered validate calendar-event-add', 'enctype' => 'multipart/form-data')); ?>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('title'); ?></label>

                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="title" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" 
                            value="" autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('description'); ?></label>

                    <div class="col-sm-7">
                        <textarea class="form-control autogrow" rows="15" name="description"></textarea>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('start_date'); ?></label>

                    <div class="col-sm-5">
                        <div class="date">
                            <input type="text" name="start_timestamp" class="form-control datepicker" data-format="dd-mm-yyyy" placeholder="start date here"
                             value="<?php echo $param2;?>">
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('end_date'); ?></label>

                    <div class="col-sm-5">
                        <div class="date">
                            <input type="text" name="end_timestamp" class="form-control datepicker" data-format="dd-mm-yyyy" placeholder="end date here"
                            value="<?php echo $param2;?>">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('label'); ?></label>

                    <div class="col-sm-5">
                        <select name="colour" class="form-control selectboxit">
                            <option value=""><?php echo get_phrase('select_colour');?></option>
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
                        <button type="submit" class="btn btn-info" id="submit-button"><?php echo get_phrase('add_event'); ?></button>
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
    var post_refresh_url = '<?php echo base_url(); ?>index.php?admin/reload_event_calendar_body';
</script>


<script type="text/javascript">
    // ajax form plugin calls at each modal loading,
$(document).ready(function() {

    // Auto Size for Textarea
    $("textarea.autogrow, textarea.autosize").autosize();


   //config for project task adding
    var options = {
        beforeSubmit: validate_calendar_event_add,
        success: show_response_calendar_event_add,
        resetForm: true
    };
    $('.calendar-event-add').submit(function () {
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
    
    
});

function validate_calendar_event_add(formData, jqForm, options) {

    if (!jqForm[0].title.value)
    {
        toastr.error("Please enter a title", "Error");
        return false;
    }
}

// ajax success response after form submission
function show_response_calendar_event_add(responseText, statusText, xhr, $form)  {

    
    toastr.success("Event added successfully", "Success");
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
               
        }
    });
}

</script>