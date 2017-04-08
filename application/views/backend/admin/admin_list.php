<?php
	$is_owner = $this->db->get_where('admin' , array(
		'admin_id' => $this->session->userdata('login_user_id')
	))->row()->owner_status; 
?>
<table class="table table-bordered datatable" id="table_export">
	<thead>
		<tr>
			<th style="width:30px;">
           	</th>
			<th><div><?php echo get_phrase('name');?></div></th>
			<th><div><?php echo get_phrase('email');?></div></th>
			<th><div><?php echo get_phrase('contact');?></div></th>
			<th><div><?php echo get_phrase('address');?></div></th>
			<th><div><?php echo get_phrase('type');?></div></th>
			<th><div><?php echo get_phrase('options');?></div></th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$counter = 1;
		$admins	=	$this->db->get('admin' )->result_array();
		foreach($admins as $row):
		?>
		<tr>
			<td style="width:30px;">
           		<?php echo $counter++;?>
           	</td>
			<td><?php echo $row['name'];?></td>
			<td>
				<?php echo $row['email'];?>
            </td>
			<td>
             <?php if ($row['email'] != ''):?>
              <a class="tooltip-primary" data-toggle="tooltip" data-placement="top" 
                  data-original-title="<?php echo get_phrase('send_email');?>"	
                  href="mailto:<?php echo $row['email'];?>" style="color:#bbb;">
                          <i class="entypo-mail"></i>
                 </a>
             <?php endif;?>
             <?php if ($row['phone'] != ''):?>
              <a class="tooltip-primary" data-toggle="tooltip" data-placement="top" 
                  data-original-title="<?php echo get_phrase('call_phone');?>"	
                  href="tel:<?php echo $row['phone'];?>" style="color:#bbb;">
                          <i class="entypo-phone"></i>
                 </a>
             <?php endif;?>
           </td>
           <td>
           		<?php echo $row['address'];?>
           </td>
           <td>
           		<?php if ($row['owner_status'] == 1):?>
           			<div class="badge badge-info">
           				<?php echo get_phrase('owner');?>
           			</div>
           		<?php endif;?>
           		<?php if ($row['owner_status'] == 0):?>
           			<div class="badge badge-default">
           				<?php echo get_phrase('administrator');?>
           			</div>
           		<?php endif;?>
           </td>
			<td>
            	<div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                      Action <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                      
	                  <!-- PROFILE LINK -->
	                  <li>
	                      <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/admin_profile/<?php echo $row['admin_id'];?>');">
	                          <i class="entypo-user"></i>
	                              <?php echo get_phrase('profile');?>
	                          </a>
	                                  </li>
                      
                    <?php if ($is_owner == 1):?> 
                      <!-- EDITING LINK -->
                      <li>
                          <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/admin_edit/<?php echo $row['admin_id'];?>');">
                              <i class="entypo-pencil"></i>
                                  <?php echo get_phrase('edit');?>
                              </a>
                                      </li>
                      
                      <?php endif;?>


                      <?php if ($is_owner == 1 && $row['admin_id'] != $this->session->userdata('login_user_id')):?>
                      	<li class="divider"></li>
                      <!-- DELETION LINK -->
                      <li>
                          <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/admins/delete/<?php echo $row['admin_id'];?>' , '<?php echo base_url();?>index.php?admin/reload_admin_list');" >
                              <i class="entypo-trash"></i>
                                  <?php echo get_phrase('delete');?>
                              </a>
                                      </li>
                        <?php endif;?>
                       
                  </ul>
              </div>
			</td>
		</tr>
		<?php endforeach;?>
	</tbody>
</table>



<!-- calling ajax form submission plugin for specific form -->
<script src="assets/js/ajax-form-submission.js"></script>

<script src="assets/js/neon-custom-ajax.js"></script>               
<script type="text/javascript">


	
	jQuery(document).ready(function($)
	{
		//convert all checkboxes before converting datatable
		replaceCheckboxes();
		
		// Highlighted rows
		$("#table_export tbody input[type=checkbox]").each(function(i, el)
		{
			var $this = $(el),
				$p = $this.closest('tr');
			
			$(el).on('change', function()
			{
				var is_checked = $this.is(':checked');
				
				$p[is_checked ? 'addClass' : 'removeClass']('highlight');
			});
		});
		
		// convert datatable
		var datatable = $("#table_export").dataTable({
			"sPaginationType": "bootstrap",
			"sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>",
			// "aoColumns": [
			// 	{ "bSortable": false}, 	//0,checkbox
			// 	{ "bVisible": true},		//1,name
			// 	{ "bVisible": true},		//2,role
			// 	{ "bVisible": true},		//3,contact
			// 	{ "bVisible": true}		//4,option
			// ],
			"oTableTools": {
				"aButtons": [
					
					{
						"sExtends": "xls",
						"mColumns": [1, 2, ]
					},
					{
						"sExtends": "pdf",
						"mColumns": [1,2]
					},
					{
						"sExtends": "print",
						"fnSetText"	   : "Press 'esc' to return",
						"fnClick": function (nButton, oConfig) {
							datatable.fnSetColumnVis(0, false);
							datatable.fnSetColumnVis(3, false);
							datatable.fnSetColumnVis(6, false);
							
							this.fnPrint( true, oConfig );
							
							window.print();
							
							$(window).keyup(function(e) {
								  if (e.which == 27) {
									  datatable.fnSetColumnVis(0, true);
									  datatable.fnSetColumnVis(3, true);
									  datatable.fnSetColumnVis(6, true);
								  }
							});
						},
						
					},
				]
			},
			
		});
		
		//customize the select menu
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
		
		

		
	});
		
</script>
