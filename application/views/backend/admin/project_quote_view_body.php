<?php
$quote_detail = $this->db->get_where('quote', array('quote_id' => $quote_id))->result_array();
foreach ($quote_detail as $row):
    ?>
    <!-- BREADCRUMB STARTS -->
    <ol class="breadcrumb bc-2">
        <li>
            <a href="<?php echo base_url(); ?>">
                <i class="entypo-folder"></i>
                <?php echo get_phrase('dashboard'); ?>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>index.php?admin/project_quote">
                <?php echo get_phrase('quote_list'); ?></a>
        </li>
        <li class="active"><?php echo $row['title']; ?></li>
    </ol>
    <!-- BREADCRUMB ENDS -->


    <div class="row">

        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4>
                            <i class="entypo-ticket"></i> <?php echo $row['title']; ?>

                        </h4>
                    </div>
                </div>

                <div class="panel-body" style="padding:0px;">

                    <!-- List of Ticket replies -->					
                    <div class="profile-env">
                        <section class="profile-feed" style="margin:0px;padding:0px;">
                            <!-- user profile -->
                            <div class="profile-stories">
                                <?php
                                $quote_messages = $this->db->get_where('quote_message', array('quote_id' => $quote_id))->result_array();
                                foreach ($quote_messages as $row2):
                                    ?>
                                    <article class="story" style="padding:0px 10px 0px 20px; margin:20px 0px;">
                                        <aside class="user-thumb">
                                            <a href="#">
                                                <img src="<?php
                                                echo $this->crud_model->get_image_url(
                                                        $row2['user_type'], $row2['user_id']);
                                                ?>" 
                                                     alt="" class="img-circle" style="height:44px;">
                                            </a>
                                        </aside>

                                        <div class="story-content">
                                            <!--  header -->
                                            <header>
                                                <div class="publisher">
                                                    <a href="#">
                                                        <?php echo $this->crud_model->get_type_name_by_id($row2['user_type'], $row2['user_id']); ?>
                                                    </a> 
                                                    <em><small>
                                                            <?php echo $row2['user_type']; ?> 
                                                            <i class="entypo-dot"></i> 
                                                            <?php echo $row2['timestamp']; ?> 
                                                        </small></em>
                                                </div>


                                            </header>

                                            <div class="story-main-content" style="text-align:justify;">
                                                <p><?php echo $row2['message']; ?></p>
                                            </div>

                                            <?php if ($row2['file'] != "") { ?>
                                                <i class="entypo-download"></i>
                                                <a href="<?php echo base_url() . 'uploads/quote_file/' . $row2['file']; ?>" class="">
                                                    <?php echo $row2['file']; ?>
                                                </a>
                                            <?php } ?>

                                        </div>
                                    </article>
                                    <!-- separator -->
                                    <hr style="margin:0px;">
                                <?php endforeach; ?>
                            </div>

                        </section>
                    </div>

                    <!-- reply option only for opened ticket-->
                   
                        <?php
                        echo form_open('admin/project_quote_post_reply/' . $row['quote_id'], array('class' => 'form-horizontal form-groups validate ticket-message-add',
                            'enctype' => 'multipart/form-data', 'style' => 'padding:20px;'));
                        ?>
                        <div class="form-group">
                            <label for="field-1" class="col-sm-2 control-label">
                                <i class="entypo-level-down"></i>
                                <?php echo get_phrase('reply'); ?>
                            </label>

                            <div class="col-sm-9">
                                <textarea class="form-control" rows="5" name="message" id="message"data-validate="required" 
                                          data-message-required="<?php echo get_phrase('value_required'); ?>" ></textarea>
                            </div>
                        </div>

                        <div class="form-group"><div class="col-sm-offset-2 col-sm-6">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <span class="btn btn-primary btn-file">
                                        <span class="fileinput-new"><?php echo get_phrase('select_file'); ?></span>
                                        <span class="fileinput-exists"><?php echo get_phrase('change'); ?></span>
                                        <input type="file" name="file" id="userfile">
                                    </span>
                                    <span class="fileinput-filename"></span>
                                    <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-8">
                                <button type="submit" class="btn btn-info" id="submit-button">
                                    <?php echo get_phrase('post_reply'); ?></button>
                                <span id="preloader-form"></span>
                            </div>
                        </div>
                        <?php form_close(); ?>
                   
                </div>

            </div>

        </div>

      

    </div>

<?php endforeach; ?>

<script>
    $(document).ready(function () {

        var options = {
            beforeSubmit: validate_ticket_message_add,
            success: show_response_ticket_message_add,
            resetForm: true
        };
        $('.ticket-message-add').submit(function () {
            $(this).ajaxSubmit(options);
            return false;
        });
    });
    function validate_ticket_message_add(formData, jqForm, options) {

        if (!jqForm[0].message.value)
        {
            return false;
        }
        $('#preloader-form').html('<img src="assets/images/preloader.gif" style="height:15px;margin-left:20px;" />');
        document.getElementById("submit-button").disabled = true;
    }

    function show_response_ticket_message_add(responseText, statusText, xhr, $form) {
        $('#preloader-form').html('');
        toastr.success("Quote reply submitted", "Success");
        document.getElementById("submit-button").disabled = false;
        reload_ticket_view_body();
    }


    function reload_ticket_view_body()
    {
        $.ajax({
            url: '<?php echo base_url(); ?>index.php?admin/reload_quote_message_view_body/<?php echo $row['quote_id']; ?>',
                        success: function (response)
                        {
                            jQuery('.main_data').html(response);
                        }
                    });
                }


</script>