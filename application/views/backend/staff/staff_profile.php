<?php
$profile_info	=	$this->db->get_where('staff' , array('staff_id' => $param2))->result_array();
foreach($profile_info as $row):?>

<div class="profile-env">
	
	<header class="row">
		
		<div class="col-sm-3">
			
			<a href="#" class="profile-picture">
				<img src="<?php echo $this->crud_model->get_image_url('staff' , $row['staff_id']);?>" 
                	class="img-responsive img-circle" />
			</a>
			
		</div>
		
		<div class="col-sm-5" style=" text-align:center;">
			
			<ul class="profile-info-sections">
				<li style="padding:0px; margin:0px;">
					<div class="profile-name">
							<h3><?php echo $row['name'];?></h3>
					</div>
				</li>
			</ul>
			
		</div>
		
		
	</header>
	
	<section class="profile-info-tabs">
		
		<div class="row">
			
			<div class="">
            		<br>
                <table class="table table-bordered">
                    <tr>
                        <td width="40%">
								<i class="entypo-paper-plane"></i> &nbsp;
								<?php echo get_phrase('role');?></td>
                        <td><b><?php echo $this->db->get_where('account_role' , array('account_role_id'=>$row['account_role_id']))->row()->name;?></b>
                        </td>
                    </tr>
                
                    <?php if($row['email'] != ''):?>
                    <tr>
                        <td>
								<i class="entypo-mail"></i> &nbsp;
								<?php echo get_phrase('email');?></td>
                        <td>
                        		<b><?php echo $row['email'];?></b>
                             <a class="tooltip-primary pull-right" data-toggle="tooltip" data-placement="top" 
                              	data-original-title="<?php echo get_phrase('send_email');?>"	
                              		href="mailto:<?php echo $row['email'];?>" style="color:#bbb;" >
                                      <i class="entypo-direction"></i>
                             </a>
                        </td>
                    </tr>
                    <?php endif;?>
                
                    <?php if($row['phone'] != ''):?>
                    <tr>
                        <td>
								<i class="entypo-phone"></i> &nbsp;
								<?php echo get_phrase('phone');?></td>
                        <td>
                        		<b><?php echo $row['phone'];?></b>
                             <a class="tooltip-primary pull-right" data-toggle="tooltip" data-placement="top" 
                              	data-original-title="<?php echo get_phrase('call_phone');?>"	
                              		href="tel:<?php echo $row['phone'];?>" style="color:#bbb;" >
                                      <i class="entypo-direction"></i>
                             </a>
                        </td>
                    </tr>
                    <?php endif;?>
                
                    <?php if($row['skype_id'] != ''):?>
                    <tr>
                        <td>
								<i class="entypo-skype"></i> &nbsp;
								<?php echo get_phrase('skype_id');?></td>
                        <td>
                        		<b><?php echo $row['skype_id'];?></b>
                             <a class="tooltip-primary pull-right" data-toggle="tooltip" data-placement="top" 
                              	data-original-title="<?php echo get_phrase('call_skype');?>"	
                              		href="skype:<?php echo $row['skype_id'];?>?chat" style="color:#bbb;" >
                                      <i class="entypo-direction"></i>
                             </a>
                        </td>
                    </tr>
                    <?php endif;?>
                
                    <?php if($row['facebook_profile_link'] != ''):?>
                    <tr>
                        <td>
								<i class="entypo-facebook-squared"></i> &nbsp;
								<?php echo get_phrase('facebook_profile');?></td>
                        <td>
                        		<b><?php echo $row['facebook_profile_link'];?></b>
                             <a class="tooltip-primary pull-right" data-toggle="tooltip" data-placement="top" 
                              	data-original-title="<?php echo get_phrase('visit_facebook_profile');?>"	
                              		href="<?php echo $row['facebook_profile_link'];?>" style="color:#bbb;" target="_blank">
                                      <i class="entypo-direction"></i>
                             </a>
                        </td>
                    </tr>
                    <?php endif;?>
                
                    <?php if($row['twitter_profile_link'] != ''):?>
                    <tr>
                        <td>
								<i class="entypo-twitter"></i> &nbsp;
								<?php echo get_phrase('twitter_profile');?></td>
                        <td>
                        		<b><?php echo $row['twitter_profile_link'];?></b>
                             <a class="tooltip-primary pull-right" data-toggle="tooltip" data-placement="top" 
                              	data-original-title="<?php echo get_phrase('visit_twitter_profile');?>"	
                              		href="<?php echo $row['twitter_profile_link'];?>" style="color:#bbb;" target="_blank">
                                      <i class="entypo-direction"></i>
                             </a>
                        </td>
                    </tr>
                    <?php endif;?>
                
                    <?php if($row['linkedin_profile_link'] != ''):?>
                    <tr>
                        <td>
								<i class="entypo-linkedin"></i> &nbsp;
								<?php echo get_phrase('linkedin_profile');?></td>
                        <td>
                        		<b><?php echo $row['linkedin_profile_link'];?></b>
                             <a class="tooltip-primary pull-right" data-toggle="tooltip" data-placement="top" 
                              	data-original-title="<?php echo get_phrase('visit_linkedin_profile');?>"	
                              		href="<?php echo $row['linkedin_profile_link'];?>" style="color:#bbb;" target="_blank">
                                      <i class="entypo-direction"></i>
                             </a>
                        </td>
                    </tr>
                    <?php endif;?>
                    
                </table>
			</div>
		</div>		
	</section>
	
	
	
</div>


<?php endforeach;?>