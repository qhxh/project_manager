
<table class="table table-bordered datatable" id="table_export">
	<thead>
		<tr>
			<th style="width:30px;"></th>
			<th><div><?php echo get_phrase('title');?></div></th>
			<th><div><?php echo get_phrase('description');?></div></th>
			<th><div><?php echo get_phrase('options');?></div></th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$counter = 1;
		$categories	=	$this->db->get('expense_category')->result_array();
		foreach($categories as $row):
		?>
		<tr>
			<td style="width:30px;">
           		<?php echo $counter++;?>
           	</td>
			<td><?php echo $row['title'];?></td>
			<td><?php echo $row['description'];?></td>
			<td>
            	<div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                    	Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                  
                        <!-- EDITING LINK -->
                        <li>
                            <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/expense_category_edit/<?php echo $row['expense_category_id'];?>');">
                                <i class="entypo-pencil"></i>
                                    <?php echo get_phrase('edit');?>
                            </a>
                        </li>
                        <li class="divider"></li>
                      
                        <!-- DELETION LINK -->
                        <li>
                            <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?staff/accounting_expense_category/delete/<?php echo $row['expense_category_id'];?>' , '<?php echo base_url();?>index.php?staff/reload_expense_category_list');" >
                                <i class="entypo-trash"></i>
                                    <?php echo get_phrase('delete');?>
                            </a>
                        </li>
                    </ul>
                </div>
			</td>
		</tr>
		<?php endforeach;?>
	</tbody>
</table>



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


<script type="text/javascript">
	// custom function for reloading table data
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
</script>
