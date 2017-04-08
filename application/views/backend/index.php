<?php 
    $system_title       =   $this->db->get_where('settings' , array('type' => 'system_title'))->row()->description;
    $system_name        =   $this->db->get_where('settings' , array('type' => 'system_name'))->row()->description;
    $text_align         =   $this->db->get_where('settings' , array('type'=>'text_align'))->row()->description;
    $skin_colour        =   $this->db->get_where('settings' , array('type'=>'skin_colour'))->row()->description;
    $account_type       =   $this->session->userdata('login_type');
    $system_currency_id =   $this->db->get_where('settings' , array('type'=>'system_currency_id'))->row()->description;
    $currency_symbol    =   $this->db->get_where('currency' , array('currency_id'=>$system_currency_id))->row()->currency_symbol;
?>
<!DOCTYPE html>
<html lang="en" dir="">
    <head>

        <title><?php echo $page_title;?> - <?php echo $system_title;?></title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="Ekushey Project Manager CRM - Creativeitem" />
        <meta name="author" content="Creativeitem" />



        <?php include 'includes_top.php'; ?>

    </head>
    <body class="page-body <?php if ($skin_colour != '') echo 'skin-' . $skin_colour;?>" >
        <div class="page-container <?php if ($text_align == 'right-to-left') echo 'right-sidebar';?> ">

            <?php include $this->session->userdata('login_type') . '/navigation.php'; ?>  

            <div class="main-content">


                <?php include 'header.php'; ?>

                <h3 style="margin:20px 0px; color:#818da1; font-weight:200;">
                    <i class="entypo-right-circled"></i> 
                    <?php echo $page_title; ?>
                </h3>

                <?php include $this->session->userdata('login_type') . '/' . $page_name . '.php'; ?>

                <?php include 'footer.php'; ?>

            </div>
            <div id="chat_area">
                <?php include 'todo.php'; ?>
            </div>    	
        </div>
        <?php include 'modal.php'; ?>
        <?php include 'includes_bottom.php'; ?>

    </body>
</html>