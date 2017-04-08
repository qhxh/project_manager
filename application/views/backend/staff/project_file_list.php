<br />

<table class="table table-bordered datatable" id="table-1">
    <thead>
        <tr>
            <th><?php echo get_phrase('type'); ?></th>
            <th><?php echo get_phrase('name') ?></th>
            <th><?php echo get_phrase('uploaded_by'); ?></th>
            <th><?php echo get_phrase('action'); ?></th>

        </tr>
    </thead>
    <tbody>
        <?php
        $project_id = $this->db->get_where('project', array('project_code' => $project_code))->row()->project_id;

        $this->db->order_by('project_file_id', 'desc');
        $project_files = $this->db->get_where('project_file', array('project_id' => $project_id))->result_array();
        //print_r($project_files);
        foreach ($project_files as $row1):
            ?>
            <tr class="odd gradeX">
                <td>
                    <?php if ($row1['file_type'] == 'jpg' || $row1['file_type'] == 'jpeg' || $row1['file_type'] == 'png' || $row1['file_type'] == 'gif') { ?>
                        <img src="assets/images/image.png"  style="max-height:40px;"/>
                    <?php } ?>
                    <?php if ($row1['file_type'] == 'txt') { ?>
                        <img src="assets/images/text.png"  style="max-height:40px;"/>
                    <?php } ?>
                    <?php if ($row1['file_type'] == 'pdf') { ?>
                        <img src="assets/images/pdf.jpg"  style="max-height:40px;"/>
                    <?php } ?>
                    <?php if ($row1['file_type'] == 'docx') { ?>
                        <img src="assets/images/doc.jpg"  style="max-height:40px;"/>
                    <?php } ?>

                </td>
                <td><?php echo $row1['name']; ?></td>
                <td>
                    <?php
                    $type = $row1['uploader_type'];
                    $id = $row1['uploader_id'];
                    $name = $this->db->get_where($type, array($type . '_id' => $id))->row()->name;
                    echo $name . '<br>' . date('d M Y', $row1['timestamp_upload']);
                    ?>
                </td>
                <td>
                    <?php if ($row1['description'] != ''):?>
                                        <a class="tooltip-default" style="color:#aaa;" data-toggle="tooltip" 
                                           data-placement="top" data-original-title="<?php echo $row1['description'];?>"
                                           href="#">
                                            <i class="entypo-info"></i>
                                        </a>
                                    <?php endif;?>
                                    <a class="tooltip-default" style="color:#aaa;" data-toggle="tooltip" 
                                       data-placement="top" data-original-title="<?php echo get_phrase('download'); ?>"
                                       href="<?php echo base_url(); ?>index.php?staff/project_file/download/<?php echo $row1['project_file_id']; ?>">
                                        <i class="entypo-download"></i>
                                    </a>
                                    
                                    <a class="tooltip-default" style="color:#aaa;cursor:pointer;" data-toggle="tooltip" 
                                       data-placement="top" data-original-title="<?php echo get_phrase('save_to_dropbox'); ?>"
                                       onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/project_file_addto_dropbox/<?php echo $row1['project_file_id']; ?>')">
                                       
                                        <i class="entypo-dropbox"></i>
                                    </a>
                                    <!-- DROPBOX SAVER BUTTON -->
                                    <!--<div id="container_saver_<?php echo $row1['project_file_id'];?>"></div>-->

                                    <a class="tooltip-default" style="color:#aaa;cursor:pointer;" data-toggle="tooltip"
                                       data-placement="top" data-original-title="<?php echo get_phrase('delete'); ?>"
                                       onclick="confirm_modal('<?php echo base_url(); ?>index.php?staff/project_file/delete/<?php echo $row1['project_file_id']; ?>', '<?php echo base_url(); ?>index.php?staff/reload_projectroom_file_list/<?php echo $project_code; ?>');">
                                        <i class="entypo-trash"></i>
                                    </a>

                                    <!--DROPBOX SAVER DYNAMIC SCRIPT -->
                                    <script type="text/javascript">
    
                                        var options_saver_<?php echo $row1['project_file_id'];?> = {
                                            files: [
                                                {'url': 'https://dl.dropboxusercontent.com/s/deroi5nwm6u7gdf/advice.png', 'filename': 'koala.png'}
                                            ],
                                            success: function () {
                                                toastr.success("Files saved to your Dropbox.", "Success");
                                            },
                                            progress: function (progress) {},
                                            cancel: function () {},
                                            error: function (errorMessage) {}
                                        };
                                        
                                        //var button_saver_<?php echo $row1['project_file_id'];?> = Dropbox.createSaveButton(options_saver_<?php echo $row1['project_file_id'];?>);
                                        //document.getElementById("container_saver_<?php echo $row1['project_file_id'];?>").appendChild(button_saver_<?php echo $row1['project_file_id'];?>);

                                    </script>

                </td>

            </tr>
<?php endforeach; ?>
    </tbody>

</table>

<script type="text/javascript">
    var responsiveHelper;
    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };
    var tableContainer;

    jQuery(document).ready(function ($)
    {
        tableContainer = $("#table-1");

        tableContainer.dataTable({
            "sPaginationType": "bootstrap",
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "bStateSave": true,
            // Responsive Settings
            bAutoWidth: false,
            fnPreDrawCallback: function () {
                // Initialize the responsive datatables helper once.
                if (!responsiveHelper) {
                    responsiveHelper = new ResponsiveDatatablesHelper(tableContainer, breakpointDefinition);
                }
            },
            fnRowCallback: function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                responsiveHelper.createExpandIcon(nRow);
            },
            fnDrawCallback: function (oSettings) {
                responsiveHelper.respond();
            }
        });

        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });
    });
</script>

<br />