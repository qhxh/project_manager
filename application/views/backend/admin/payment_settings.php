
<?php echo form_open(base_url() . 'index.php?admin/payment_settings/update_payment_settings' , 
			array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
    <div class="row">
        <div class="col-md-12">
            
            <div class="panel panel-primary" >
            
                <div class="panel-heading">
                    <div class="panel-title">
                        <?php echo get_phrase('payment_settings');?>
                    </div>
                </div>
                
                <div class="panel-body">

                <div class="form-group">
                    <label  class="col-sm-3 col-sm-offset-1 control-label"><?php echo get_phrase('system_currency');?></label>
                    <div class="col-sm-3">
                        <select class="form-control selectboxit" name="system_currency_id">
                        <?php 
                          $currencies = $this->db->get('currency')->result_array();
                          $system_currency_id = $this->db->get_where('settings' , array('type' => 'system_currency_id'))->row()->description;
                          foreach ($currencies as $row):
                        ?>
                          <option value="<?php echo $row['currency_id'];?>"
                            <?php if ($row['currency_id'] == $system_currency_id) echo 'selected';?>>
                              <?php echo $row['currency_name'];?></option>
                        <?php endforeach;?>
                        </select>
                    </div>
                </div>

                <hr />

                <center>
                    <img src="<?php echo base_url();?>assets/images/paypal.png" style="width: 10%;">
                </center>
                <br>
                    
                  <div class="form-group">
                      <label  class="col-sm-3 col-sm-offset-1 control-label"><?php echo get_phrase('paypal_email');?></label>
                      <div class="col-sm-5">
                          <input type="text" class="form-control" name="paypal_email" 
                              value="<?php echo $this->db->get_where('settings' , array('type' =>'paypal_email'))->row()->description;?>">
                      </div>
                  </div>

                  <hr />

                    <center>
                        <img src="<?php echo base_url();?>assets/images/stripe.png" style="width: 10%;">
                    </center>
                <br>
                    
                  <div class="form-group">
                      <label  class="col-sm-3 col-sm-offset-1 control-label"><?php echo get_phrase('stripe_secret_key');?></label>
                      <div class="col-sm-5">
                          <input type="text" class="form-control" name="stripe_api_key" 
                              value="<?php echo $this->db->get_where('settings' , array('type' =>'stripe_api_key'))->row()->description;?>">
                      </div>
                  </div>
                    
                  <div class="form-group">
                      <label  class="col-sm-3 col-sm-offset-1 control-label"><?php echo get_phrase('stripe_publishable_key');?></label>
                      <div class="col-sm-5">
                          <input type="text" class="form-control" name="stripe_publishable_key" 
                              value="<?php echo $this->db->get_where('settings' , array('type' =>'stripe_publishable_key'))->row()->description;?>">
                      </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-5">
                        <button type="submit" class="btn btn-info"><?php echo get_phrase('save');?></button>
                    </div>
                  </div>
                    
                </div>
            
            </div>
        
        </div>
    </div>
	<?php echo form_close();?>