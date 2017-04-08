<?php 
	$current_project = $this->db->get_where('project' , array(
		'project_code' => $project_code
	))->result_array();
	foreach ($current_project as $row):
?>
<div class="col-md-7">
	
	<div class="panel panel-primary" data-collapsed="0">

		<div class="panel-heading">
			<div class="panel-title">
				<?php echo get_phrase('task_schedule');?>
			</div>
			
		</div>
		
		<div class="panel-body" style="padding: 0px;">
		     <!-- project calendar -->
            <div class="calendar-env">
                <div class="calendar-body">
                    <div id="project_calendar"></div>
                </div>
            </div>	
			<!-- project calendar -->
		</div>

	</div>

    <a href="#" class="btn btn-info pull-right tooltip-primary"
        onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/project_task_add/<?php echo $row['project_code']; ?>');">
        <i class="entypo-plus"></i> <?php echo get_phrase('add_new_task');?>
    </a>
    <br><br><br>

    <!-- task accordion -->

    <div class="panel-group joined" id="accordion-test-2">
        
        <?php
            $this->db->order_by('project_task_id' , 'desc'); 
            $project_tasks  =   $this->db->get_where('project_task' , array('project_id' => $row['project_id']))->result_array();
            foreach ($project_tasks as $row2):
        ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"
                    <?php if ($row2['complete_status'] == 1) echo 'style="text-decoration: line-through;"';?>>
                    <a data-toggle="collapse" data-parent="#accordion-test-2" href="#<?php echo $row2['project_task_id'];?>" 
                        class="collapsed">
                        <i class="entypo-record" style="color: <?php echo $row2['task_color'];?>;"></i> 
                            <?php echo $row2['title'];?>
                    </a>
                </h4>
            </div>
            <div id="<?php echo $row2['project_task_id'];?>" class="panel-collapse collapse" style="height: auto;">
                <div class="panel-body">
                
                <p><?php echo $row2['description'];?></p>
                <hr />
                <p style="font-size: 10px;">
                    <i class="entypo-user" style="color: #ccc;"></i> 
                        <?php
                            if ($row2['staff_id'] > 0) 
                                echo $this->db->get_where('staff' , array('staff_id' => $row2['staff_id']))->row()->name;
                            else
                                echo get_phrase('no_staff_assigned_yet')
                        ?>
                    &nbsp;
                    &nbsp;
                    <i class="entypo-calendar" style="color: #ccc;"></i>
                        <?php echo date("d M Y", $row2['timestamp_start']);?>  <b>to</b>  <?php echo date("d M Y", $row2['timestamp_end']); ?>


                    <a href="#" class="btn btn-default btn-xs tooltip-primary pull-right" data-toggle="tooltip"  data-placement="left" 
                        data-original-title="<?php echo get_phrase('delete');?>"
                        onclick="confirm_modal('<?php echo base_url(); ?>index.php?staff/project_task/delete/<?php echo $row2['project_task_id']; ?>', '<?php echo base_url(); ?>index.php?staff/reload_projectroom_task/<?php echo $row['project_code']; ?>');">
                        <i class="entypo-trash" style="color: #ccc;"></i>
                    </a>

                    <a href="#" class="btn btn-default btn-xs tooltip-primary pull-right" data-toggle="tooltip"  data-placement="left" 
                        data-original-title="<?php echo get_phrase('edit');?> / <?php echo get_phrase('mark_as_complete');?>"
                        onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/project_task_edit/<?php echo $row['project_code'];?>/<?php echo $row2['project_task_id']; ?>');">
                        <i class="entypo-pencil" style="color: #ccc;"></i>
                    </a>

                    

                </p>


                </div>
            </div>
        </div>
    <?php endforeach;?>
        
    </div>

    <!-- task accordion -->

</div>

<div class="col-md-3">
    

    <!-- client -->
    <div class="panel panel-primary" data-collapsed="0">
        <div class="panel-heading">
            <div class="panel-title">
                <i class="entypo-user"></i> <?php echo get_phrase('client');?>
            </div>
            <div class="panel-options">
            </div>
        </div>
        <div class="panel-body">
            <?php
                if ($row['client_id'] < 1):
                    ?>
                    <center>
                        <?php echo get_phrase('no_client_added_yet');?>
                    </center>
            <?php endif; ?>

            <table width="100%" border="0">
            <tbody>
                <?php
                if ($row['client_id'] > 0):
                    $client_data = $this->db->get_where('client', array('client_id' => $row['client_id']))->result_array();
                    foreach ($client_data as $row3):
                        ?>
                <tr>
                    <td rowspan="2" width="60">
                        <img src="<?php echo $this->crud_model->get_image_url('client', $row3['client_id']); ?>" 
                            alt="" class="img-circle" width="44">
                    </td>
                    <td>
                        <h4 style="font-weight: 200;"><?php echo $row3['name'];?></h4>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php if ($row3['skype_id'] != ''): ?>
                            <a class="tooltip-primary" data-toggle="tooltip" data-placement="top" 
                               data-original-title="<?php echo get_phrase('call_skype'); ?>"    
                               href="skype:<?php echo $row3['skype_id']; ?>?chat" style="color:#bbb;">
                                <i class="entypo-skype"></i>
                            </a>
                        <?php endif; ?>
                        <?php if ($row3['email'] != ''): ?>
                            <a class="tooltip-primary" data-toggle="tooltip" data-placement="top" 
                               data-original-title="<?php echo get_phrase('send_email'); ?>"    
                               href="mailto:<?php echo $row3['email']; ?>" style="color:#bbb;">
                                <i class="entypo-mail"></i>
                            </a>
                        <?php endif; ?>
                        <?php if ($row3['phone'] != ''): ?>
                            <a class="tooltip-primary" data-toggle="tooltip" data-placement="top" 
                               data-original-title="<?php echo get_phrase('call_phone'); ?>"    
                               href="tel:<?php echo $row3['phone']; ?>" style="color:#bbb;">
                                <i class="entypo-phone"></i>
                            </a>
                        <?php endif; ?>
                        <?php if ($row3['facebook_profile_link'] != ''): ?>
                            <a class="tooltip-primary" data-toggle="tooltip" data-placement="top" 
                               data-original-title="<?php echo get_phrase('facebook_profile'); ?>"  
                               href="<?php echo $row3['facebook_profile_link']; ?>" style="color:#bbb;" target="_blank">
                                <i class="entypo-facebook"></i>
                            </a>
                        <?php endif; ?>
                        <?php if ($row3['twitter_profile_link'] != ''): ?>
                            <a class="tooltip-primary" data-toggle="tooltip" data-placement="top" 
                               data-original-title="<?php echo get_phrase('twitter_profile'); ?>"   
                               href="<?php echo $row3['twitter_profile_link']; ?>" style="color:#bbb;" target="_blank">
                                <i class="entypo-twitter"></i>
                            </a>
                        <?php endif; ?>
                        <?php if ($row3['linkedin_profile_link'] != ''): ?>
                            <a class="tooltip-primary" data-toggle="tooltip" data-placement="top" 
                               data-original-title="<?php echo get_phrase('linkedin_profile'); ?>"  
                               href="<?php echo $row3['linkedin_profile_link']; ?>" style="color:#bbb;" target="_blank">
                                <i class="entypo-linkedin"></i>
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach;?>
        <?php endif;?>
            </tbody>
            </table>
        </div>
    </div>

    <!-- staff -->
    <?php 
        $staffs = ( explode(',', $row['staffs']));
        $number_of_staffs = count($staffs) - 1;
    ?>
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-users"></i> Assigned staff
                </div>
            </div>
            <div class="panel-body">

                <?php
                    if ($number_of_staffs < 1):
                        ?>

                        <center>
                            <?php echo get_phrase('no_staffs_assigned_yet');?>
                        </center>
                    <?php endif; ?>

                <?php
                    if ($number_of_staffs > 0):
                        for ($i = 0; $i < $number_of_staffs; $i++):
                            $staff_data = $this->db->get_where('staff', array('staff_id' => $staffs[$i]))->result_array();
                            foreach ($staff_data as $row2):
                                ?>
                                <table width="100%" border="0">
                                    <tr>
                                        <td rowspan="2" width="60">
                                            <img src="<?php echo $this->crud_model->get_image_url('staff', $row2['staff_id']); ?>" 
                                                 alt="" class="img-circle" width="44">
                                        </td>
                                        <td>
                                            <h4 style="font-weight: 200;"><?php echo $row2['name']; ?></h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php if ($row2['skype_id'] != ''): ?>
                                                <a class="tooltip-primary" data-toggle="tooltip" data-placement="top" 
                                                   data-original-title="<?php echo get_phrase('call_skype'); ?>"    
                                                   href="skype:<?php echo $row2['skype_id']; ?>?chat" style="color:#bbb;">
                                                    <i class="entypo-skype"></i>
                                                </a>
                                            <?php endif; ?>
                                            <?php if ($row2['email'] != ''): ?>
                                                <a class="tooltip-primary" data-toggle="tooltip" data-placement="top" 
                                                   data-original-title="<?php echo get_phrase('send_email'); ?>"    
                                                   href="mailto:<?php echo $row2['email']; ?>" style="color:#bbb;">
                                                    <i class="entypo-mail"></i>
                                                </a>
                                            <?php endif; ?>
                                            <?php if ($row2['phone'] != ''): ?>
                                                <a class="tooltip-primary" data-toggle="tooltip" data-placement="top" 
                                                   data-original-title="<?php echo get_phrase('call_phone'); ?>"    
                                                   href="tel:<?php echo $row2['phone']; ?>" style="color:#bbb;">
                                                    <i class="entypo-phone"></i>
                                                </a>
                                            <?php endif; ?>
                                            <?php if ($row2['facebook_profile_link'] != ''): ?>
                                                <a class="tooltip-primary" data-toggle="tooltip" data-placement="top" 
                                                   data-original-title="<?php echo get_phrase('facebook_profile'); ?>"  
                                                   href="<?php echo $row2['facebook_profile_link']; ?>" style="color:#bbb;" target="_blank">
                                                    <i class="entypo-facebook"></i>
                                                </a>
                                            <?php endif; ?>
                                            <?php if ($row2['twitter_profile_link'] != ''): ?>
                                                <a class="tooltip-primary" data-toggle="tooltip" data-placement="top" 
                                                   data-original-title="<?php echo get_phrase('twitter_profile'); ?>"   
                                                   href="<?php echo $row2['twitter_profile_link']; ?>" style="color:#bbb;" target="_blank">
                                                    <i class="entypo-twitter"></i>
                                                </a>
                                            <?php endif; ?>
                                            <?php if ($row2['linkedin_profile_link'] != ''): ?>
                                                <a class="tooltip-primary" data-toggle="tooltip" data-placement="top" 
                                                   data-original-title="<?php echo get_phrase('linkedin_profile'); ?>"  
                                                   href="<?php echo $row2['linkedin_profile_link']; ?>" style="color:#bbb;" target="_blank">
                                                    <i class="entypo-linkedin"></i>
                                                </a>
                                            <?php endif; ?>

                                        </td>
                                    </tr>
                                </table>
                                <br>
                                <?php
                            endforeach;
                        endfor;
                    endif;
                    ?>
            </div>
        </div>

</div>


<!-- custom styling for project calendar -->
<style>
    /*h2{font-weight: 200; font-size: 16px;}*/
    .fc-header-left{padding:4px !important;}
    .fc-header-right{padding:4px !important;}
</style>


<!-- calling ajax form submission plugin for specific form -->
<script src="assets/js/jquery.form.js"></script>

<script type="text/javascript">
    // ajax form plugin calls at each modal loading,
$(document).ready(function() {

    

    // config for project calendar
    $('#project_calendar').fullCalendar({
        header: {
            left: 'title',
            right: 'today prev,next'
        },
        //defaultView: 'basicWeek',

        editable: false,
        firstDay: 1,
        height: 350,
        droppable: false,
        
        events:
        [
            <?php
            $tasks = $this->db->get_where('project_task', array('project_id' => $row['project_id']))->result_array();
            foreach ($tasks as $row):
            ?>
                {
                    title   :   "<?php  echo $row['title'];?>",
                    start   :   new Date(<?php echo date('Y', $row['timestamp_start']); ?>, 
                                    <?php echo date('m', $row['timestamp_start']) - 1; ?>, 
                                    <?php echo date('d', $row['timestamp_start']); ?>),
                    end    :   new Date(<?php echo date('Y', $row['timestamp_end']); ?>, 
                                    <?php echo date('m', $row['timestamp_end']) - 1; ?>, 
                                    <?php echo date('d', $row['timestamp_end']); ?>),
                    allDay: true,
                    color: "<?php echo $row['task_color'];?>"
                },
            <?php endforeach ?>
        ]
    });

   
    
});

// custom function for data deletion by ajax and post refreshing call
function delete_data(delete_url , post_refresh_url)
{
    // showing user-friendly pre-loader image
    $('#preloader-delete').html('<img src="assets/images/preloader.gif" style="height:15px;margin-top:-10px;" />');
    
    // disables the delete and cancel button during deletion ajax request
    document.getElementById("delete_link").disabled=true;
    document.getElementById("delete_cancel_link").disabled=true;
    
    $.ajax({
        url: delete_url,
        success: function(response)
        {
            // remove the preloader 
            $('#preloader-delete').html('');
            
            // show deletion success msg.
            toastr.info("Data deleted successfully.", "Success");
            
            // hide the delete dialog box
            $('#modal_delete').modal('hide');
            
            // enables the delete and cancel button after deletion ajax request success
            document.getElementById("delete_link").disabled=false;
            document.getElementById("delete_cancel_link").disabled=false;
    
            // reload the table
            reload_data(post_refresh_url);
        }
    });
}

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
<script src="assets/js/neon-custom-ajax.js"></script>
<?php endforeach;?>