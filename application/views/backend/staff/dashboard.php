
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
    
    	<?php if ($this->crud_model->staff_permission(1)):?>
	        <a type="button" class="btn btn-default btn-icon icon-left col-md-5 col-xs-12"  style="margin:5px;"
				href="<?php echo base_url();?>index.php?staff/project">
	        		<?php echo get_phrase('assigned_projects');?>
	        			<i class="entypo-paper-plane"></i>
	        </a>
	    <?php endif;?>
    
    	<?php if ($this->crud_model->staff_permission(2)):?>
	        <a type="button" class="btn btn-default btn-icon icon-left col-md-5 col-xs-12"  style="margin:5px;"
				href="<?php echo base_url();?>index.php?staff/project">
	        		<?php echo get_phrase('manage_projects');?>
	        			<i class="entypo-paper-plane"></i>
	        </a>
	    <?php endif;?>
    
    	<?php if ($this->crud_model->staff_permission(3)):?>
	        <a type="button" class="btn btn-default btn-icon icon-left col-md-5 col-xs-12"  style="margin:5px;"
				href="<?php echo base_url();?>index.php?staff/client">
	        		<?php echo get_phrase('manage_client');?>
	        			<i class="entypo-users"></i>
	        </a>
	    <?php endif;?>
    
    	<?php if ($this->crud_model->staff_permission(4)):?>
	        <a type="button" class="btn btn-default btn-icon icon-left col-md-5 col-xs-12"  style="margin:5px;"
				href="<?php echo base_url();?>index.php?staff/staff">
	        		<?php echo get_phrase('manage_staffs');?>
	        			<i class="entypo-user"></i>
	        </a>
	    <?php endif;?>
    
    	<?php if ($this->crud_model->staff_permission(6)):?>
	        <a type="button" class="btn btn-default btn-icon icon-left col-md-5 col-xs-12"  style="margin:5px;"
				href="<?php echo base_url();?>index.php?staff/support_ticket">
	        		<?php echo get_phrase('assigned_support_tickets');?>
	        			<i class="entypo-lifebuoy"></i>
	        </a>
	    <?php endif;?>
    
    	<?php if ($this->crud_model->staff_permission(7)):?>
	        <a type="button" class="btn btn-default btn-icon icon-left col-md-5 col-xs-12"  style="margin:5px;"
				href="<?php echo base_url();?>index.php?staff/support_ticket">
	        		<?php echo get_phrase('all_support_tickets');?>
	        			<i class="entypo-lifebuoy"></i>
	        </a>
	    <?php endif;?>
    
	</div>
</div>