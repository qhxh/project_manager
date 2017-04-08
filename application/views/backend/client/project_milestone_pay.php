<?php
$milestone_details = $this->db->get_where('project_milestone', array('project_milestone_id' => $param2))->result_array();
foreach ($milestone_details as $row):
?>

<a onClick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/project_milestone_view/<?php echo $row['project_milestone_id'];?>')" 
    class="btn btn-default btn-icon icon-left hidden-print">
    <?php echo get_phrase('view_invoice');?>
    <i class="entypo-doc-text"></i>
</a>

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
                    $system_currency_id = $this->db->get_where('settings' , array('type' => 'system_currency_id'))->row()->description;
                    $currency = $this->db->get_where('currency' , array('currency_id' => $system_currency_id))->row()->currency_symbol;
                    echo $currency . $row['amount'];
                    ?>
            </td>
        </tr>
    </tbody>
</table>
<table width="100%" border="0">    
    <tr>
    	<td colspan="2"><hr style="margin:0px;"></td>
    </tr>
    <tr>
    	<td align="right" width="80%"><h4><?php echo get_phrase('grand_total');?> :</h4></td>
    	<td align="right"><h4><?php echo $currency . $row['amount'];?> </h4></td>
    </tr>
</table>

<br>


<div class="panel panel-primary" data-collapsed="0">
    <div class="panel-heading">
        <div class="panel-title" >
            <?php echo get_phrase('payment_wizard'); ?>
        </div>
    </div>
    <div class="panel-body">
        
        <table class="table table-bordered">
        <tr>
            <td align="left" width="30%">
                <img style="width: 80%;" src="<?php echo base_url();?>assets/images/bank.jpg">
            </td>
            <td align="left">
               <h5> Chuyển khoản qua ngân hàng Vietcombank </h5>
               <p>
                    Quý khách có thể thanh toán bằng cách chuyển khoản ngân hàng với thông tin: </br>
                    Số tài khoản: </br>
                    Tên chủ tài khoản </br>
                    Thông tin liên hệ:
               </p>
            </td>
        </tr>
        <tr>
            <td align="left">
                <img style="width: 80%;" src="<?php echo base_url();?>assets/images/paymen_direct.jpg">
            </td>
            <td align="left">
            <h5> Thanh toán trực tiếp tại văn phòng công ty </h5>
            <p>
                    Quý khách có thể thanh toán trực tiếp tại văn phòng công ty. </br>
                    Địa chỉ:
               </p>
                <!-- 
                <a class="btn btn-default" href="<?php echo base_url();?>index.php?payment/stripe_payment/<?php echo $row['project_milestone_id'];?>">
                    <?php echo get_phrase('pay_with');?> Stripe.jpg
                </a>
                !-->
            </td>
        </tr>
        </table>
        

    </div>
</div>



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

