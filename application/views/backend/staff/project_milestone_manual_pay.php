<?php
$milestone_details = $this->db->get_where('project_milestone', array('project_milestone_id' => $param2))->result_array();
foreach ($milestone_details as $row):
?>

<div style="clear:both;"></div>
<h4><?php echo get_phrase('milestone');?> :</h4>
<table class="table table-bordered" width="100%" border="1" style="border-collapse:collapse;">
    <thead>
        <tr>
            <th width="60%"><?php echo get_phrase('title');?></th>
            <th><?php echo get_phrase('amount');?></th>
        </tr>
    </thead>
    
    <tbody>
        <tr>
            <td>
				<?php echo $row['title'];?>
            </td>
            <td class="text-right">
            	<?php
                    $currency = $this->db->get_where('currency' , array('currency_id' => $row['currency_id']))->row()->currency_symbol;
                    echo $currency . $row['amount'];
                    ?>
            </td>
        </tr>
    </tbody>
</table>
<table width="100%" border="0">    
    <!-- <tr>
    	<td align="right" width="80%"><?php //echo get_phrase('sub_total');?> :</td>
    	<td align="right"><?php //echo $currency_symbol.$total_amount;?></td>
    </tr>
    <tr>
    	<td align="right" width="80%"><?php //echo get_phrase('vat_percentage');?> :</td>
    	<td align="right"><?php //echo $row['vat_percentage'];?>% </td>
    </tr>
    <tr>
    	<td align="right" width="80%"><?php //echo get_phrase('discount');?> :</td>
    	<td align="right"><?php //echo $currency_symbol.$row['discount_amount'];?> </td>
    </tr> -->
    <tr>
    	<td colspan="2"><hr style="margin:0px;"></td>
    </tr>
    <tr>
    	<td align="right" width="80%"><h4><?php echo get_phrase('grand_total');?> :</h4></td>
    	<td align="right"><h4><?php echo $currency . $row['amount'];?> </h4></td>
    </tr>
</table>

<br>
<h4><?php echo get_phrase('take_payment_manually');?> :</h4>

<?php echo form_open(base_url() . 'index.php?admin/project_milestone/take_manual_payment/' . $row['project_milestone_id'] , array('class' => 'form-horizontal form-groups validate manual-payment'));?>
                    
    <div class="form-group">
        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('payment_method');?></label>
        
        <div class="col-sm-7">
            <input type="text" class="form-control" name="payment_method" data-validate="required" 
                data-message-required="<?php echo get_phrase('value_required');?>" value="" placeholder="e.g. Cheque, cash">
        </div>
    </div>    

    <div class="form-group">
        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('description');?></label>
        
        <div class="col-sm-7">
            <textarea name="description" class="form-control"></textarea>
        </div>
    </div>

    <div class="form-group">
        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('amount');?></label>
        
        <div class="col-sm-7">
            <input type="text" class="form-control" name="amount" value="<?php echo $row['amount'];?>" readonly>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-8">
            <button type="submit" class="btn btn-info" id="submit-button">
                <?php echo get_phrase('take_payment');?></button>
        </div>
    </div>

<?php echo form_close();?>


<?php 
    $project_code = $row['project_code'];
?>


<script>
    // url for refresh data after ajax form submission
    var post_refresh_url = '<?php echo base_url(); ?>index.php?admin/reload_projectroom_payment/<?php echo $project_code;?>';
</script>


<script type="text/javascript">
    // ajax form plugin calls at each modal loading,
$(document).ready(function() {

   //config for project milestone adding
    var options = {
        beforeSubmit: validate_payment,
        success: show_response_on_payment,
        resetForm: true
    };
    $('.manual-payment').submit(function () {
        $(this).ajaxSubmit(options);
        return false;
    });
    
    
});

function validate_payment(formData, jqForm, options) {

    if (!jqForm[0].payment_method.value)
    {
        toastr.error("Please enter a payment method", "Error");
        return false;
    }
}

// ajax success response after form submission
function show_response_on_payment(responseText, statusText, xhr, $form)  {

    
    toastr.success("Payment successfull", "Success");
    $('#modal_ajax').modal('hide');
    reload_data(post_refresh_url);
}



/*-----------------custom functions for ajax post data handling--------------------*/



// custom function for reloading table data
function reload_data(url)
{
    $.ajax({
        url: url,
        success: function(response)
        {
            // Replace new page data
            jQuery('.main_data').html(response);

            

            // calls the tooltip again on ajax success
            $('[data-toggle="tooltip"]').each(function(i, el)
            {
                var $this = $(el),
                    placement = attrDefault($this, 'placement', 'top'),
                    trigger = attrDefault($this, 'trigger', 'hover'),
                    popover_class = $this.hasClass('tooltip-secondary') ? 'tooltip-secondary' : ($this.hasClass('tooltip-primary') ? 'tooltip-primary' : ($this.hasClass('tooltip-default') ? 'tooltip-default' : ''));
                
                $this.tooltip({
                    placement: placement,
                    trigger: trigger
                });

                $this.on('shown.bs.tooltip', function(ev)
                {
                    var $tooltip = $this.next();
                    
                    $tooltip.addClass(popover_class);
                });
            });


               
        }
    });
}

</script>

<?php endforeach;?>

