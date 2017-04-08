<?php
$profile_info	=	$this->db->get_where('admin' , array('admin_id' => $param2))->result_array();
foreach($profile_info as $row):?>

<div class="profile-env">
	
	<header class="row">
		
		<div class="col-sm-3">
			
			<a href="#" class="profile-picture">
				<img src="<?php echo $this->crud_model->get_image_url('admin' , $row['admin_id']);?>" 
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
                          <td>
                            <b>
                              <?php if ($row['owner_status'] == 1) echo get_phrase('owner');
                                    if ($row['owner_status'] == 0) echo get_phrase('administrator');
                              ?>

                            </b>
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

                    <?php if ($row['address'] != ''):?>
                      <tr>
                      <td>
                        <i class="entypo-location"></i> &nbsp;
                          <?php echo get_phrase('address');?></td>
                        <td>
                            <b><?php echo $row['address'];?></b>
                        </td>
                    </tr>
                    <?php endif;?>
                    
                </table>
			</div>
		</div>		
	</section>
	
	
	
</div>


<?php endforeach;?>