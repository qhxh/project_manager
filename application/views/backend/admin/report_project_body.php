
<center>
<h4><?php echo get_phrase('summary_report');?> </h4>
</center>
<table class="table table-bordered datatable" id="table_export">
	<thead>
		<tr>
        	<th></th>
			<th><div><?php echo get_phrase('date');?></div></th>
			<th><div><?php echo get_phrase('project');?></div></th>
			<th><div><?php echo get_phrase('amount');?></div></th>
			<th><div><?php echo get_phrase('payment_method');?></div></th>
		</tr>
	</thead>
	<tbody>
		
		<?php 
		$grand_total	=	0;
		$this->db->order_by('timestamp' , 'desc');
		
		$this->db->where('type' , 'income');
		$this->db->where('timestamp >=' , $timestamp_start);
		$this->db->where('timestamp <=' , $timestamp_end);
		$payments	=	$this->db->get('payment')->result_array();
		foreach ($payments as $row):
			$grand_total	+=	$row['amount'];
			?>
			<tr>
            	<td></td>
				<td><?php echo date("d M, Y" , $row['timestamp']);?></td>
				<td><?php echo $this->db->get_where('project',array('project_code' => $row['project_code']))->row()->title;?></td>
				<td><?php echo $row['amount'];?></td>
				<td><?php echo $row['payment_method'];?></td>
			</tr>

		<?php endforeach;?>
	</tbody>
</table>


<div class="row">
	<div class="col-sm-4 col-md-offset-4">
		
		<div class="tile-stats tile-white tile-white-primary">
			<div class="icon" style="bottom:40px;"><i class="entypo-chart-bar"></i></div>
			<div class="num" data-start="0" data-end="<?php echo $grand_total;?>" data-prefix="<?php echo $currency_symbol;?>" 
				style="font-weight:200;"	data-postfix="" data-duration="1500" data-delay="0">
				0
			</div>
			
			<h3 style="font-weight:200; font-size: 15px;"><?php echo get_phrase('total_income');?></h3>
		</div>
		
	</div>
</div>

<script>

var chart = AmCharts.makeChart("bar_chartdiv", {
    "theme": "none",
    "type": "serial",
	"startDuration": 2,
    "dataProvider": [
	<?php
		$this->db->select_sum('amount');
		$this->db->group_by('project_code'); 
		$this->db->order_by('timestamp' , 'desc');
		$this->db->select('timestamp, project_code, payment_method');
		
		$this->db->where('type' , 'income');
		$this->db->where('timestamp >=' , $timestamp_start);
		$this->db->where('timestamp <=' , $timestamp_end);
		$payments	=	$this->db->get('payment')->result_array();
		foreach ($payments as $row):
			?>
				{
                    "project": "<?php echo substr($this->db->get_where('project',array('project_code' => $row['project_code']))->row()->title , 0,20);?>",
                    "amount": <?php echo $row['amount'];?>,
                    "color": "#455064"
                },
	<?php endforeach;?> 
	],
    "graphs": [{
        "balloonText": "[[category]]: <b>[[value]]</b>",
        "colorField": "color",
        "fillAlphas": 1,
        "lineAlpha": 0.1,
        "type": "column",
        "valueField": "amount"
    }],
    "depth3D": 20,
	"angle": 30,
    "chartCursor": {
        "categoryBalloonEnabled": false,
        "cursorAlpha": 0,
        "zoomable": false
    },    
    "categoryField": "project",
    "categoryAxis": {
        "gridPosition": "start",
        "labelRotation": 30
    },
	"pathToImages"	: "<?php echo base_url();?>assets/js/amcharts/images/",
	"amExport": {
					"top": 0,
                    "right": 0,
                    "buttonColor": '#EFEFEF',
                    "buttonRollOverColor":'#DDDDDD',
					"imageFileName"	: "Project Report",
                    "exportPNG":true,
                    "exportJPG":true,
                    "exportPDF":true,
                    "exportSVG":true
	}
});
var chart = AmCharts.makeChart("chartdiv",{
	"type"			: "pie",
	"titleField"	: "project",
	"valueField"	: "amount",
	"innerRadius"	: "40%",
	"angle"			: "15",
	"depth3D"		: 10,
	"pathToImages"	: "<?php echo base_url();?>assets/js/amcharts/images/",
	"amExport": {
					"top": 0,
                    "right": 0,
                    "buttonColor": '#EFEFEF',
                    "buttonRollOverColor":'#DDDDDD',
					"imageFileName"	: "Project Report",
                    "exportPNG":true,
                    "exportJPG":true,
                    "exportPDF":true,
                    "exportSVG":true
	},
	"dataProvider"	: [
		<?php
		foreach ($payments as $row):
				?>
		{
			"project": "<?php echo substr($this->db->get_where('project',array('project_code' => $row['project_code']))->row()->title , 0,20);?>",
			"amount": <?php echo $row['amount'];?>
		},
		<?php endforeach;?>
	]
});
</script>
	

<div class="row">
	<!-- BAR DIAGRAM STARTS-->
   	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">
					<i class="entypo-chart-bar"></i>
					<?php echo get_phrase('project_income_bar');?> 
				</div>
			</div>
			<div class="panel-body">
				<div id="bar_chartdiv" style="width: 100%; height: 350px;"></div>
			</div>
		</div>
	</div>
</div>
	<!-- BAR DIAGRAM FINISHES-->

<div class="row">
	<!-- AM CHART STARTS-->
   	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">
					<i class="entypo-chart-pie"></i>
					<?php echo get_phrase('project_income_percentage');?> 
				</div>
			</div>
			<div class="panel-body">
				<div id="chartdiv" style="width:100%; height:350px;"></div>
			</div>
		</div>
	</div>
	<!-- AM CHART FINISHES-->
</div>








<script type="text/javascript">


	
	jQuery(document).ready(function($)
	{
		//convert all checkboxes before converting datatable
		replaceCheckboxes();
		var datatable = $("#table_export").dataTable({
			"sPaginationType": "bootstrap",
			"sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>",
			
			"aoColumns": [
				{ "bSortable": false}, 
				{ "bSortable": true}, 	
				{ "bVisible": true},		
				{ "bVisible": true},		
				{ "bVisible": true},		
			],
			
		});
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
		
		//customize the select menu 
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
		
	});
	


		
</script>



        
