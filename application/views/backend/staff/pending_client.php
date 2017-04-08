<div class="row">

	<div class="col-md-12">
			
		<ul class="nav nav-tabs bordered"><!-- available classes "bordered", "right-aligned" -->
			<li class="<?php if ($page_name == 'client') echo 'active';?>">
				<a href="<?php echo base_url();?>index.php?staff/client">
					<span class="visible-xs"><i class="entypo-home"></i></span>
					<span class="hidden-xs"><?php echo get_phrase('clients');?></span>
				</a>
			</li>
			<li class="<?php if ($page_name == 'pending_client') echo 'active';?>">
				<a href="<?php echo base_url();?>index.php?staff/pending_client">
					<span class="visible-xs"><i class="entypo-user"></i></span>
					<span class="hidden-xs"><?php echo get_phrase('pending_clients');?></span>
				</a>
			</li>
		</ul>
		
		<div class="tab-content">
		<br>

			<div class="tab-pane <?php if ($page_name == 'pending_client') echo 'active';?>" id="">
				
				<?php if ($page_name == 'pending_client'):?>
				<div class="main_data">
					<?php include 'pending_client_list.php';?>
				</div>
				<?php endif;?>	
					
			</div>

		</div>
			
			
	</div>

</div>