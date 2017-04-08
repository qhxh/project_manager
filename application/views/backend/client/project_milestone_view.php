<?php
$milestone_details = $this->db->get_where('project_milestone', array('project_milestone_id' => $param2))->result_array();
foreach ($milestone_details as $row):
?>
<center>
    <a onClick="PrintElem('#invoice_print')" class="btn btn-default btn-icon icon-left hidden-print pull-right">
        Print
        <i class="entypo-print"></i>
    </a>
    
</center>
<?php 
    if ($row['status'] == 0):
?>
<a onClick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/project_milestone_pay/<?php echo $row['project_milestone_id'];?>')" 
    class="btn btn-default btn-icon icon-left hidden-print">
    <?php echo get_phrase('make_payment');?>
    <i class="entypo-credit-card"></i>
</a>
<?php endif;?>

    <br><br>

    <div id="invoice_print">
        <table width="100%" border="0">
            <tr>
                <td width="50%"><img src="assets/images/logo.png" style="max-height:80px;"></td>
                <td align="right">
                    <h4><?php echo get_phrase('code'); ?> : <?php echo $row['project_code']; ?></h4>
                    <h5><?php echo get_phrase('date'); ?> : <?php echo date("d/m/Y" , $row['timestamp']); ?></h5>
                    <h5><?php echo get_phrase('status'); ?> : 
                        <?php 
                            if ($row['status'] == 0) echo get_phrase('unpaid');
                            else if ($row['status'] == 1) echo get_phrase('paid');
                        ?> 
                    </h5>
                </td>
            </tr>
        </table>
        <hr>
        <table width="100%" border="0">    
            <tr>
                <td align="left"><h4><?php echo get_phrase('payment_to'); ?> </h4></td>
                <td align="right"><h4><?php echo get_phrase('bill_to'); ?> </h4></td>
            </tr>

            <tr>
                <td align="left" valign="top">
                    <?php echo $this->db->get_where('settings', array('type' => 'system_name'))->row()->description; ?><br>
                    <?php echo $this->db->get_where('settings', array('type' => 'address'))->row()->description; ?><br>
                    <?php echo $this->db->get_where('settings', array('type' => 'phone'))->row()->description; ?><br>            
                </td>
                <td align="right" valign="top">
                    <?php 
                        if ($row['company_id'] > 0)
                            echo $this->db->get_where('company' , array('company_id' => $row['company_id']))->row()->name . '<br>';
                    ?>
                    <?php echo $this->db->get_where('client', array('client_id' => $row['client_id']))->row()->name; ?><br>
                    <?php echo $this->db->get_where('client', array('client_id' => $row['client_id']))->row()->address; ?><br>
                    <?php echo $this->db->get_where('client', array('client_id' => $row['client_id']))->row()->phone; ?><br>
                </td>
            </tr>
        </table>
        <hr>
        <div class="alert alert-default">
            <strong><?php echo get_phrase('project_name');?></strong> :
            <?php echo $this->db->get_where('project' , array('project_code' =>$row['project_code']))->row()->title;?>
        </div>
        <h4><?php echo get_phrase('milestone'); ?></h4>
        <table class="table table-bordered" width="100%" border="1" style="border-collapse:collapse;">
            <thead>
                <tr>
                    <th width="60%"><?php echo get_phrase('title'); ?></th>
                    <th><?php echo get_phrase('amount'); ?></th>
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
                <td align="right" width="80%"><h4><?php echo get_phrase('grand_total'); ?> :</h4></td>
                <td align="right"><h4><?php echo $currency . $row['amount']; ?> </h4></td>
            </tr>
        </table>

    </div>
<?php endforeach; ?>


<script type="text/javascript">

    // print invoice function
    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data)
    {
        var mywindow = window.open('', 'invoice', 'height=400,width=600');
        mywindow.document.write('<html><head><title>Invoice</title>');
        mywindow.document.write('<link rel="stylesheet" href="assets/css/neon-theme.css" type="text/css" />');
        mywindow.document.write('<link rel="stylesheet" href="assets/js/datatables/responsive/css/datatables.responsive.css" type="text/css" />');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.print();
        mywindow.close();

        return true;
    }

</script>