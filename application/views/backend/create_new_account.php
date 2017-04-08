<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
	$system_name	=	$this->db->get_where('settings' , array('type'=>'system_name'))->row()->description;
	$system_title	=	$this->db->get_where('settings' , array('type'=>'system_title'))->row()->description;
	?>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="Neon Admin Panel" />
        <meta name="author" content="" />

        <title><?php echo get_phrase('create_new_account');?> | <?php echo $system_title;?></title>


        <link rel="stylesheet" href="assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
        <link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css">
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
        <link rel="stylesheet" href="assets/css/bootstrap.css">
        <link rel="stylesheet" href="assets/css/neon-core.css">
        <link rel="stylesheet" href="assets/css/neon-theme.css">
        <link rel="stylesheet" href="assets/css/neon-forms.css">
        <link rel="stylesheet" href="assets/css/custom.css">

        <script src="assets/js/jquery-1.11.0.min.js"></script>

        <!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->


    </head>
    <body class="page-body login-page login-form-fall" data-url="http://neon.dev">


        <!-- This is needed when you send requests via Ajax -->
        <script type="text/javascript">
            var baseurl = '<?php echo base_url();?>';
        </script>

        <div class="login-container">

            <div class="login-header login-caret">

                <div class="login-content" style="width:100%;">

                    <a href="<?php echo base_url();?>" class="logo">
                        <img src="assets/images/logo.png" height="60" alt="" />
                    </a>

                    <p class="description">
                        <h2 style="color:#cacaca; font-weight:100;">
                            <?php echo $system_name; ?>
                        </h2>
                    </p>
                    <p class="description">Create a new client account</p>

                    <!-- progress bar indicator -->
                    <div class="login-progressbar-indicator">
                        <h3>43%</h3>
                        <span>logging in...</span>
                    </div>
                </div>

            </div>

            <div class="login-progressbar">
                <div></div>
            </div>

            <div class="login-form">

                <div class="login-content">

                    <form method="post" role="form" id="form_register">

                        <div class="form-register-success">
                            <i class="entypo-check"></i>
                            <h3>Your account is submitted to site admin.</h3>
                            <p>You can login after your account is approved. A notification email will be sent to your email after approval.</p>
                        </div>

                        <div class="form-steps">

                            <div class="step current" id="step-1">

                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="entypo-user-add"></i>
                                        </div>

                                        <input type="text" class="form-control" name="name" id="name" placeholder="Name"  autocomplete="off" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="entypo-mail"></i>
                                        </div>

                                        <input type="text" class="form-control" name="email" id="email"  placeholder="e-mail" autocomplete="off" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="entypo-lock"></i>
                                        </div>

                                        <input type="password" class="form-control" name="password" id="password" placeholder="Choose Password" autocomplete="off" />
                                    </div>
                                </div>

                                <input type="hidden" id="csrf" name="<?php echo $this->security->get_csrf_token_name();?>" 
                                    value="<?php echo $this->security->get_csrf_hash();?>">

                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-block btn-login">
                                        <i class="entypo-right-open-mini"></i>
                                        Create account
                                    </button>
                                </div>

                            </div>

                        </div>

                    </form>


                    <div class="login-bottom-links">

                        <a href="<?php echo base_url(); ?>index.php?login" class="link">
                            <i class="entypo-lock"></i>
                            <?php echo get_phrase('return_to_login_page'); ?>
                        </a>

                    </div>

                </div>

            </div>

        </div>


        <!-- Bottom Scripts -->
        <script src="assets/js/gsap/main-gsap.js"></script>
        <script src="assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
        <script src="assets/js/bootstrap.js"></script>
        <script src="assets/js/joinable.js"></script>
        <script src="assets/js/resizeable.js"></script>
        <script src="assets/js/neon-api.js"></script>
        <script src="assets/js/jquery.validate.min.js"></script>
        <script src="assets/js/neon-register.js"></script>
        <script src="assets/js/jquery.inputmask.bundle.min.js"></script>
        <script src="assets/js/neon-custom.js"></script>
        <script src="assets/js/neon-demo.js"></script>

    </body>
</html>