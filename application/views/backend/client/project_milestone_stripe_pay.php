
<div class="row">

    <div class="col-md-6">
        <?php 
            $project_code = $this->db->get_where('project_milestone' , array('project_milestone_id' => $project_milestone_id))->row()->project_code;
            $project_title = $this->db->get_where('project' , array('project_code' => $project_code))->row()->title;
        ?>
        <div class="alert alert-default">
            <?php echo get_phrase('project');?> : <?php echo $project_title;?>
        </div>
        <table class="table table-bordered" width="100%" border="1" style="border-collapse:collapse;">
            <thead>
                <tr>
                    <th width="60%"><?php echo get_phrase('milestone');?></th>
                    <th><?php echo get_phrase('amount');?></th>
                </tr>
            </thead>
            
            <tbody>
                <tr>
                    <td>
                        <?php echo $this->db->get_where('project_milestone' , array('project_milestone_id' => $project_milestone_id))->row()->title;?>
                    </td>
                    <td class="text-right">
                        <?php
                            $system_currency_id = $this->db->get_where('settings' , array('type' => 'system_currency_id'))->row()->description;
                            $currency = $this->db->get_where('currency' , array('currency_id' => $system_currency_id))->row()->currency_symbol;
                            echo $currency . $this->db->get_where('project_milestone' , array('project_milestone_id' => $project_milestone_id))->row()->amount;
                            ?>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>

    <div class="col-md-6">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title" >
                    <?php echo get_phrase('stripe_payment_form'); ?>
                </div>
            </div>
            <div class="panel-body">
            <?php echo form_open(base_url() . 'index.php?payment/stripe_payment/pay/' . $project_milestone_id , array(
                'id' => 'payment-form' , 'class' => 'form-horizontal form-groups-bordered' , 'enctype' => 'multipart/form-data'));?>
                
                    
                    <div class="form-group">
                        <label for="field-1" class="col-sm-4 control-label"><?php echo get_phrase('card_number'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" autocomplete="off" class="form-control" id="card-number" />
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="field-1" class="col-sm-4 control-label">CVC</label>

                        <div class="col-sm-8">
                            <input type="text" autocomplete="off" class="form-control" id="card-cvc" />
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="field-1" class="col-sm-4 control-label"><?php echo get_phrase('expiration_date'); ?></label>

                        <div class="col-sm-3">
                            <input type="text" autocomplete="off" class="form-control" 
                                id="card-expiry-month" placeholder="MM"/>
                        </div>
                        <div class="col-sm-5">
                            <input type="text" style="float: left;" autocomplete="off" 
                                class="form-control" id="card-expiry-year" placeholder="YYYY"/>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-offset-4">
                            <button type="submit" class="btn btn-info" id="submit-button">
                                <?php echo get_phrase('submit_payment'); ?>
                            </button>
                            <a href="<?php echo base_url();?>index.php?client/projectroom/payment/<?php echo $project_code;?>" class="btn btn-default">
                                <?php echo get_phrase('discard');?>
                            </a>
                        </div>
                    </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
    
</div>

<?php 
    $publishable_key = $this->db->get_where('settings' , array('type' => 'stripe_publishable_key'))->row()->description;
?>


<script type="text/javascript" src="https://js.stripe.com/v1/"></script>
<script type="text/javascript">
    // this identifies your website in the createToken call below
    
    Stripe.setPublishableKey('<?php echo $publishable_key;?>'); // the key will come from system payment settings

    function stripeResponseHandler(status, response) {
        if (response.error) {
            // re-enable the submit button
            $('#submit-button').removeAttr("disabled");
            // show the errors on the form
            toastr.error(response.error.message);
        } else {
            var form$ = $("#payment-form");
            // token contains id, last4, and card type
            var token = response['id'];
            // insert the token into the form so it gets submitted to the server
            form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
            // and submit
            form$.get(0).submit();
        }
    }

    $(document).ready(function() {
        $("#payment-form").submit(function(event) {
            // disable the submit button to prevent repeated clicks
            $('#submit-button').attr("disabled", "disabled");

            // createToken returns immediately - the supplied callback submits the form if there are no errors
            Stripe.createToken({
                number: document.getElementById('card-number').value,
                cvc: document.getElementById('card-cvc').value,
                exp_month: document.getElementById('card-expiry-month').value,
                exp_year: document.getElementById('card-expiry-year').value
            }, stripeResponseHandler);
            return false; // submit from callback
        });
    });
</script>