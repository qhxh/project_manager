
<div class="mail-header" style="padding-bottom: 27px ;">
	<!-- title -->
	<h3 class="mail-title">
		<?php echo get_phrase('write_new_message');?>
	</h3>
</div>

<div class="mail-compose">
		
	<?php echo form_open(base_url() . 'index.php?admin/message/send_new/' , array(
		'class' => 'form', 'onsubmit' => 'return check_receiver()' , 'enctype' => 'multipart/form-data'));?>
		
		
		<div class="form-group">
			<label for="subject"><?php echo get_phrase('recipient');?>:</label>
			<br><br>
                        <select multiple="multiple" name="receiver[]" id="receiver" class="form-control multi-select">

				<option value=""><?php echo get_phrase('select_a_user');?></option>
				<optgroup label="<?php echo get_phrase('staff');?>">
					<?php 
					$staffs	=	$this->db->get('staff')->result_array();
					foreach ($staffs as $row):
						?>

						<option value="staff-<?php echo $row['staff_id'];?>">
							- <?php echo $row['name'];?></option>

					<?php endforeach;?>
				</optgroup>
				<optgroup label="<?php echo get_phrase('client');?>">
					<?php 
					$clients	=	$this->db->get('client')->result_array();
					foreach ($clients as $row):
						?>

						<option value="client-<?php echo $row['client_id'];?>">
							- <?php echo $row['name'];?></option>

					<?php endforeach;?>
				</optgroup>
			</select>
		</div>
		
		
		<div class="">
			<textarea rows="4" class="form-control autogrow"  name="message" 
				placeholder="<?php echo get_phrase('write_your_message');?>" id=""></textarea>
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