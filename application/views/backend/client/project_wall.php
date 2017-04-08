<?php 
	$current_project = $this->db->get_where('project' , array(
		'project_code' => $project_code
	))->result_array();
	foreach ($current_project as $row):
?>
<div class="col-md-9">
	
	<div class="panel panel-primary" data-collapsed="0">

			<div class="panel-heading">
				<div class="panel-title">
					<?php echo get_phrase('project_discussion');?>
				</div>
				
			</div>
			
			<div class="panel-body">
				
				<?php echo form_open(base_url() . 'index.php?client/project_message/add/' . $project_code, array(
					'class' => 'form-horizontal form-groups-bordered validate project-submit', 'enctype' => 'multipart/form-data')); ?>

					<div class="form-group">
						<!-- MESSAGE BOX -->
						<div class="col-md-9">
							<textarea class="form-control autogrow" rows="3" placeholder="Type new message...." name="message" required></textarea>
						</div>

						
						
						<!-- SUBMIT BUTTON -->
							<button style="margin-left: 16px; margin-top: 5px;" type="submit" id="submit-button" class="btn btn-info">
                                <?php echo get_phrase('post_message');?>
                            </button> 
							
						

						<!-- FILE UPLOADER -->
						<div class="col-md-4" style="margin-top: 5px;">
						<label>
							<input type="file" class="form-control file2 inline btn btn-default" name="userfile"
								data-label="<i class='glyphicon glyphicon-circle-arrow-up'></i> Attach file" />
						</label>
						</div>

					</div>
				<?php echo form_close(); ?>
				<hr />
				<!-- DISCUSSION LIST -->
				<?php
					$this->db->order_by('project_message_id' , 'desc'); 
					$project_messages = $this->db->get_where('project_message' , array(
						'project_id' => $row['project_id']
					))->result_array();
					foreach ($project_messages as $row2):
				?>
                <div class="alert alert-default" style="position:relative; padding:15px 15px 20px 15px;">
                    <strong>
                        <?php echo $this->db->get_where($row2['user_type'] , array(
                        	$row2['user_type'] . '_id' => $row2['user_id']
                        ))->row()->name;?> : 
                    </strong> 

                    <span style="color:#777;">
                    	<?php echo $row2['message'];?>
                    </span>
                    <span style="position:absolute; right:3px; bottom:2px; color:#A6A6A6; font-size:9px;"><?php echo $row2['date'];?></span>
                    <?php if ($row2['message_file_name'] != ''):?>
                    <span style="position:absolute; left:14px; bottom:2px; color:#A6A6A6; font-size:9px;">
                    	<a href="<?php echo base_url();?>index.php?client/project_message/download/<?php echo $row2['project_message_id'];?>" 
                    		style="color:#A6A6A6; text-decoration:underline;">
 	                   		<i class="entypo-download"></i> <?php echo $row2['message_file_name'];?>
 	                  	</a>
                    </span>
                    <?php endif;?>
                </div>

                <?php endforeach;?>


			</div>
		</div>

</div>

<?php endforeach;?>




<script>
    // url for refresh data after ajax form submission
    var post_refresh_url    =   '<?php echo base_url();?>index.php?client/reload_projectroom_wall/<?php echo $project_code;?>';
    var post_message        =   'Message Sent';
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
    $('.project-submit').submit(function() { 
        $(this).ajaxSubmit(options); 
        
        // prevents normal form submission
        return false; 
    }); 
});

// ajax success response after form submission, post_refresh_url is sent from modal body
function showResponse(responseText, statusText, xhr, $form)  { 
    
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

            // Replaced File Input
			$("input.file2[type=file]").each(function(i, el)
			{
				var $this = $(el),
					label = attrDefault($this, 'label', 'Browse');
				
				$this.bootstrapFileInput(label);
			});

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