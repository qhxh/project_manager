<?php 
	$current_project = $this->db->get_where('project' , array(
		'project_code' => $project_code
	))->result_array();
	foreach ($current_project as $row):
?>
<div class="col-md-9">
	
	

    <!-- table for project milestones -->

    <div class="panel panel-primary" data-collapsed="0">

        <div class="panel-heading">
            <div class="panel-title">
                <?php echo get_phrase('payment_milestones');?>
            </div>
            
        </div>
        
        <div class="panel-body" style="padding: 0px;">
            <table class="table table-striped">
                <tbody>
                    <?php
                    // $this->db->order_by('timestamp', 'desc');
                    $milestones = $this->db->get_where('project_milestone', array('project_code' => $project_code))->result_array();
                    foreach ($milestones as $row2):
                        ?>
                        <tr>
                            <td width="1"><i class="entypo-dot"></i></td>
                            <td align="left"><?php echo $row2['title'];?></td>
                            <td><?php echo date("d/m/Y" , $row2['timestamp']);?></td>
                            <td>
                                <?php if ($row2['status'] == 0):?>
                                    <div class="label label-danger">
                                        <?php echo get_phrase('unpaid');?>
                                    </div>
                                <?php endif;?>
                                <?php if ($row2['status'] == 1):?>
                                    <div class="label label-success">
                                        <?php echo get_phrase('paid');?>
                                    </div>
                                <?php endif;?>
                            </td>
                            <td align="right">

                                <?php if ($row2['status'] != 1):?>
                                <a href="#" class="btn btn-info"
                                    onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/project_milestone_pay/<?php echo $row2['project_milestone_id'];?>')">
                                    <i class="entypo-credit-card"></i>
                                    <?php echo get_phrase('make_payment'); ?>
                                </a>
                                <?php endif;?>

                                <a href="#" class="btn btn-white"
                                    onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/project_milestone_view/<?php echo $row2['project_milestone_id'];?>')">
                                    <i class="entypo-doc-text-inv"></i>
                                    View
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>
    <?php 
        $total_amount = 0;
        $paid_amount  = 0;
        foreach ($milestones as $row2) {
            $total_amount += $row2['amount'];
        }
        $paid_milestones = $this->db->get_where('project_milestone' , array('status' => 1))->result_array();
        foreach ($paid_milestones as $row2) {
            $paid_amount += $row2['amount'];
        }
    ?>
    <div class="alert alert-default">
        <strong style="color: #818da1;">
            <?php echo get_phrase('total_amount');?> : <?php echo money_format('%n', $total_amount) ;?> &nbsp; &nbsp; &nbsp;
            <?php echo get_phrase('paid_amount');?> : <?php echo money_format('%n', $paid_amount) ;?> &nbsp; &nbsp; &nbsp;
            <?php echo get_phrase('due');?> : <?php if ($total_amount < $paid_amount) echo '0d'; else echo money_format('%n', $total_amount - $paid_amount);?> 
        </strong>
    </div>
    
    <!-- table for project milestones -->
    <div class="panel panel-primary" data-collapsed="0">

        <div class="panel-heading">
            <div class="panel-title">
                <?php echo get_phrase('project_milestones');?>
            </div>
            
        </div>
        
        <div class="panel-body" style="padding: 0px;">
             <!-- project calendar -->
            <div class="calendar-env">
                <div class="calendar-body">
                    <div id="project_milestone_calendar"></div>
                </div>
            </div>  
            <!-- project calendar -->
        </div>

    </div>

</div>




<!-- custom styling for project calendar -->
<style>
    /*h2{font-weight: 200; font-size: 16px;}*/
    .fc-header-left{padding:4px !important;}
    .fc-header-right{padding:4px !important;}
</style>


<!-- calling ajax form submission plugin for specific form -->
<script src="assets/js/jquery.form.js"></script>

<script type="text/javascript">
    // ajax form plugin calls at each modal loading,
$(document).ready(function() {

    //show confirmation after the payment status
    <?php if ($this->session->flashdata('paypal_cancel') == 'true'):?>
        toastr.error('payment cancelled');
    <?php endif;?>
    <?php if ($this->session->flashdata('paypal_success') == 'true'):?>
        toastr.success('payment completed successfully');
    <?php endif;?>
    

    // config for project calendar
    $('#project_milestone_calendar').fullCalendar({
        header: {
            left: 'title',
            right: 'today prev,next'
        },
        //defaultView: 'basicWeek',

        editable: false,
        firstDay: 1,
        height: 350,
        droppable: false,
        
        events:
        [
            <?php
            $milestones = $this->db->get_where('project_milestone', array('project_code' => $project_code))->result_array();
            foreach ($milestones as $row):
            ?>
                {
                    title   :   "<?php  echo $row['title'];?>",
                    start   :   new Date(<?php echo date('Y', $row['timestamp']); ?>, 
                                    <?php echo date('m', $row['timestamp']) - 1; ?>, 
                                    <?php echo date('d', $row['timestamp']); ?>),
                    end    :   new Date(<?php echo date('Y', $row['timestamp']); ?>, 
                                    <?php echo date('m', $row['timestamp']) - 1; ?>, 
                                    <?php echo date('d', $row['timestamp']); ?>),
                    allDay: true
                },
            <?php endforeach ?>
        ]
    });

    // Datepicker
        if($.isFunction($.fn.datepicker))
        {
            $(".datepicker").each(function(i, el)
            {
                var $this = $(el),
                    opts = {
                        format: attrDefault($this, 'format', 'mm/dd/yyyy'),
                        startDate: attrDefault($this, 'startDate', ''),
                        endDate: attrDefault($this, 'endDate', ''),
                        daysOfWeekDisabled: attrDefault($this, 'disabledDays', ''),
                        startView: attrDefault($this, 'startView', 0),
                        rtl: rtl()
                    },
                    $n = $this.next(),
                    $p = $this.prev();
                                
                $this.datepicker(opts);
                
                if($n.is('.input-group-addon') && $n.has('a'))
                {
                    $n.on('click', function(ev)
                    {
                        ev.preventDefault();
                        
                        $this.datepicker('show');
                    });
                }
                
                if($p.is('.input-group-addon') && $p.has('a'))
                {
                    $p.on('click', function(ev)
                    {
                        ev.preventDefault();
                        
                        $this.datepicker('show');
                    });
                }
            });
        }

   
    
});

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
<script src="assets/js/neon-custom-ajax.js"></script>
<?php endforeach;?>