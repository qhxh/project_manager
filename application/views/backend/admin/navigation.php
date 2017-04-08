<div class="sidebar-menu">
    <header class="logo-env" >

        <!-- logo -->
        <div class="logo" style="">
            <a href="<?php echo base_url(); ?>">
                <img src="uploads/logo.png"  style="max-height:60px;"/>
            </a>
        </div>

        <!-- logo collapse icon -->
        <div class="sidebar-collapse" style="">
            <a href="#" class="sidebar-collapse-icon with-animation">

                <i class="entypo-menu"></i>
            </a>
        </div>

        <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
        <div class="sidebar-mobile-menu visible-xs">
            <a href="#" class="with-animation">
                <i class="entypo-menu"></i>
            </a>
        </div>
    </header>
    <div class="sidebar-user-info">

        <div class="sui-normal">
            <a href="#" class="user-link">
                <img src="<?php echo $this->crud_model->get_image_url($this->session->userdata('login_type'), $this->session->userdata('login_user_id'));?>" 
                    alt="" class="img-circle" style="height:44px;">

                <span><?php echo get_phrase('welcome'); ?>,</span>
                <strong>
                    <?php
                        echo $this->db->get_where($this->session->userdata('login_type'), array(
                                $this->session->userdata('login_type') . '_id' => $this->session->userdata('login_user_id')
                        ))->row()->name;
                    ?>
                </strong>
            </a>
        </div>

        <div class="sui-hover inline-links animate-in"><!-- You can remove "inline-links" class to make links appear vertically, class "animate-in" will make A elements animateable when click on user profile -->				
            <a href="<?php echo base_url();?>index.php?<?php echo $this->session->userdata('login_type');?>/manage_profile">
                <i class="entypo-pencil"></i>
                <?php echo get_phrase('edit_profile'); ?>
            </a>

            <a href="<?php echo base_url();?>index.php?<?php echo $this->session->userdata('login_type');?>/manage_profile">
                <i class="entypo-lock"></i>
                <?php echo get_phrase('change_password'); ?>
            </a>

            <span class="close-sui-popup">×</span><!-- this is mandatory -->			
        </div>
    </div>


    <div style="border-top:1px solid rgba(135,135,136,0.2);"></div>	
    <ul id="main-menu" class="">
        <!-- add class "multiple-expanded" to allow multiple submenus to open -->
        <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->

        <!-- SEARCH FORM -->
        <li id="search">
            <?php echo form_open(base_url() . 'index.php?admin/search' , array('onsubmit' => 'return validate()')); ?>
                <input id="search_input" type="text" name="search_key" class="search-input" placeholder="Search ..."/>
                <button type="submit">
                    <i class="entypo-search"></i>
                </button>
            </form>
        </li>

        <!-- DASHBOARD -->
        <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?>">
            <a href="<?php echo base_url(); ?>index.php?admin/dashboard">
                <i class="entypo-gauge"></i>
                <span><?php echo get_phrase('dashboard'); ?></span>
            </a>
        </li>

        <!-- MANAGE CLIENTS AND COMPANY -->
        <li class="<?php if ($page_name == 'client' ||
                                $page_name == 'pending_client' ||
                                    $page_name == 'company')
                                        echo 'opened active has-sub';?>">
            <a href="#">
                <i class="entypo-trophy"></i>
                <span><?php echo get_phrase('client'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'client' ||
                                        $page_name == 'pending_client')
                                            echo 'active';?>">
                    <a href="<?php echo base_url(); ?>index.php?admin/client">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('person'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'company') echo 'active';?>">
                    <a href="<?php echo base_url(); ?>index.php?admin/company">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('company'); ?></span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- MANAGE TEAM MEMBERS -->
        <li class="<?php if ($page_name == 'staff' ||
                                $page_name == 'account_role' ||
                                    $page_name == 'admins')
                                        echo 'opened active has-sub';?>">
            <a href="#">
                <i class="entypo-users"></i>
                <span><?php echo get_phrase('team'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'admins') echo 'active';?>">
                    <a href="<?php echo base_url(); ?>index.php?admin/admins">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('admin'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'staff') echo 'active';?>">
                    <a href="<?php echo base_url(); ?>index.php?admin/staff">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('staff'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'account_role') echo 'active';?>">
                    <a href="<?php echo base_url(); ?>index.php?admin/account_role">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('permission'); ?></span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- MANAGE CLIENT PROJECTS -->

        <li class="<?php if ($page_name == 'project_add' ||
                                $page_name == 'project' ||
                                    $page_name == 'project_room' ||
                                        $page_name == 'project_quote' || $page_name == 'project_quote_view'
                                        || $page_name == 'category_list')
                                            echo 'opened active has-sub';?>">
            <a href="#">
                <i class="entypo-paper-plane"></i>
                <span><?php echo get_phrase('client_project'); ?></span>
            </a>
            <ul>
                <!-- qhxh code : them menu cho category - -->
                <li class="<?php if ($page_name == 'category_list') echo 'active';?>">
                    <a href="<?php echo base_url(); ?>index.php?admin/category">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('category_manager'); ?></span>
                    </a> 
                </li>
                <!-- end qhxh code -->
                <li class="<?php if ($page_name == 'project') echo 'active';?>">
                    <a href="<?php echo base_url(); ?>index.php?admin/project">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('project_list'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'project_add') echo 'active';?>">
                    <a href="<?php echo base_url(); ?>index.php?admin/project_add">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('create_project'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'project_quote' || $page_name == 'project_quote_view') echo 'active';?>">
                    <a href="<?php echo base_url(); ?>index.php?admin/project_quote">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('project_quote'); ?></span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- TEAM TASKS -->
        <li class="<?php if ($page_name == 'team_task' ||
                                $page_name == 'team_task_archived' ||
                                    $page_name == 'team_task_view')
                                        echo 'opened active has-sub';?>">
            <a href="#">
                <i class="entypo-traffic-cone"></i>
                <span><?php echo get_phrase('team_task'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'team_task') echo 'active'; ?>">
                    <a href="<?php echo base_url(); ?>index.php?admin/team_task">
                        <i class="entypo-list"></i>
                        <span><?php echo get_phrase('running_tasks'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'team_task_archived') echo 'active'; ?>">
                    <a href="<?php echo base_url(); ?>index.php?admin/team_task_archived">
                        <i class="entypo-archive"></i>
                        <span><?php echo get_phrase('archived_tasks'); ?></span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- CALENDAR -->

        <li class="<?php if ($page_name == 'calendar') echo 'active';?>">
            <a href="<?php echo base_url(); ?>index.php?admin/calendar">
                <i class="entypo-calendar"></i>
                <span><?php echo get_phrase('calendar'); ?></span>
            </a>
        </li>

        <!-- MESSAGING -->
        <li class="<?php if ($page_name == 'message') echo 'active';?>">
            <a href="<?php echo base_url(); ?>index.php?admin/message">
                <i class="entypo-mail"></i>
                <span><?php echo get_phrase('message'); ?></span>
            </a>
        </li>
        
       
        <!-- NOTE -->

        <li class="<?php if ($page_name == 'note') echo 'active';?>">
            <a href="<?php echo base_url(); ?>index.php?admin/note">
                <i class="entypo-doc-text"></i>
                <span><?php echo get_phrase('note'); ?></span>
            </a>
        </li>

        <!-- ACCOUNTING -->

        <li class="<?php if ($page_name == 'accounting_client_payment' ||
                                $page_name == 'accounting_expense' ||
                                    $page_name == 'accounting_expense_category')
                                        echo 'opened active has-sub';?>">
            <a href="#">
                <i class="entypo-credit-card"></i>
                <span><?php echo get_phrase('accounting'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'accounting_client_payment') echo 'active';?>">
                    <a href="<?php echo base_url(); ?>index.php?admin/accounting_client_payment">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('client_payment'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'accounting_expense') echo 'active';?>">
                    <a href="<?php echo base_url(); ?>index.php?admin/accounting_expense">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('expense_management'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'accounting_expense_category') echo 'active';?>">
                    <a href="<?php echo base_url(); ?>index.php?admin/accounting_expense_category">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('expense_category'); ?></span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- REPORTS -->

        <li class="<?php if ($page_name == 'report')echo 'opened active has-sub';?>">
            <a href="<?php echo base_url(); ?>index.php?">
                <i class="entypo-chart-area"></i>
                <span><?php echo get_phrase('report'); ?></span>
            </a>
            <ul>
                <li class="<?php if (isset($report_type) && $report_type == 'project') echo 'active';?>">
                    <a href="<?php echo base_url(); ?>index.php?admin/report/project">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('project_report'); ?></span>
                    </a>
                </li>
                <li class="<?php if (isset($report_type) && $report_type == 'client') echo 'active';?>">
                    <a href="<?php echo base_url(); ?>index.php?admin/report/client">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('client_report'); ?></span>
                    </a>
                </li>
                <li class="<?php if (isset($report_type) && $report_type == 'expense') echo 'active';?>">
                    <a href="<?php echo base_url(); ?>index.php?admin/report/expense">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('expense_report'); ?></span>
                    </a>
                </li>
                <li class="<?php if (isset($report_type) && $report_type == 'income_expense') echo 'active';?>">
                    <a href="<?php echo base_url(); ?>index.php?admin/report/income_expense">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('income_expense_comparison'); ?></span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- SUPPORT TICKET -->

        <li class="<?php if ($page_name == 'support_ticket_create' ||
                                $page_name == 'support_ticket' ||
                                    $page_name == 'support_ticket_view')
                                        echo 'opened active has-sub';?>">
            <a href="#">
                <i class="entypo-lifebuoy"></i>
                <span><?php echo get_phrase('client_support'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'support_ticket') echo 'active';?>">
                    <a href="<?php echo base_url(); ?>index.php?admin/support_ticket">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('ticket_list'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'support_ticket_create') echo 'active';?>">
                    <a href="<?php echo base_url(); ?>index.php?admin/support_ticket_create">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('create_ticket'); ?></span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- SETTINGS -->

        <li class="<?php if ($page_name == 'system_settings' ||
                                $page_name == 'manage_language' ||
                                    $page_name == 'email_settings' ||
                                        $page_name == 'payment_settings')
                                            echo 'opened active has-sub';?>">
            <a href="#">
                <i class="entypo-tools"></i>
                <span><?php echo get_phrase('settings'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'system_settings') echo 'active';?>">
                    <a href="<?php echo base_url(); ?>index.php?admin/system_settings">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('system_settings'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'email_settings') echo 'active';?>">
                    <a href="<?php echo base_url();?>index.php?admin/email_settings">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('email_settings'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'payment_settings') echo 'active';?>">
                    <a href="<?php echo base_url(); ?>index.php?admin/payment_settings">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('payment_settings'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'manage_language') echo 'active';?>">
                    <a href="<?php echo base_url(); ?>index.php?admin/manage_language">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('language_settings'); ?></span>
                    </a>
                </li>
            </ul>
        </li>

        



    </ul>

</div>

<script type="text/javascript">
    function validate() {
        var search_string = $('#search_input').val();
        var search_string_length = search_string.length;
        if (search_string_length < 2) {
            toastr.error("Please enter minimum 2 characters", "Error");
            return false;
        }
    }
</script>