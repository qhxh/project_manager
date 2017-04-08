
<?php echo form_open('admin/report_project/' , array('class' => 'form-horizontal form-groups validate',  'id' => 'date_selector_form'));?>
     

<!-- REPORT DATE RANGE SELECTOR STARTS-->           
<div class="form-group">
	<label class="col-sm-4 control-label" style="text-align:right;padding-top:6px;">
		<?php echo get_phrase('date_range');?>
	</label>

	<div class="col-sm-3">

		<div class="daterange daterange-inline add-ranges" data-format="D MMMM, YYYY" 
			data-start-date="<?php echo date("d F, Y" , $timestamp_start);?>" data-end-date="<?php echo date("d F, Y" , $timestamp_end);?>">
			<i class="entypo-calendar"></i>
				<span id="date_range_selector"><?php echo date("d F, Y" , $timestamp_start) . " - " . date("d F, Y" , $timestamp_end);?></span>
				<input id="date_range" type="hidden" name="date_range" value="<?php echo date("d F, Y" , $timestamp_start) . " - " . date("d F, Y" , $timestamp_end);?>">
		</div>

	</div>
	<label class="col-sm-3 control-label" style="text-align:left; padding-top:0px;">
		<button type="button" class="btn btn-info" id="submit-button"
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

<div class="main_data">
	<?php include "report_project_body.php";?>
</div>
