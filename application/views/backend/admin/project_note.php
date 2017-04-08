<?php 
	$current_project = $this->db->get_where('project' , array(
		'project_code' => $project_code
	))->result_array();
	foreach ($current_project as $row):
?>

<?php echo form_open(base_url() . 'index.php?admin/project_note/save/' . $row['project_code'] , array(
        'class' => 'project-note-save'));?>
<div class="col-md-7">
	
	<div class="panel panel-primary" data-collapsed="0">
                                            
        <!-- panel head -->
        <div class="panel-heading">
            <div class="panel-title"><?php echo get_phrase('project_notes');?></div>
            
        </div>
        
        <!-- panel body -->
        <div class="panel-body" style="padding:5px; background-color: #FFFCEE;">
            
            <div class="form-group">
                <div class="col-md-12" style="padding:0px; background-color: #FFFCEE;">
                    <textarea class="form-control autogrow" rows="14" style="padding: 5px; border:0px; background-color: #FFFCEE;"  
                        name="project_note" placeholder="Write project notes....."><?php echo $row['project_note'];?></textarea>
                </div>
            </div>
            
        </div>
    </div>
    <button type="submit" class="btn btn-info" id="submit-button"><?php echo get_phrase('save_note'); ?></button>

</div>
<?php echo form_close();?>

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
                        <a href="<?php echo base_url(); ?>index.php?admin/projectroom/edit/<?php echo $project_code; ?>" 
                            class="btn btn-default btn-icon icon-left" style="margin:10px;">
                            <?php echo get_phrase('add_client'); ?>
                            <i class="entypo-pencil"></i>
                        </a>
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
                <div class="row">
                    <div class="col-md-8 panel-title">
                        <i class="entypo-users"></i> Assigned staff
                    </div>
                    <div class="col-md-4 panel-options">
                <?php if ($number_of_staffs > 0): ?>
                            <a href="<?php echo base_url(); ?>index.php?admin/projectroom/edit/<?php echo $project_code; ?>" 
                                    class="pull-right tooltip-primary" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('manage_staff'); ?>">
                                <i class="entypo-pencil"></i>
                            </a>
                <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="panel-body">

                <?php
                    if ($number_of_staffs < 1):
                        ?>

                        <center>
                            <a  href="<?php echo base_url();?>index.php?admin/projectroom/edit/<?php echo $project_code;?>" 
                                class="btn btn-default btn-icon icon-left" style="margin:10px;">
                                <?php echo get_phrase('manage_staff'); ?>
                                <i class="entypo-pencil"></i>
                            </a>
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
<?php endforeach;?>




<script>
    // url for refresh data after ajax form submission
    var post_refresh_url    =   '<?php echo base_url();?>index.php?admin/reload_projectroom_note/<?php echo $project_code;?>';
</script>

<!-- calling ajax form submission plugin for specific form -->
<script src="assets/js/jquery.form.js"></script>

<script type="text/javascript">
    // ajax form plugin calls at each modal loading,
$(document).ready(function() { 
    
    // configuration for ajax form submission
    var options = { 
        //beforeSubmit        :   validate,  
        success             :   showResponse,  
        resetForm           :   true 
    }; 
    
    // binding the form for ajax submission
    $('.project-note-save').submit(function() { 
        $(this).ajaxSubmit(options); 
        
        
        // prevents normal form submission
        return false; 
    }); 
});

// ajax success response after form submission, post_refresh_url is sent from modal body
function showResponse(responseText, statusText, xhr, $form)  { 
    
    toastr.success("Note saved", "Success");
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
