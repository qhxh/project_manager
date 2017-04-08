<?php 
    //lay mang tien do cua cac nhan vien
    $current_staff_progress = $this->db->get_where('project_progress', array('project_code' => $project_code))->result_array();


	$current_project = $this->db->get_where('project' , array(
		'project_code' => $project_code
	))->result_array();
	foreach ($current_project as $row):
?>
<div class="col-md-7">
	
    <!-- project description -->
    <div class="panel panel-primary" data-collapsed="0">
            
        
        <div class="panel-heading">
            <div class="panel-title"><?php echo get_phrase('project_overview');?></div>
            
        </div>
        
        <div class="panel-body">
            
            <p>
                <?php echo $row['description'];?>
            </p>
            <hr />
            <p style="font-size: 10px;">
                <i class="entypo-calendar" style="color: #ccc;"></i>
                <?php echo $row['timestamp_start'];?>  <b> đến </b>  <?php echo $row['timestamp_end'];?>
                &nbsp;
                &nbsp;
                <i class="entypo-globe" style="color: #ccc;"></i>
                <a href="<?php echo $row['demo_url'];?>" target="_blank"><?php echo $row['demo_url'];?></a>
                <?php if ($row['company_id'] > 0):?>
                &nbsp;
                &nbsp;
                <i class="entypo-suitcase" style="color: #ccc;"></i>
                    <?php echo $this->db->get_where('company' , array('company_id' => $row['company_id']))->row()->name;?>
                <?php endif;?> 

            </p>
            <!-- qhxh code: liet ke tong quan du an chi tiet -->
            <hr />
            <?php 
                //title cho trang thai du an
                if ($row['project_status'] == 0) $status_title = 'Đã lưu trữ';
                if ($row['project_status'] == 1) $status_title = 'Đang thực hiện';
                if ($row['project_status'] == 2) $status_title = 'Dự án mới';
                if ($row['project_status'] == 3) $status_title = 'Đang bàn giao';
            ?>
            <h5> Thông tin dự án </h5>
            <table class="table table-hover table-bordered table-striped">
                    <tr> 
                        <td> Trạng thái </td>
                        <td> <?php echo $status_title; ?> </td>
                    </tr>
                    <tr> 
                        <td> Ngân sách </td>
                        <td> <?php echo money_format('%n', $row['budget']); ?></td>
                    </tr>
                    <tr> 
                        <td> Chiết khấu </td>
                        <td> <?php echo $row['discount'];?>%</td>
                    </tr>
            </table>
            <!-- end qhxh code -->
            <hr />
            <p>
                <h5> Tiến độ thực hiện</h5>
                <?php 
                $status = 'info';
                if ($row['progress_status'] == 100)$status = 'success';
                if ($row['progress_status'] < 50)$status = 'danger';
                ?>
                
                <div class="progress progress-striped <?php if ($row['progress_status']!=100)echo 'active';?> tooltip-primary" 
                    style="height:10px !important; cursor:pointer;"  data-toggle="tooltip"  data-placement="top"
                        title="" data-original-title="<?php echo $row['progress_status'];?>% completed" >
                    <div class="progress-bar progress-bar-<?php echo $status;?>" 
                        role="progressbar" aria-valuenow="<?php echo $row['progress_status'];?>" 
                            aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $row['progress_status'];?>%">
                      <span class="sr-only">40% Complete (success)</span>
                    </div>
                </div>
                
            </p>
            <!-- qhxh code: them danh sach tien do cua cac nhan vien -->
            <h5> Chi tiết tiến độ </h5>
            <table class=" table table-bordered table-hover">
            <thead>
                <tr>
                    <td> Nhân viên </td>
                    <td> Tiến độ (%) </td>
                </tr>
            </thead>
            <tbody>
            <?php 
                foreach ($current_staff_progress as $staff_progress) {
                    
                    $current_staff = $this->db->get_where('staff', array('staff_id' => $staff_progress['staff_id'] ))->row();

                    //dat mat cho row
                    if ( $staff_progress['progress_percent'] > 80 ) $color = 'success';
                    else if ( $staff_progress['progress_percent'] < 80 &&  $staff_progress['progress_percent'] > 30 ) $color = 'warning';
                    else $color = "danger";
                    
                    echo '<tr class = "'.$color.'">';
                    echo '<td>'. $current_staff->name .'</td>';
                    echo '<td>'. $staff_progress['progress_percent'] .  '</td>';
                    echo '</tr>';
                }
            ?>
            
            </tbody>
            </table>
            <!-- end qhxh code -->
        </div>
        
    </div>
    <!-- project description -->

</div>

<div class="col-md-3">
    

    <!-- client -->
    <div class="panel panel-primary" data-collapsed="0">
        <div class="panel-heading">
            <div class="panel-title">
                <i class="entypo-user"></i> <?php echo get_phrase('client');?>
            </div>
            <div class="panel-options">
            </div>
        </div>
        <div class="panel-body">
            <?php
                if ($row['client_id'] < 1):
                    ?>
                    <center>
                        <a href="<?php echo base_url(); ?>index.php?admin/projectroom/edit/<?php echo $project_code; ?>" 
                            class="btn btn-default btn-icon icon-left" style="margin:10px;">
                            <?php echo get_phrase('add_client'); ?>
                            <i class="entypo-pencil"></i>
                        </a>
                    </center>
            <?php endif; ?>

            <table width="100%" border="0">
            <tbody>
                <?php
                if ($row['client_id'] > 0):
                    $client_data = $this->db->get_where('client', array('client_id' => $row['client_id']))->result_array();
                    foreach ($client_data as $row3):
                        ?>
                <tr>
                    <td rowspan="2" width="60">
                        <img src="<?php echo $this->crud_model->get_image_url('client', $row3['client_id']); ?>" 
                            alt="" class="img-circle" width="44">
                    </td>
                    <td>
                        <h4 style="font-weight: 200;"><?php echo $row3['name'];?></h4>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php if ($row3['skype_id'] != ''): ?>
                            <a class="tooltip-primary" data-toggle="tooltip" data-placement="top" 
                               data-original-title="<?php echo get_phrase('call_skype'); ?>"    
                               href="skype:<?php echo $row3['skype_id']; ?>?chat" style="color:#bbb;">
                                <i class="entypo-skype"></i>
                            </a>
                        <?php endif; ?>
                        <?php if ($row3['email'] != ''): ?>
                            <a class="tooltip-primary" data-toggle="tooltip" data-placement="top" 
                               data-original-title="<?php echo get_phrase('send_email'); ?>"    
                               href="mailto:<?php echo $row3['email']; ?>" style="color:#bbb;">
                                <i class="entypo-mail"></i>
                            </a>
                        <?php endif; ?>
                        <?php if ($row3['phone'] != ''): ?>
                            <a class="tooltip-primary" data-toggle="tooltip" data-placement="top" 
                               data-original-title="<?php echo get_phrase('call_phone'); ?>"    
                               href="tel:<?php echo $row3['phone']; ?>" style="color:#bbb;">
                                <i class="entypo-phone"></i>
                            </a>
                        <?php endif; ?>
                        <?php if ($row3['facebook_profile_link'] != ''): ?>
                            <a class="tooltip-primary" data-toggle="tooltip" data-placement="top" 
                               data-original-title="<?php echo get_phrase('facebook_profile'); ?>"  
                               href="<?php echo $row3['facebook_profile_link']; ?>" style="color:#bbb;" target="_blank">
                                <i class="entypo-facebook"></i>
                            </a>
                        <?php endif; ?>
                        <?php if ($row3['twitter_profile_link'] != ''): ?>
                            <a class="tooltip-primary" data-toggle="tooltip" data-placement="top" 
                               data-original-title="<?php echo get_phrase('twitter_profile'); ?>"   
                               href="<?php echo $row3['twitter_profile_link']; ?>" style="color:#bbb;" target="_blank">
                                <i class="entypo-twitter"></i>
                            </a>
                        <?php endif; ?>
                        <?php if ($row3['linkedin_profile_link'] != ''): ?>
                            <a class="tooltip-primary" data-toggle="tooltip" data-placement="top" 
                               data-original-title="<?php echo get_phrase('linkedin_profile'); ?>"  
                               href="<?php echo $row3['linkedin_profile_link']; ?>" style="color:#bbb;" target="_blank">
                                <i class="entypo-linkedin"></i>
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach;?>
        <?php endif;?>
            </tbody>
            </table>
        </div>
    </div>

    <!-- staff -->
    <?php 
        $staffs = ( explode(',', $row['staffs']));
        $number_of_staffs = count($staffs) - 1;
    ?>
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-8 panel-title">
                        <i class="entypo-users"></i> Assigned staff
                    </div>
                    <div class="col-md-4 panel-options">
                <?php if ($number_of_staffs > 0): ?>
                            <a href="<?php echo base_url(); ?>index.php?admin/projectroom/edit/<?php echo $project_code; ?>" 
                                    class="pull-right tooltip-primary" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('manage_staff'); ?>">
                                <i class="entypo-pencil"></i>
                            </a>
                <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="panel-body">

                <?php
                    if ($number_of_staffs < 1):
                        ?>

                        <center>
                            <a  href="<?php echo base_url();?>index.php?admin/projectroom/edit/<?php echo $project_code;?>" 
                                class="btn btn-default btn-icon icon-left" style="margin:10px;">
                                <?php echo get_phrase('manage_staff'); ?>
                                <i class="entypo-pencil"></i>
                            </a>
                        </center>
                    <?php endif; ?>

                <?php
                    if ($number_of_staffs > 0):
                        for ($i = 0; $i < $number_of_staffs; $i++):
                            $staff_data = $this->db->get_where('staff', array('staff_id' => $staffs[$i]))->result_array();
                            foreach ($staff_data as $row2):
                                ?>
                                <table width="100%" border="0">
                                    <tr>
                                        <td rowspan="2" width="60">
                                            <img src="<?php echo $this->crud_model->get_image_url('staff', $row2['staff_id']); ?>" 
                                                 alt="" class="img-circle" width="44">
                                        </td>
                                        <td>
                                            <h4 style="font-weight: 200;"><?php echo $row2['name']; ?></h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php if ($row2['skype_id'] != ''): ?>
                                                <a class="tooltip-primary" data-toggle="tooltip" data-placement="top" 
                                                   data-original-title="<?php echo get_phrase('call_skype'); ?>"    
                                                   href="skype:<?php echo $row2['skype_id']; ?>?chat" style="color:#bbb;">
                                                    <i class="entypo-skype"></i>
                                                </a>
                                            <?php endif; ?>
                                            <?php if ($row2['email'] != ''): ?>
                                                <a class="tooltip-primary" data-toggle="tooltip" data-placement="top" 
                                                   data-original-title="<?php echo get_phrase('send_email'); ?>"    
                                                   href="mailto:<?php echo $row2['email']; ?>" style="color:#bbb;">
                                                    <i class="entypo-mail"></i>
                                                </a>
                                            <?php endif; ?>
                                            <?php if ($row2['phone'] != ''): ?>
                                                <a class="tooltip-primary" data-toggle="tooltip" data-placement="top" 
                                                   data-original-title="<?php echo get_phrase('call_phone'); ?>"    
                                                   href="tel:<?php echo $row2['phone']; ?>" style="color:#bbb;">
                                                    <i class="entypo-phone"></i>
                                                </a>
                                            <?php endif; ?>
                                            <?php if ($row2['facebook_profile_link'] != ''): ?>
                                                <a class="tooltip-primary" data-toggle="tooltip" data-placement="top" 
                                                   data-original-title="<?php echo get_phrase('facebook_profile'); ?>"  
                                                   href="<?php echo $row2['facebook_profile_link']; ?>" style="color:#bbb;" target="_blank">
                                                    <i class="entypo-facebook"></i>
                                                </a>
                                            <?php endif; ?>
                                            <?php if ($row2['twitter_profile_link'] != ''): ?>
                                                <a class="tooltip-primary" data-toggle="tooltip" data-placement="top" 
                                                   data-original-title="<?php echo get_phrase('twitter_profile'); ?>"   
                                                   href="<?php echo $row2['twitter_profile_link']; ?>" style="color:#bbb;" target="_blank">
                                                    <i class="entypo-twitter"></i>
                                                </a>
                                            <?php endif; ?>
                                            <?php if ($row2['linkedin_profile_link'] != ''): ?>
                                                <a class="tooltip-primary" data-toggle="tooltip" data-placement="top" 
                                                   data-original-title="<?php echo get_phrase('linkedin_profile'); ?>"  
                                                   href="<?php echo $row2['linkedin_profile_link']; ?>" style="color:#bbb;" target="_blank">
                                                    <i class="entypo-linkedin"></i>
                                                </a>
                                            <?php endif; ?>

                                        </td>
                                    </tr>
                                </table>
                                <br>
                                <?php
                            endforeach;
                        endfor;
                    endif;
                    ?>
            </div>
        </div>

</div>
<?php endforeach;?>
