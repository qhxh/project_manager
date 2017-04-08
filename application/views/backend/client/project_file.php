
<?php 
    $dropbox_data_app_key = $this->db->get_where('settings' , array(
        'type' => 'dropbox_data_app_key'))->row()->description;
?>


<script type="text/javascript" src="https://www.dropbox.com/static/api/2/dropins.js" id="dropboxjs"data-app-key="<?php echo $dropbox_data_app_key;?>"></script>

<?php 
	$current_project = $this->db->get_where('project' , array(
		'project_code' => $project_code
	))->result_array();
	foreach ($current_project as $row):
?>
<div class="col-md-9">
	
	<div class="panel panel-primary" data-collapsed="0">

			<div class="panel-heading">
				<div class="panel-title">
					<?php echo get_phrase('upload_files');?>
				</div>
				
			</div>
			
			<div class="panel-body">
				
                <!-- UPLOADERS -->

                <ul class="nav nav-tabs bordered"><!-- available classes "bordered", "right-aligned" -->
                    <li class="active">
                        <a href="#home" data-toggle="tab">
                            <span><?php echo get_phrase('regular_upload');?></span>
                        </a>
                    </li>
                    <li class="">
                        <a href="#profile" data-toggle="tab">
                            <span><?php echo get_phrase('multiple_file_upload');?></span>
                        </a>
                    </li>
                    <li class="">
                        <a href="#messages" data-toggle="tab">
                            <span><?php echo get_phrase('dropbox_upload');?></span>
                        </a>
                    </li>
                </ul>
                
                <div class="tab-content">
                <br>

                    <!-- NORMAL UPLOADER -->
                    <div class="tab-pane active" id="home">

                    <?php echo form_open(base_url() . 'index.php?client/project_file/upload/' . $row['project_code'] , array(
                        'class' => 'form-horizontal form-groups-bordered validate validate project-file-add' ,
                            'enctype' => 'mutipart/form-data'));?>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-4 control-label"><?php echo get_phrase('short_note'); ?></label>

                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="description" id="title" value="" autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-4 control-label"><?php echo get_phrase('select_file'); ?></label>

                            <div class="col-sm-6">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <span class="btn btn-primary btn-file">
                                        <span class="fileinput-new"><?php echo get_phrase('choose'); ?></span>
                                        <span class="fileinput-exists"><?php echo get_phrase('change'); ?></span>
                                        <input type="file" name="userfile" id="userfile">
                                    </span>
                                    <span class="fileinput-filename"></span>
                                    <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-6">
                                <button type="submit" class="btn btn-info" id="submit-button">
                                    <?php echo get_phrase('upload_file'); ?></button>
                                <span id="preloader-form"></span>
                            </div>
                        </div>

                    <?php echo form_close();?>
                        
                    </div>

                    <!-- DROPZONE UPLOADER -->
                    <div class="tab-pane" id="profile">

                        <?php
                        echo form_open(base_url() . 'index.php?client/project_file/dropzone_upload/' . $row['project_code'], array('class' => 'form-horizontal form-groups-bordered validate validate project-file-multiple-add',
                            'enctype' => 'mutipart/form-data'));
                        ?>
                        <div class="form-group">
                            <label for="field-1" class="col-sm-4 control-label">Select File</label>
                            <div class="col-sm-6">
                                <input type="file" 
                                       class=" file2  btn btn-primary"
                                       multiple="multiple" data-label="<i class='glyphicon glyphicon-circle-arrow-up'></i> &nbsp;Browse Files" 
                                       style="left: 21.25px; top: 3.5px;" name="userfile[]">

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-6">
                                <button type="submit" class="btn btn-info"  id="submit-button">
                                    Upload File</button>
                                <span id="preloader-form"></span>
                            </div>
                        </div>
    <?php echo form_close(); ?> 

                    </div>

                    <!-- DROPBOX UPLAODER -->
                    <div class="tab-pane" id="messages">
                        <?php echo form_open(base_url() . 'index.php?client/project_file/dropbox_upload/' . $row['project_code'] , array(
                        'class' => 'form-horizontal form-groups-bordered validate validate project-file-dropbox' ,
                            'enctype' => 'mutipart/form-data'));?>

                            <div class="form-group">
                                <label for="field-1" class="col-sm-4 control-label"><?php echo get_phrase('file_chooser'); ?></label>

                                <div class="col-sm-6">
                                    <!-- dropbox -->
                                    <div id="container_chooser"></div>
                                    <img src="" id="dropbox_thumb" style="height:30px;" />
                                    <input type="hidden" name="dropbox_file_link" value="" id="dropbox_file_link" />
                                    <input type="hidden" name="dropbox_file_name" value="" id="dropbox_file_name" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="field-1" class="col-sm-4 control-label"><?php echo get_phrase('short_note'); ?></label>

                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="description" id="title" value="" >
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-6">
                                    <button type="submit" class="btn btn-info" id="submit-button">
                                        <?php echo get_phrase('upload_file'); ?></button>
                                    <span id="dropbox-preloader-form"></span>
                                </div>
                            </div>
                        <?php echo form_close();?> 
                        <!--<div id="container_saver"></div>
                         dropbox -->

                    </div>

                </div>
			</div>
		</div>


    <div class="project_files_container">
        
        <?php include 'project_file_list.php';?>

    </div>

</div>




    <script type="text/javascript">

        options_chooser = {
            // Required. Called when a user selects an item in the Chooser.
            success: function (files) {
                //alert("Here's the file link: " + files[0].link);
                console.log(files);
                $("#dropbox_thumb").attr("src", files[0].thumbnailLink);
                $("#dropbox_file_name").attr("value", files[0].name);
                $("#dropbox_file_link").attr("value", files[0].link);
            },
            // Optional. Called when the user closes the dialog without selecting a file
            // and does not include any parameters.
            cancel: function () {

            },
            // Optional. "preview" (default) is a preview link to the document for sharing,
            // "direct" is an expiring link to download the contents of the file. For more
            // information about link types, see Link types below.
            linkType: "preview", // or "direct"

            // Optional. A value of false (default) limits selection to a single file, while
            // true enables multiple file selection.
            multiselect: false // or true

                    // Optional. This is a list of file extensions. If specified, the user will
                    // only be able to select files with these extensions. You may also specify
                    // file types, such as "video" or "images" in the list. For more information,
                    // see File types below. By default, all extensions are allowed.
                    //extensions: ['.pdf', '.doc', '.docx']
        };

        var options_saver = {
            files: [
                {'url': 'https://dl.dropboxusercontent.com/s/deroi5nwm6u7gdf/advice.png', 'filename': 'koala.png'}
            ],
            success: function () {
                alert("Success! Files saved to your Dropbox.");
            },
            progress: function (progress) {
            },
            cancel: function () {
            },
            error: function (errorMessage) {
            }
        };




        var button_chooser = Dropbox.createChooseButton(options_chooser);
        document.getElementById("container_chooser").appendChild(button_chooser);

        var button_saver = Dropbox.createSaveButton(options_saver);
        document.getElementById("container_saver").appendChild(button_saver);

    </script>

<?php endforeach; ?>



<script>
    // url for refresh data after ajax form submission
    var post_refresh_url = '<?php echo base_url(); ?>index.php?client/reload_projectroom_file_list/<?php echo $project_code; ?>';
</script>

<!-- calling ajax form submission plugin for specific form -->
<script src="assets/js/jquery.form.js"></script>

<script type="text/javascript">
        // ajax form plugin calls at each modal loading,
        $(document).ready(function () {

            // normal file uploader
            var options = {
                success: showResponse,
                resetForm: true
            };

            $('.project-file-add').submit(function () {
                $(this).ajaxSubmit(options);


                return false;
            });
            $('.project-file-multiple-add').submit(function () {
                $(this).ajaxSubmit(options);


                return false;
            });

            options_dropbox
            // dropbox file uploader
            var options_dropbox = {
                success: showResponse,
                resetForm: true
            };

            $('.project-file-dropbox').submit(function () {
                $(this).ajaxSubmit(options_dropbox);

                //$('#dropbox-preloader-form').html('<img src="assets/images/preloader.gif" style="height:15px;margin-left:20px;" />');
                return false;
            });
        });

// ajax success response after form submission, post_refresh_url is sent from modal body
        function showResponse(responseText, statusText, xhr, $form) {

            toastr.success("File uploaded successfully", "Success");
            reload_data(post_refresh_url);
        }



        /*-----------------custom functions for ajax post data handling--------------------*/



// custom function for reloading table data
        function reload_data(url)
        {
            var tableContainer;
            $.ajax({
                url: url,
                success: function (response)
                {
                    // Replace new page data
                    jQuery('.project_files_container').html(response);

                    // Replaced File Input
                    // $("input.file2[type=file]").each(function (i, el)
                    // {
                    //     var $this = $(el),
                    //             label = attrDefault($this, 'label', 'Browse');

                    //     $this.bootstrapFileInput(label);
                    // });

                    // Auto Size for Textarea
                    $("textarea.autogrow, textarea.autosize").autosize();

                    // calls the tooltip again on ajax success
                    $('[data-toggle="tooltip"]').each(function (i, el)
                    {
                        var $this = $(el),
                                placement = attrDefault($this, 'placement', 'top'),
                                trigger = attrDefault($this, 'trigger', 'hover'),
                                popover_class = $this.hasClass('tooltip-secondary') ? 'tooltip-secondary' : ($this.hasClass('tooltip-primary') ? 'tooltip-primary' : ($this.hasClass('tooltip-default') ? 'tooltip-default' : ''));

                        $this.tooltip({
                            placement: placement,
                            trigger: trigger
                        });

                        $this.on('shown.bs.tooltip', function (ev)
                        {
                            var $tooltip = $this.next();

                            $tooltip.addClass(popover_class);
                        });
                    });
                    
                         $("#table-1").dataTable();

       

        
                }
            });
        }

// custom function for data deletion by ajax and post refreshing call
        function delete_data(delete_url, post_refresh_url)
        {
            // showing user-friendly pre-loader image
            $('#preloader-delete').html('<img src="assets/images/preloader.gif" style="height:15px;margin-top:-10px;" />');

            // disables the delete and cancel button during deletion ajax request
            document.getElementById("delete_link").disabled = true;
            document.getElementById("delete_cancel_link").disabled = true;

            $.ajax({
                url: delete_url,
                success: function (response)
                {
                    // remove the preloader 
                    $('#preloader-delete').html('');

                    // show deletion success msg.
                    toastr.info("Data deleted successfully.", "Success");

                    // hide the delete dialog box
                    $('#modal_delete').modal('hide');

                    // enables the delete and cancel button after deletion ajax request success
                    document.getElementById("delete_link").disabled = false;
                    document.getElementById("delete_cancel_link").disabled = false;

                    // reload the table
                    reload_data(post_refresh_url);
                }
            });
        }

</script>
