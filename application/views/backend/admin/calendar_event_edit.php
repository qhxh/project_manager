<?php 
	$edit_data = $this->db->get_where('calendar_event' , array(
		'calendar_event_id' => $param2
	))->result_array();
?>

<div id="event_details">
<?php foreach ($edit_data as $row):?>
	<div class="row">
		<div class="col-md-12">
			<blockquote class="blockquote-default">
				<p>
					<strong><?php echo $row['title'];?></strong>
				</p>
				<p>
					<small><?php echo $row['description'];?></small>
					<hr />
					<i class="entypo-calendar" style="color: #ccc;"></i>
                        <?php echo date("d M Y", $row['start_timestamp']);?>  <b>to</b>  <?php echo date("d M Y", $row['end_timestamp']); ?>
				</p>
			</blockquote>

			<button type="button" id="event_edit_button" class="btn btn-default btn-icon icon-left">
				<?php echo get_phrase('edit_event');?>
				<i class="entypo-pencil"></i>
			</button>

			<button type="button" id="delete" class="btn btn-default btn-icon icon-left">
				<?php echo get_phrase('delete_event');?>
				<i class="entypo-trash"></i>
			</button>

		</div>
	</div>
<?php endforeach;?>
</div>

<div id="edit_form">
	<?php
		foreach ($edit_data as $row):
	?>
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

	                <?php echo form_open(base_url() . 'index.php?admin/calendar/edit/' . $param2 , array(
	                'class' => 'form-horizontal form-groups-bordered validate calendar-event-edit', 'enctype' => 'multipart/form-data')); ?>

	                <div class="form-group">
	                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('title'); ?></label>

	                    <div class="col-sm-7">
	                        <input type="text" class="form-control" name="title" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" 
	                            value="<?php echo $row['title'];?>">
	                    </div>
	                </div>

	                <div class="form-group">
	                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('description'); ?></label>

	                    <div class="col-sm-7">
	                        <textarea class="form-control autogrow" rows="15" name="description"><?php echo $row['description'];?></textarea>
	                    </div>
	                </div>
	                
	                <div class="form-group">
	                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('start_date'); ?></label>

	                    <div class="col-sm-5">
	                        <div class="date">
	                            <input type="text" name="start_timestamp" class="form-control datepicker" data-format="dd-mm-yyyy" placeholder="start date here"
	                             value="<?php echo date("d-m-Y" , $row['start_timestamp']);?>">
	                        </div>
	                    </div>
	                </div>
	                
	                <div class="form-group">
	                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('end_date'); ?></label>

	                    <div class="col-sm-5">
	                        <div class="date">
	                            <input type="text" name="end_timestamp" class="form-control datepicker" data-format="dd-mm-yyyy" placeholder="end date here"
	                            value="<?php echo date("d-m-Y" , $row['end_timestamp']);?>">
	                        </div>
	                    </div>
	                </div>

	                <div class="form-group">
	                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('label'); ?></label>

	                    <div class="col-sm-5">
	                        <select name="colour" class="form-control selectboxit">
	                            <option value=""><?php echo get_phrase('select_colour');?></option>
	                            <option value="#E93339" data-iconurl="<?php echo base_url();?>uploads/red.png"
	                                <?php if ($row['colour'] == '#E93339') echo 'selected';?>>
	                                <?php echo get_phrase('red'); ?>
	                            </option>
	                            <option value="#FDA330" data-iconurl="<?php echo base_url();?>uploads/amber.png"
	                                <?php if ($row['colour'] == '#FDA330') echo 'selected';?>>
	                                <?php echo get_phrase('amber'); ?>
	                            </option>
	                            <option value="#252A32" data-iconurl="<?php echo base_url();?>uploads/black.png"
	                                <?php if ($row['colour'] == '#252A32') echo 'selected';?>>
	                                <?php echo get_phrase('black'); ?>
	                            </option>
	                            <option value="#279ACB" data-iconurl="<?php echo base_url();?>uploads/blue.png"
	                                <?php if ($row['colour'] == '#279ACB') echo 'selected';?>>
	                                <?php echo get_phrase('blue'); ?>
	                            </option>
	                            <option value="#128C48" data-iconurl="<?php echo base_url();?>uploads/green.png"
	                                <?php if ($row['colour'] == '#128C48') echo 'selected';?>>
	                                <?php echo get_phrase('green'); ?>
	                            </option>
	                        </select>
	                    </div>
	                </div>

	                <div class="form-group">
	                    <div class="col-sm-offset-3 col-sm-7">
	                        <button type="submit" class="btn btn-info" id="submit-button"><?php echo get_phrase('update'); ?></button>
	                        <button type="button" class="btn btn-default" id="undo">
	                        	<i class="entypo-back"></i> &nbsp; <?php echo get_phrase('undo'); ?>
	                        </button>
	                        <span id="preloader-form"></span>
	                    </div>
	                </div>

	                <?php echo form_close(); ?>
	            </div>
	        </div>
	    </div>
	</div>
	<?php endforeach;?>
</div>

<script>
    // url for refresh data after ajax form submission
    var post_refresh_url = '<?php echo base_url(); ?>index.php?admin/reload_event_calendar_body';
    var delete_event_url = '<?php echo base_url();?>index.php?admin/calendar/delete/<?php echo $param2;?>';
</script>


<script type="text/javascript">
    // ajax form plugin calls at each modal loading,
$(document).ready(function() {

	// Auto Size for Textarea
	$("textarea.autogrow, textarea.autosize").autosize();

	$('#edit_form').hide();

	$("#event_edit_button").click(function(){
    	$("#edit_form").show();
    	$("#event_details").hide();
	});

	$("#undo").click(function(){
    	$("#edit_form").hide();
    	$("#event_details").show();
	});

	$("#delete").click(function(){
    	$.ajax({
	        url: delete_event_url,
	        success: function(response)
	        {
	            
	            // show deletion success msg.
	            toastr.info("Data deleted successfully.", "Success");
	            
	            // hide the delete dialog box
	            $('#modal_ajax').modal('hide');
	            
	            // reload the table
	            reload_data(post_refresh_url);
	        }
	    });
	});


   //config for project task adding
    var options = {
        beforeSubmit: validate_calendar_event_edit,
        success: show_response_calendar_event_edit,
        resetForm: true
    };
    $('.calendar-event-edit').submit(function () {
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

function validate_calendar_event_edit(formData, jqForm, options) {

    if (!jqForm[0].title.value)
    {
        toastr.error("Please enter a title", "Error");
        return false;
    }
}

// ajax success response after form submission
function show_response_calendar_event_edit(responseText, statusText, xhr, $form)  {

    
    toastr.success("Event updated successfully", "Success");
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