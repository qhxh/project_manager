<?php 
    $company_profile =   $this->db->get_where('company' , array('company_id' => $param2))->result_array();
    foreach ($company_profile as $row):
?>
<div class="row">
    <div class="col-md-12" style="text-align:center;">
        <div class="profile-picture">
            <h3 style="font-weight:200;"><?php echo $row['name'];?></h3>
            <?php if ($row['email'] != ''): ?>
                <a class="tooltip-primary" data-toggle="tooltip" data-placement="top" 
                   data-original-title="<?php echo get_phrase('send_email'); ?>"    
                   href="mailto:<?php echo $row['email']; ?>" style="color:#bbb;">
                    <i class="entypo-mail"></i>
                </a>
            <?php endif; ?>
            <?php if ($row['phone'] != ''): ?>
                <a class="tooltip-primary" data-toggle="tooltip" data-placement="top" 
                   data-original-title="<?php echo get_phrase('call_phone'); ?>"    
                   href="tel:<?php echo $row['phone']; ?>" style="color:#bbb;">
                    <i class="entypo-phone"></i>
                </a>
            <?php endif; ?>
            <?php if ($row['website'] != ''): ?>
                <a class="tooltip-primary" data-toggle="tooltip" data-placement="top" 
                   data-original-title="<?php echo get_phrase('website'); ?>"   
                   href="<?php echo $row['website']; ?>" style="color:#bbb;" target="_blank">
                    <i class="entypo-network"></i>
                </a>
            <?php endif; ?>
            
        </div>
    </div>
</div>
<hr />
<ul class="nav nav-tabs">
    <!-- available classes "bordered", "right-aligned" -->
    <li class="active" style="">
        <a href="#profile" data-toggle="tab" style="color: #969696;">
        <i class="entypo-user"></i>
        <span><?php echo get_phrase('profile');?></span>
        </a>
    </li>
    <li class="" style="">
        <a href="#project" data-toggle="tab" style="color: #969696;">
        <i class="entypo-paper-plane"></i>
        <span><?php echo get_phrase('projects');?></span>
        </a>
    </li>
    <li class="" style="">
        <a href="#payment" data-toggle="tab" style="color: #969696;">
        <i class="entypo-credit-card"></i>
        <span><?php echo get_phrase('payments');?></span>
        </a>
    </li>
</ul>
<div class="tab-content">
<br>
    <div class="tab-pane active" id="profile">
        <table class="table table-striped">
            <tbody>
                <tr>
                    <td width="50%">
                        <i class="entypo-dot"></i> &nbsp;
                        <?php echo get_phrase('total_project');?>
                    </td>
                    <td>
                        <b>
                            <?php 
                                $this->db->like('company_id' , $row['company_id']);
                                $this->db->from('project');
                                echo $this->db->count_all_results();
                            ?>
                        </b>
                    </td>
                </tr>

                <?php if ($row['address'] != ''):?>
                <tr>
                    <td>
                        <i class="entypo-dot"></i> &nbsp;
                        <?php echo get_phrase('address');?>
                    </td>
                    <td>
                        <b><?php echo $row['address'];?></b>
                    </td>
                </tr>
                <?php endif;?>

                <?php 
                    if ($row['client_id'] > 0 && $row['client_id'] != ''):
                ?>
                <tr>
                    <td>
                        <i class="entypo-dot"></i> &nbsp;
                        <?php echo get_phrase('associated_person');?>
                    </td>
                    <td>
                        <b><?php echo $this->db->get_where('client' , array('client_id' => $row['client_id']))->row()->name;?></b>
                    </td>
                </tr>
                <?php endif;?>

                <?php if ($row['email'] != ''):?>
                <tr>
                    <td>
                        <i class="entypo-dot"></i> &nbsp;
                        <?php echo get_phrase('email');?>
                    </td>
                    <td>
                        <b><?php echo $row['email'];?></b>
                    </td>
                </tr>
                <?php endif;?>

                <?php if ($row['phone'] != ''):?>
                <tr>
                    <td>
                        <i class="entypo-dot"></i> &nbsp;
                        <?php echo get_phrase('phone');?>
                    </td>
                    <td>
                        <b><?php echo $row['phone'];?></b>
                    </td>
                </tr>
                <?php endif;?>

                <?php if ($row['website'] != ''):?>
                <tr>
                    <td>
                        <i class="entypo-dot"></i> &nbsp;
                        <?php echo get_phrase('website');?>
                    </td>
                    <td>
                        <b><?php echo $row['website'];?></b>
                    </td>
                </tr>
                <?php endif;?>

            </tbody>
        </table>
    </div>
    <!-- PROJECT HISTORY -->
    <div class="tab-pane" id="project">
        <table class="table table-striped">
            <tbody>
                <?php 
                    $query = $this->db->get_where('project' , array('company_id' => $param2));
                    if ($query->num_rows() > 0):
                        $company_projects = $query->result_array();
                        foreach ($company_projects as $row2):
                ?>
                <tr>
                    <td width="93%">
                        <i class="entypo-dot"></i> 
                        <?php echo $row2['title'];?>
                    </td>
                    <td>
                        <a href="<?php echo base_url();?>index.php?admin/projectroom/wall/<?php echo $row2['project_code'];?>" target="_blank" class="btn btn-xs btn-white ">
                            <i class="entypo-right-open-mini"></i>
                        </a>
                    </td>
                </tr>
            <?php 
            endforeach;
            endif;
            ?>

            <?php if ($query->num_rows() < 1):?>
                <h4 class="text-center" style="color: #ccc;">
                    <?php echo get_phrase('no_project_from_this_company');?>
                </h4>
            <?php endif;?>
                
            </tbody>
        </table>
    </div>
    <!-- PAYMENT HISTORY -->
    <div class="tab-pane" id="payment">
        <table class="table table-striped">
            <tbody>
                <?php 
                    $this->db->order_by('timestamp' , 'desc');
                    $this->db->where('type' , 'income');
                    $this->db->where('company_id' , $param2);
                    $payments = $this->db->get('payment')->result_array();
                    foreach ($payments as $row2):
                ?>
                <tr>
                    <td width="40%">
                        <i class="entypo-dot"></i> 
                        <?php echo date('jS F Y' , $row2['timestamp']);?>
                    </td>
                    <td>
                        <?php echo $row2['amount'];?>
                    </td>
                    <td>
                        <?php echo $row2['payment_method'];?>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>
<?php endforeach;?>