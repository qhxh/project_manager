
<!-- NOTE CREATION BUTTON-->
<button type="button" class="btn btn-info pull-right" id="submit-button" 
    onclick="create_note()">
    <i class="entypo-plus"></i>
    <?php echo get_phrase('create_note'); ?>
</button>

<div style="clear:both; padding: 5px;"></div>

<div class="row">

	<div class="col-md-12">
		<div class="tabs-vertical-env main_data">
			<?php include 'notes_tab_body.php';?>
		</div>	
	</div>

</div>

<script type="text/javascript">
	function create_note() {
		$.ajax({
        	url: '<?php echo base_url();?>index.php?admin/create_note/',
        	success: function(response)
        	{
            

            	// reload the notes
            	reload_data('<?php echo base_url();?>index.php?admin/reload_notes_tab_body/' + response);
	      	}
	    });
	}
</script>