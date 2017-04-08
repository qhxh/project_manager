<?php
//dem xem co moc thanh toan khong
$is_exist_milestone = $this->db->query("SELECT * FROM project_milestone WHERE project_code = '$project_code'")->num_rows();
//lay du lieu cua project
$current_project = $this->db->get_where('project', array(
            'project_code' => $project_code
        ))->result_array();
foreach ($current_project as $row):
    ?>
    <div class="col-md-7">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <?php echo get_phrase('edit_project'); ?>
                </div>

            </div>

            <div class="panel-body">

                <!-- project edit form -->
                <?php echo form_open(base_url() . 'index.php?admin/project/edit/' . $row['project_code'], array('class' => 'form-horizontal form-groups-bordered', 'enctype' => 'multipart/form-data')); ?>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('project_title'); ?></label>

                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="title" id="title" data-validate="required" 
                               data-message-required="<?php echo get_phrase('value_required'); ?>" value="<?php echo $row['title']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('description'); ?></label>

                    <div class="col-sm-8">
                        <textarea class="form-control wysihtml5" rows="10" name="description" id="post_content" 
                                  data-stylesheet-url="assets/css/wysihtml5-color.css"><?php echo $row['description']; ?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('status'); ?></label>
                    <div class="col-sm-5">
                        <select class="selectboxit" name="project_status">
                            <option><?php echo get_phrase('select_project_status'); ?></option>
                            <!-- qhxh code -->
                            <option value="2" <?php if ($row['project_status'] == 2) echo 'selected'; ?>>
                                <?php echo 'Đang bàn giao'; ?>
                            </option>
                            <option value="3" <?php if ($row['project_status'] == 3) echo 'selected'; ?>>
                                <?php echo 'Dự án mới'; ?>
                            </option>
                            <!-- end qhxh code-->
                             <option value="1" <?php if ($row['project_status'] == 1) echo 'selected'; ?>>
                                <?php echo get_phrase('running'); ?>
                            </option>
                            <option value="4" <?php if ($row['project_status'] == 4) echo 'selected'; ?>>
                                <?php echo get_phrase('cancle'); ?>
                            </option>
                            <option value="0" <?php if ($row['project_status'] == 0) echo 'selected'; ?>>
                                <?php echo get_phrase('archived'); ?>
                            </option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('budget'); ?></label>

                    <div class="col-sm-5">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="entypo-bookmarks"></i></span>
                            <input type="text" class="form-control" name="budget"  value="<?php echo $row['budget']; ?>" >
                        </div>
                    </div>
                </div>
                <!-- qhxh code -->
                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('discount').' (%)'; ?></label>

                    <div class="col-sm-5">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="entypo-bookmarks"></i></span>
                            <input type="text" class="form-control" name="discount"  value="<?php echo $row['discount']; ?>" >
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo 'Thanh toán: '; ?></label>

                    <div class="col-sm-5">
                        <span class="input-group-addon info">
                        
                        <?php if ( $is_exist_milestone > 0 )  { ?>
                        <i class="entypo-cc text-info">
                         Có <?php echo $is_exist_milestone; ?> mốc thanh toán, Xem trong mục thanh toán </i></span>
                        </i>
                        <?php 
                            } 
                            else 
                                echo '<i class="entypo-cc text-warning"> Chưa có mốc thanh toán, thêm trong mục thanh toán </i>';
                        ?>
                       
                        </span>
                    </div>
                </div>
                
                <!-- end qhxh code -->
                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('start_time'); ?></label>

                    <div class="col-sm-5">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="entypo-calendar"></i></span>
                            <input type="text" class="form-control datepicker" name="timestamp_start"  value="<?php echo $row['timestamp_start']; ?>" >
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('ending_time'); ?></label>

                    <div class="col-sm-5">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="entypo-calendar"></i></span>
                            <input type="text" class="form-control datepicker" name="timestamp_end"  value="<?php echo $row['timestamp_end']; ?>" >
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('demo_url'); ?></label>

                    <div class="col-sm-5">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="entypo-globe"></i></span>
                            <input type="text" class="form-control" name="demo_url"  value="<?php echo $row['demo_url']; ?>" >
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('progress_status'); ?></label>

                    <div class="col-sm-5" style="padding-top:9px;">
                        <div class="slider2 slider slider-blue disable" data-prefix="" data-postfix="%" 
                             data-min="-1" data-max="101" data-value="<?php echo $row['progress_status']; ?>"></div>
                        <input type="hidden" name="progress_status" id="progress_status" value="<?php echo $row['progress_status']; ?>" >
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('client'); ?></label>

                    <div class="col-sm-5">
                        <select name="client_id" class="select2">
                            <option value=""><?php echo get_phrase('select_a_client'); ?></option>
                            <?php
                            $clients = $this->db->get('client')->result_array();
                            foreach ($clients as $row2):
                                ?>
                                <option value="<?php echo $row2['client_id']; ?>"
                                        <?php if ($row['client_id'] == $row2['client_id']) echo 'selected'; ?>>
                                    <?php echo $row2['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <?php echo get_phrase('update_project'); ?></button>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('company'); ?></label>
                    <div class="col-sm-5">
                        <select name="company_id" class="form-control selectboxit">
                            <option><?php echo get_phrase('select_company'); ?></option>
                            <?php
                            $companies = $this->db->get('company')->result_array();
                            foreach ($companies as $row2):
                                ?>
                                <option value="<?php echo $row2['company_id']; ?>"
                                <?php
                                if ($row['company_id'] == $row2['company_id'])
                                    echo 'selected';
                                ?>>
                                <?php echo $row2['name']; ?></option>
    <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('assign_staff'); ?></label>

                    <div class="col-sm-8">
                        <select multiple="multiple" name="staffs[]" class="form-control multi-select" >
                            <?php
                            $staffs = $this->db->get('staff')->result_array();
                            foreach ($staffs as $row2):
                                ?>
                                <option value="<?php echo $row2['staff_id']; ?>"
                                <?php
                                        if (in_array($row2['staff_id'], explode(',', $row['staffs'])))
                                            echo 'selected';
                                        ?>>
        <?php echo $row2['name']; ?></option>
    <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                
               

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-8">
                        <button type="submit" class="btn btn-info" id="submit-button">
    <?php echo get_phrase('update_project'); ?></button>
                        <span id="preloader-form"></span>
                    </div>
                </div>
    <?php echo form_close(); ?>
                <!-- project edit form -->

            </div>
        </div>

    </div>

    <div class="col-md-3">


        <!-- client -->
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-user"></i> <?php echo get_phrase('client'); ?>
                </div>
                <div class="panel-options">
                </div>
            </div>
            <div class="panel-body">
                <?php
                if ($row['client_id'] < 1):
                    ?>
                    <center>
                        <button type="button" class="btn btn-default btn-icon icon-left" style="margin:10px;"
                                onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/project_edit/<?php echo $row['project_code']; ?>');">
        <?php echo get_phrase('add_client'); ?>
                            <i class="entypo-pencil"></i>
                        </button>
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
                                        <h4 style="font-weight: 200;"><?php echo $row3['name']; ?></h4>
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
        <?php endforeach; ?>
    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- staff -->
        <?php
        $staffs = ( explode(',', $row['staffs']));
        $number_of_staffs = count($staffs) - 1;
        ?>
        <div class=" panel panel-primary" data-collapsed="0">
           <div class="panel-heading">
                <div class="row">
                    <div class="col-md-8 panel-title">
                        <i class="entypo-users"></i> Assigned staff
                    </div>
                    <div class="col-md-4 panel-options">
                <?php if ($number_of_staffs > 0): ?>
                            <a href="<?php echo base_url(); ?>index.php?admin/projectroom/edit/<?php echo $project_code; ?>" 
                                    class="btn btn-default tooltip-primary" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('manage_staff'); ?>">
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
                        <a  href="<?php echo base_url(); ?>index.php?admin/projectroom/edit/<?php echo $project_code; ?>" 
                            class="btn btn-default btn-icon icon-left" style="margin:10px;">
        <?php echo get_phrase('add_staff'); ?>
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
<?php endforeach; ?>


