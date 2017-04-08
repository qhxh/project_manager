<?php 
    $edit_data  =   $this->db->get_where('team_task' , array(
        'team_task_id' => $param2
    ))->result_array();
    foreach ($edit_data as $row):
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title" >
                    <i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('add_new_team_task'); ?>
                </div>
            </div>
            <div class="panel-body">

                <?php echo form_open(base_url() . 'index.php?admin/team_task/edit/' . $row['team_task_id'], array('class' => 'form-horizontal form-groups-bordered validate ajax-submit', 'enctype' => 'multipart/form-data')); ?>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('task_title');?></label>
                    
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="task_title" data-validate="required" 
                            data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $row['task_title'];?>">
                    </div>
                </div>

                

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('creation_date');?></label>
                    
                    <div class="col-sm-8">
                    <div class="input-group">
                            <span class="input-group-addon"><i class="entypo-calendar"></i></span>
                            <input type="text" class="form-control datepicker" name="creation_timestamp"  
                                value="<?php echo date('d/m/Y' , $row['creation_timestamp']);?>" >
                     </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('due_date');?></label>
                    
                    <div class="col-sm-8">
                    <div class="input-group">
                            <span class="input-group-addon"><i class="entypo-calendar"></i></span>
                            <input type="text" class="form-control datepicker" name="due_timestamp"  
                                value="<?php echo date('d/m/Y' , $row['due_timestamp']);?>" >
                     </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('assign_staff');?></label>
                    
                    <div class="col-sm-8">
                        <select multiple="multiple" name="assigned_staff_ids[]" class="form-control multi-select">
                        <?php 
                            $staffs     =   $this->db->get('staff')->result_array();
                            foreach ($staffs as $row2):
                            ?>
                            <option value="<?php echo $row2['staff_id'];?>"
                            <?php if (in_array($row2['staff_id'] , explode(',' , $row['assigned_staff_ids']) ) )
                                    echo 'selected';?>>
                                        <?php echo $row2['name'];?></option>
                        <?php endforeach;?>
                    </select>
                    </div>
                </div>

                

                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-7">
                        <button type="submit" class="btn btn-info" id="submit-button"><?php echo get_phrase('update_task'); ?></button>
                        <span id="preloader-form"></span>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<?php endforeach;?>

<script>
    // url for refresh data after ajax form submission
    var post_refresh_url    =   '<?php echo base_url();?>index.php?admin/reload_team_task_information/<?php echo $param2;?>';
    var post_message        =   'Data Updated Successfully';
</script>

<!-- calling ajax form submission plugin for specific form -->
<script src="assets/js/jquery.form.js"></script>

<script type="text/javascript">
    // ajax form plugin calls at each modal loading,
$(document).ready(function() { 
    
    // configuration for ajax form submission
    var options = { 
        beforeSubmit        :   validate,  
        success             :   showResponse,  
        resetForm           :   true 
    }; 
    
    // binding the form for ajax submission
    $('.ajax-submit').submit(function() { 
        $(this).ajaxSubmit(options); 
        
        // prevents normal form submission
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

// form validation
function validate(formData, jqForm, options) { 
    
    if (!jqForm[0].task_title.value)
    {
            return false;
    }
    // sends ajax request after passing validation, showing a user-friendly preloader
    $('#preloader-form').html('<img src="assets/images/preloader.gif" style="height:15px;margin-left:20px;" />');
    
    // disables intermediatory form submission
    document.getElementById("submit-button").disabled=true;
}

// ajax success response after form submission, post_refresh_url is sent from modal body
function showResponse(responseText, statusText, xhr, $form)  { 
    
    // hides the preloader
    //$('#preloader-form').html('');
    
    // showing success message 
    toastr.success(post_message, "Success");
    
    // hides modal that holds the form
    $('#modal_ajax').modal('hide');
    
    // reload table data after data update
    reload_data(post_refresh_url);
}



/*-----------------custom functions for ajax post data handling--------------------*/



// custom function for reloading table data
function reload_data(url)
{
    $('div.main_data').block({ message: '<img src="assets/images/preloader.gif" style="height:25px;" />' });
    $.ajax({
        url: url,
        success: function(response)
        {
            
            jQuery('.main_data').html(response);
            $('div.main_data').unblock();

            // Auto Size for Textarea
            $("textarea.autogrow, textarea.autosize").autosize();

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
