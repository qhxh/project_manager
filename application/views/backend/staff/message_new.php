
<div class="mail-header" style="padding-bottom: 27px ;">
	<!-- title -->
	<h3 class="mail-title">
		<?php echo get_phrase('write_new_message');?>
	</h3>
</div>

<div class="mail-compose">
		
	<?php echo form_open(base_url() . 'index.php?staff/message/send_new/' , array(
		'class' => 'form', 'onsubmit' => 'return check_receiver()' , 'enctype' => 'multipart/form-data'));?>
		
		
		<div class="form-group">
			<label for="subject"><?php echo get_phrase('recipient');?>:</label>
			<br><br>
			<select class="form-control select2" name="reciever" id="receiver">

				<option value=""><?php echo get_phrase('select_a_user');?></option>
				<optgroup label="<?php echo get_phrase('admin');?>">
					<?php 
					$admins	=	$this->db->get('admin')->result_array();
					foreach ($admins as $row):
						?>

						<option value="admin-<?php echo $row['admin_id'];?>">
							- <?php echo $row['name'];?></option>

					<?php endforeach;?>
				</optgroup>
			</select>
		</div>
		
		
		<div class="">
			<textarea rows="4" class="form-control autogrow" name="message" 
				placeholder="<?php echo get_phrase('write_your_message');?>"></textarea>
		</div>
		
		<hr>

		<button type="submit" class="btn btn-success btn-icon pull-right">
			<?php echo get_phrase('send');?>
			<i class="entypo-mail"></i>

		</button>
	<?php echo form_close();?>

</div>

<script type="text/javascript">
	function check_receiver() {
		var check_receiver = $('#receiver').val();
		if (check_receiver == '' || check_receiver == 0) {
			toastr.error("Please select a receiver", "Error");
            return false;
		}
	}
</script>