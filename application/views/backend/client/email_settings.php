
<div class="row">

	<div class="col-md-12">
	
		<div class="tabs-horizontal-env">
		
			<ul class="nav tabs-vertical" style="width:30%;"><!-- available classes "right-aligned" -->

				<?php 
				$email_templates	=	$this->db->get('email_template')->result_array();
				foreach ($email_templates as $row):
					?>
					<li class="<?php if ($row['email_template_id'] == $current_email_template_id)echo 'active';?>"><a href="#tab<?php echo $row['email_template_id'];?>"
						data-toggle="tab">
							<i class="entypo-right-dir"></i>
							<?php echo get_phrase($row['task']);?>
								</a></li>
				<?php endforeach;?>
			</ul>
			
			<div class="tab-content" style="width:70%;">

				<?php
				foreach ($email_templates as $row):
					?>
					
					<div class="tab-pane <?php if ($row['email_template_id'] == $current_email_template_id)echo 'active';?>" 
						id="tab<?php echo $row['email_template_id'];?>">
						<?php echo form_open(base_url() . 'index.php?admin/email_settings/do_update/' . $row['email_template_id']);?>
							<b><?php echo get_phrase('email_subject');?> :</b>
							<input type="text" class="form-control" name="subject" value="<?php echo $row['subject'];?>">

							<hr>

							<b><?php echo get_phrase('email_body');?> :</b>
							<textarea class="form-control email_template_editors" rows="10" name="body" id="post_content<?php echo $row['email_template_id'];?>" 
	                            data-stylesheet-url="assets/css/wysihtml5-color.css"><?php echo $row['body'];?></textarea>
	                		<br>
	                        <b><?php echo get_phrase('instruction');?> :</b>
	                        <?php echo $row['instruction'];?>
	                        <hr>
	                        <center>
		                        <button type="submit" class="btn btn-info btn-icon icon-left">
									<?php echo get_phrase('save_template');?>
									<i class="entypo-floppy"></i>
								</button>
							</center>
						<?php echo form_close();?>
					</div>
					
				<?php endforeach;?>
			</div>
			
		</div>	
	
	</div>
</div>



