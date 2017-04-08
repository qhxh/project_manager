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

        <!-- DASHBOARD -->
        <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?>">
            <a href="<?php echo base_url(); ?>index.php?client/dashboard">
                <i class="entypo-gauge"></i>
                <span><?php echo get_phrase('dashboard'); ?></span>
            </a>
        </li>

        <!-- MANAGE PROJECTS -->

        <li class="<?php if ($page_name == 'project' ||
                                $page_name == 'project_room' ||
                                    $page_name == 'project_quote' ||
                                        $page_name == 'project_milestone_stripe_pay' ||
                                            $page_name == 'project_quote_view')
                                                echo 'opened active has-sub';?>">
            <a href="#">
                <i class="entypo-paper-plane"></i>
                <span><?php echo get_phrase('project'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'project') echo 'active';?>">
                    <a href="<?php echo base_url(); ?>index.php?client/project">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('project_list'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'project_quote' || $page_name == 'project_quote_view') echo 'active';?>">
                    <a href="<?php echo base_url(); ?>index.php?client/project_quote">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('project_quote'); ?></span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- PAYMENT HISTORY -->

        <li class="<?php if ($page_name == 'payment_history') echo 'active';?>">
            <a href="<?php echo base_url(); ?>index.php?client/payment_history">
                <i class="entypo-credit-card"></i>
                <span><?php echo get_phrase('payment_history'); ?></span>
            </a>
        </li>

        <!-- NOTE -->

        <li class="<?php if ($page_name == 'note') echo 'active';?>">
            <a href="<?php echo base_url(); ?>index.php?client/note">
                <i class="entypo-doc-text"></i>
                <span><?php echo get_phrase('note'); ?></span>
            </a>
        </li>

        <!-- MESSAGE -->

        <li class="<?php if ($page_name == 'message') echo 'active';?>">
            <a href="<?php echo base_url(); ?>index.php?client/message">
                <i class="entypo-mail"></i>
                <span><?php echo get_phrase('message'); ?></span>
            </a>
        </li>

        <!-- SUPPORT TICKET -->

        <li class="<?php if ($page_name == 'support_ticket_create' ||
                                $page_name == 'support_ticket' ||
                                    $page_name == 'support_ticket_view')
                                        echo 'opened active has-sub';?>">
            <a href="#">
                <i class="entypo-lifebuoy"></i>
                <span><?php echo get_phrase('support'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'support_ticket') echo 'active';?>">
                    <a href="<?php echo base_url(); ?>index.php?client/support_ticket">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('ticket_list'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'support_ticket_create') echo 'active';?>">
                    <a href="<?php echo base_url(); ?>index.php?client/support_ticket_create">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('create_ticket'); ?></span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- ACCOUNT -->

        <li class="<?php if ($page_name == 'manage_profile') echo 'active';?>">
            <a href="<?php echo base_url(); ?>index.php?client/manage_profile">
                <i class="entypo-lock"></i>
                <span><?php echo get_phrase('account'); ?></span>
            </a>
        </li>

    </ul>

</div>