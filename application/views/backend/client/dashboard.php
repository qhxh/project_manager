
<div class="row" style=" margin:100px 0px 200px;">

	<div class="col-md-6" style="text-align:center;">
    	<img src="<?php echo $this->crud_model->get_image_url($this->session->userdata('login_type') , 
							$this->session->userdata('login_user_id'));?>" alt="" class="img-circle" style="height:60px;">
    	<h1 style="font-weight:100;margin:0px;">
    		<?php echo $this->db->get_where($this->session->userdata('login_type'), 
											array( 		$this->session->userdata('login_type').'_id' =>
														$this->session->userdata('login_user_id')))->row()->name;?>
    	</h1>
	</div>
    
	<div class="col-md-6" style="text-align:center;">
    
	        <a type="button" class="btn btn-default btn-icon icon-left col-md-5 col-xs-12"  style="margin:5px;"
				href="<?php echo base_url();?>index.php?client/project">
	        		<?php echo get_phrase('projects');?>
	        			<i class="entypo-paper-plane"></i>
	        </a>
    
    
    
	        <a type="button" class="btn btn-default btn-icon icon-left col-md-5 col-xs-12"  style="margin:5px;"
				href="<?php echo base_url();?>index.php?client/payment_history">
	        		<?php echo get_phrase('payment_history');?>
	        			<i class="entypo-credit-card"></i>
	        </a>
    
	        <a type="button" class="btn btn-default btn-icon icon-left col-md-5 col-xs-12"  style="margin:5px;"
				href="<?php echo base_url();?>index.php?client/project_quote">
	        		<?php echo get_phrase('submit_project_quote');?>
	        			<i class="entypo-plus"></i>
	        </a>
    
	        <a type="button" class="btn btn-default btn-icon icon-left col-md-5 col-xs-12"  style="margin:5px;"
				href="<?php echo base_url();?>index.php?client/support_ticket_create">
	        		<?php echo get_phrase('submit_support_ticket');?>
	        			<i class="entypo-lifebuoy"></i>
	        </a>
    
    
	</div>
</div>