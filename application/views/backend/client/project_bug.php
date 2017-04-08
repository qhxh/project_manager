<?php 
       
	$current_project = $this->db->get_where('project' , array(
		'project_code' => $project_code
	))->result_array();
	foreach ($current_project as $row):
?>
 <div class="col-md-9">

        <a href="#" class="btn btn-info pull-right tooltip-primary"
           onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/project_bug_add/<?php echo $project_code; ?>');">
            <i class="entypo-plus"></i> <?php echo get_phrase('add_new_bug'); ?>
        </a>
        <br><br><br>

        <!-- task accordion -->


        <div class="panel panel-primary main_data">
            <div class="panel-heading">
                <div class="panel-title"><?php echo get_phrase('bugs/Issues'); ?></div>

            </div>

            <table class="table table-bordered table-responsive">
                <thead>
                    <tr>
                        <th><?php echo get_phrase('title'); ?></th>
                        <th><?php echo get_phrase('posted_by'); ?></th>
                        <th><?php echo get_phrase('date_posted'); ?></th>
                        <th><?php echo get_phrase('status'); ?></th>
                        <th><?php echo get_phrase('actions') ?></th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $this->db->order_by('project_bug_id', 'desc');
                    $bug = $this->db->get_where('project_bug', array('project_code' => $project_code))->result_array();
                    foreach ($bug as $row1):
                        ?>
                        <tr>
                            <td><?php echo $row1['title']; ?></td>
                            <td style="width: 20%">
                                <?php
                                $type = $row1['user_type'];
                                $id = $row1['user_id'];
                                $name = $this->db->get_where($type, array($type . '_id' => $id))->row()->name;
                                echo $name;
                                ?>
                            </td>
                            <td style="width: 20%"><?php echo date('d M Y', $row1['timestamp']); ?></td>
                            <td>
                                <?php if ($row1['status'] == 0):?>
                                    <div class="label label-danger">
                                        <?php echo get_phrase('pending');?>
                                    </div>
                                <?php endif;?>
                                <?php if ($row1['status'] == 1):?>
                                    <div class="label label-success">
                                        <?php echo get_phrase('solved');?>
                                    </div>
                                <?php endif;?>
                            </td>
                            <td style="width: 20%">
                                <a class="tooltip-default" style="color:#aaa;" data-toggle="tooltip" 
                                   data-placement="top" data-original-title="<?php echo get_phrase('view');?>"
                                   href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/project_bug_view/<?php echo $row1['project_bug_id']; ?>')">
                                            <i class="entypo-info"></i>
                                </a>
                                <a class="tooltip-default" style="color:#aaa;cursor:pointer;" data-toggle="tooltip"
                                       data-placement="top" data-original-title="<?php echo get_phrase('edit'); ?>"
                                       onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/project_bug_edit/<?php echo $row1['project_bug_id']; ?>');">
                                        <i class="entypo-pencil"></i>
                                </a>
                                <a class="tooltip-default" style="color:#aaa;cursor:pointer;" data-toggle="tooltip"
                                       data-placement="top" data-original-title="<?php echo get_phrase('delete'); ?>"
                                       onclick="confirm_modal('<?php echo base_url(); ?>index.php?client/project_bug/delete/<?php echo $row1['project_bug_id']; ?>', '<?php echo base_url(); ?>index.php?client/reload_projectroom_bug/<?php echo $project_code; ?>');">
                                        <i class="entypo-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>

    </div>




<!-- custom styling for project calendar -->
<style>
    /*h2{font-weight: 200; font-size: 16px;}*/
    .fc-header-left{padding:4px !important;}
    .fc-header-right{padding:4px !important;}
</style>


<!-- calling ajax form submission plugin for specific form -->
<script src="assets/js/jquery.form.js"></script>

<script type="text/javascript">
    // ajax form plugin calls at each modal loading,


// custom function for data deletion by ajax and post refreshing call
function delete_data(delete_url , post_refresh_url)
{
    // showing user-friendly pre-loader image
    $('#preloader-delete').html('<img src="assets/images/preloader.gif" style="height:15px;margin-top:-10px;" />');
    
    // disables the delete and cancel button during deletion ajax request
    document.getElementById("delete_link").disabled=true;
    document.getElementById("delete_cancel_link").disabled=true;
    
    $.ajax({
        url: delete_url,
        success: function(response)
        {
            // remove the preloader 
            $('#preloader-delete').html('');
            
            // show deletion success msg.
            toastr.info("Data deleted successfully.", "Success");
            
            // hide the delete dialog box
            $('#modal_delete').modal('hide');
            
            // enables the delete and cancel button after deletion ajax request success
            document.getElementById("delete_link").disabled=false;
            document.getElementById("delete_cancel_link").disabled=false;
    
            // reload the table
            reload_data(post_refresh_url);
        }
    });
}

// custom function for reloading table data
function reload_data(url)
{
    $.ajax({
        url: url,
        success: function(response)
        {
            // Replace new page data
            jQuery('.main_data').html(response);

            

            // calls the tooltip again on ajax success
            $('[data-toggle="tooltip"]').each(function(i, el)
            {
                var $this = $(el),
                    placement = attrDefault($this, 'placement', 'top'),
                    trigger = attrDefault($this, 'trigger', 'hover'),
                    popover_class = $this.hasClass('tooltip-secondary') ? 'tooltip-secondary' : ($this.hasClass('tooltip-primary') ? 'tooltip-primary' : ($this.hasClass('tooltip-default') ? 'tooltip-default' : ''));
                
                $this.tooltip({
                    placement: placement,
                    trigger: trigger
                });

                $this.on('shown.bs.tooltip', function(ev)
                {
                    var $tooltip = $this.next();
                    
                    $tooltip.addClass(popover_class);
                });
            });


               
        }
    });
}

</script>
<script src="assets/js/neon-custom-ajax.js"></script>
<?php endforeach;?>