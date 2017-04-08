
<?php echo form_open(base_url() . 'index.php?admin/report/' . $report_type , array('class' => 'form-horizontal form-groups validate',  'id' => 'date_selector_form'));?>
     

<!-- REPORT DATE RANGE SELECTOR STARTS-->           
<div class="form-group">

	<div class="col-sm-4 col-sm-offset-4">

		<div class="daterange daterange-inline add-ranges" data-format="D MMMM, YYYY" style="cursor:text;"
			data-start-date="<?php echo date("d F, Y" , $timestamp_start);?>" data-end-date="<?php echo date("d F, Y" , $timestamp_end);?>">
			<i class="entypo-calendar"></i>
				<span id="date_range_selector" style="font-weight: 300;font-size: 20px;color:#000;">
					<?php echo date("d M, Y" , $timestamp_start) . " - " . date("d M, Y" , $timestamp_end);?>
				</span>
				<input id="date_range" type="hidden" name="date_range" value="<?php echo date("d F, Y" , $timestamp_start) . " - " . date("d F, Y" , $timestamp_end);?>">
		</div>

	</div>
	<label class="col-sm-4 control-label" style="text-align:left; padding-top:0px;">
		<button type="button" class="btn btn-info btn-lg" id="submit-button"
			onclick="update_date_range();">
			<?php echo get_phrase('search');?>
				</button>
	</label>
</div>

<script>
function update_date_range()
{
	var x = $("#date_range_selector").html();
	$("#date_range").val(x);
	$("#date_selector_form").submit();
}
</script>
<!-- REPORT DATE RANGE SELECTOR ENDS-->


<div style="clear:both;"></div>
<br />
<div class="main_data">
	<?php include "report_" . $report_type . "_body.php";?>
</div>
