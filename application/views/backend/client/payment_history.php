<div class="row">
	<div class="col-md-12">


		<table class="table table-bordered datatable" id="table_export">
			<thead>
				<tr>
					<th style="width:30px;"></th>
					<th><div><?php echo get_phrase('project');?></div></th>
					<th><div><?php echo get_phrase('company');?></div></th>
					<th><div><?php echo get_phrase('date');?></div></th>
					<th><div><?php echo get_phrase('amount');?></div></th>
					<th><div><?php echo get_phrase('options');?></div></th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$counter = 1;
				$this->db->where('type' , 'income');
				$this->db->where('client_id' , $this->session->userdata('login_user_id'));
				$this->db->order_by('timestamp' , 'desc');
				$payments	=	$this->db->get('payment')->result_array();
				foreach($payments as $row):
				?>
				<tr>
					<td style="width:30px;">
		           		<?php echo $counter++;?>
		           	</td>
					<td>
						<?php echo $this->db->get_where('project' , array('project_code' => $row['project_code']))->row()->title;?>
					</td>
		            <td>
		           		<?php 
		            		$get_company_id = $this->db->get_where('project' , array('project_code' => $row['project_code']))->row()->company_id;
		            		if ($get_company_id > 0)
		            			echo $this->db->get_where('company' , array('company_id' => $get_company_id))->row()->name;
		            	?>
		            </td>
		            <td>
		           		<?php echo date('jS F Y' , $row['timestamp']);?>
		            </td>
		            <td>
		            	<?php echo $row['amount'];?>
		            </td>
					<td align="center">
		            	<button class="btn btn-default btn-sm"
		            		onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/project_milestone_view/<?php echo $row['milestone_id'];?>')">
		            		<i class="entypo-doc-text"></i>
		                    <?php echo get_phrase('invoice');?>
		                </button>
					</td>
				</tr>
				<?php endforeach;?>
			</tbody>
		</table>


	</div>
</div>

<script src="assets/js/neon-custom-ajax.js"></script>               
<script type="text/javascript">

	jQuery(document).ready(function($)
	{
		
		
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