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
<ul class="nav nav-tabs" style="margin-bottom: 0px; border-bottom: 0px; text-align:center;">
    <!-- available classes "bordered", "right-aligned" -->
    <li class="active" style="">
        <a href="#profile" data-toggle="tab" style="color: #969696;">
        <i class="entypo-user"></i>
        <span><?php echo get_phrase('profile');?></span>
        </a>
    </li>
</ul>
<div class="tab-content" style="padding:0px;">
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
</div>
<?php endforeach;?>