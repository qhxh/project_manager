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
				<?php echo get_phrase('project_timer');?>
			</div>
			
		</div>
		
		<div class="panel-body">
		    <!-- timer -->
		    <center>
				<div style="height:50px; font-size:35px; font-weight:200;" id="timer_value">
					
					<!-- HOUR TIMER -->
					<span id="hour_timer"> 0 </span>
					<span style="font-size:20px;"><?php echo get_phrase('hour');?> </span>

					<!-- SEPARATOR -->
					<span class="<?php if ($row['timer_status'] == 1)echo 'blink_text';?> ;">:</span>

					<!-- MINUTE TIMER -->
					<span id="minute_timer"> 0 </span>
					<span style="font-size:20px;"><?php echo get_phrase('minute');?> </span>

					<!-- SEPARATOR -->
					<span class="<?php if ($row['timer_status'] == 1)echo 'blink_text';?> ;">:</span>

					<!-- SECOND TIMER -->
					<span id="second_timer"> 0 </span>
					<span style="font-size:20px;"><?php echo get_phrase('second');?> </span>
				</div>
				<br>

					<?php if ($row['timer_status'] == 0): ?>
				        <button type="button" class="btn btn-success btn-icon icon-left"
				                onClick="update_timer_status(1,<?php echo $row['project_id']; ?>)">
				                    <?php echo get_phrase('start_timer'); ?>
				            <i class="entypo-clock"></i>
				        </button>
				    <?php endif; ?>

				    <?php if ($row['timer_status'] == 1): ?>
				        <button type="button" class="btn btn-danger btn-icon icon-left"
				                onClick="update_timer_status(0,<?php echo $row['project_id']; ?>)">
				                    <?php echo get_phrase('stop_timer'); ?>
				            <i class="entypo-back-in-time"></i>
				        </button>
				    <?php endif; ?>
			</center>
		    <!-- timer -->
		</div>

	</div>
    <br>

    <!-- table for timer entries -->

    <div class="panel panel-primary" data-collapsed="0">

        <div class="panel-heading">
            <div class="panel-title">
                <?php echo get_phrase('timer_entries');?>
            </div>
            
        </div>
        
        <div class="panel-body" style="padding: 0px;">
            <table class="table table-striped">
                <tr>
					<td><?php echo get_phrase('start');?></td>
					<td><?php echo get_phrase('end');?></td>
					<td><?php echo get_phrase('total_time');?></td>
					<td><?php echo get_phrase('option');?></td>
				<tr>

				<?php 
				$total_duration 	=	0;
				$this->db->order_by('project_timesheet_id' , 'desc');
				$project_timesheet	=	$this->db->get_where('project_timesheet' , array('project_id' => $row['project_id']))->result_array();
				foreach ($project_timesheet as $row2):
					?>
				<tr>
					<td><?php echo date("H:i, d M" , $row2['start_timestamp']);?></td>
					<td><?php echo date("H:i, d M" , $row2['end_timestamp']);?></td>
					<td>
						<?php 
						$duration 		=	$row2['end_timestamp'] - $row2['start_timestamp'];
			            $total_duration += $duration;

						$total_hour 	= 	intval($duration / 3600);
						$duration 		-= $total_hour * 3600;
			            $total_minute 	= intval($duration / 60);
			            $total_second 	= intval($duration % 60);
						?>
						<?php if ($total_hour > 0)echo $total_hour . 'h : '; ?>
						<?php if ($total_minute > 0)echo $total_minute . 'm : '; ?>
						<?php if ($total_second > 0)echo $total_second . 's '; ?>
					</td>
					<td>
						<a href="#" class="btn btn-default btn-xs tooltip-primary" data-toggle="tooltip"  data-placement="left" 
	                        data-original-title="<?php echo get_phrase('delete');?>"
	                        onclick="confirm_modal('<?php echo base_url(); ?>index.php?admin/project_timer/delete/<?php echo $row2['project_timesheet_id']; ?>', '<?php echo base_url(); ?>index.php?admin/reload_projectroom_timer/<?php echo $row['project_code']; ?>');">
	                        <i class="entypo-trash" style="color: #ccc;"></i>
	                    </a>
					</td>
				</tr>
				<?php endforeach;?>
            </table>
            

        </div>

    </div>

    <!-- total time calculation -->
	<div class="alert alert-default">
        <strong style="color: #818da1;">
            <?php echo get_phrase('total_time_completed');?> : 
            <?php 
			// calculating total hour, minute, second
			$total_hour 		= 	intval($total_duration / 3600);
			$total_duration 	-= $total_hour * 3600;
            $total_minute 		= intval($total_duration / 60);
            $total_second 		= intval($total_duration % 60);
		 	if ($total_hour > 0)echo $total_hour . 'h : '; 
		 	if ($total_minute > 0)echo $total_minute . 'm : ';  
		 	echo $total_second . 's '; 
		 ?>
        </strong>
    </div>
    <!-- total time calculation -->

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


	<?php 
	//RUNS THE TIMER IF ONLY TIMER_STATUS = 1
	if ( $row['timer_status']	== 1 ) :

        $current_moment_timestamp = strtotime(date("d-m-y H:i:s"));
        $timer_starting_moment_timestamp = $this->db->get_where('project', array('project_id' => $row['project_id']))->row()->timer_starting_timestamp;
        $total_duration 	=	$current_moment_timestamp - $timer_starting_moment_timestamp;

        $total_hour 		= 	intval($total_duration / 3600);
		$total_duration 	-=	$total_hour * 3600;
        $total_minute 		=	intval($total_duration / 60);
        $total_second 		=	intval($total_duration % 60);

		?>

		<script type="text/javascript">

			// SET THE INITIAL VALUES TO TIMER PLACES
			var timer_starting_hour 	=	<?php echo $total_hour;?>;
			document.getElementById("hour_timer").innerHTML = timer_starting_hour;
			var timer_starting_minute 	=	<?php echo $total_minute;?>;
			document.getElementById("minute_timer").innerHTML = timer_starting_minute;
			var timer_starting_second 	=	<?php echo $total_second;?>;
			document.getElementById("second_timer").innerHTML = timer_starting_second;

			// INITIALIZE THE TIMER WITH SECOND DELAY
			var timer = timer_starting_second;
			var mytimer	=	setInterval(function () {run_timer()}, 1000);

			function run_timer() {
			    timer++;

			    if (timer >59)
			    {
			    	timer = 0;
			    	timer_starting_minute++;
			    	document.getElementById("minute_timer").innerHTML = timer_starting_minute;
			    }

			    if (timer_starting_minute > 59)
			    {
			    	timer_starting_minute = 0;
			    	timer_starting_hour++;
			    	document.getElementById("hour_timer").innerHTML = timer_starting_hour;
			    }

			    document.getElementById("second_timer").innerHTML = timer;
			}
		</script>

	<?php endif;?>

<?php endforeach;?>



<script type="text/javascript">

	var post_refresh_url    =   '<?php echo base_url();?>index.php?admin/reload_projectroom_timer/<?php echo $project_code;?>';
	/* function for updating timer status // 0=stopped,1=running*/
    function update_timer_status(timer_status, project_id)
    {
    	
        $.ajax({
            url: '<?php echo base_url(); ?>index.php?admin/project_timer/edit/' + timer_status + '/' + project_id,
            success: function (response)
            {
                if (timer_status == 1)
                    toastr.success("Project timer started");
                if (timer_status == 0)
                {
                    toastr.info("Project timer stopped");
                    // stopping the running timer
                    clearInterval(mytimer);
                }
                // calling project monitor reload function
                reload_data( post_refresh_url );
            }
        });
    }

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


// custom function for reloading data
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
 
<style type="text/css"> 
.blink_text { 

        -webkit-animation-name: blinker;
 -webkit-animation-duration: 1s;
 -webkit-animation-timing-function: linear;
 -webkit-animation-iteration-count: infinite;

 -moz-animation-name: blinker;
 -moz-animation-duration: 1s;
 -moz-animation-timing-function: linear;
 -moz-animation-iteration-count: infinite;
 animation-name: blinker;
 animation-duration: 1s;
 animation-timing-function: linear; 
    animation-iteration-count: infinite; 
} 

@-moz-keyframes blinker {
    0% { opacity: 1.0; }
    50% { opacity: 0.0; }
    100% { opacity: 1.0; } 
}

@-webkit-keyframes blinker {  
    0% { opacity: 1.0; }
    50% { opacity: 0.0; }
    100% { opacity: 1.0; } 
} 

@keyframes blinker {  
    0% { opacity: 1.0; } 
    50% { opacity: 0.0; }      
    100% { opacity: 1.0; } 
} 
</style>