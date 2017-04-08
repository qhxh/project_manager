<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th></th>
            <th><?php echo get_phrase('name');?></th>
            <th><?php echo get_phrase('email');?></th>
            <th><?php echo get_phrase('options');?></th>
        </tr>
    </thead>

    <tbody>
        <?php 
        $count = 1;
        $this->db->order_by('client_pending_id', 'desc');
        $pending_clients = $this->db->get('client_pending')->result_array();
        foreach ($pending_clients as $row) { ?>   
            <tr>
                <td><?php echo $count++; ?></td>
                <td><?php echo $row['name']?></td>
                <td><?php echo $row['email']?></td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-sm dropdown-toggle " data-toggle="dropdown">
                            Action <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                            <!-- APPROVAL LINK -->
                            <li>
                                <a href="<?php echo base_url();?>index.php?staff/pending_client/approve/<?php echo $row['client_pending_id']?>"
                                    onClick="return confirm('Confirm this client account creation? A notification mail will be sent')">
                                    <i class="entypo-pencil"></i>
                                    <?php echo get_phrase('approve'); ?>
                                </a>
                            </li>
                            <li class="divider"></li>

                            <!-- DELETION LINK -->
                            <li>
                                <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?staff/pending_client/delete/<?php echo $row['client_pending_id']; ?>', '<?php echo base_url(); ?>index.php?staff/reload_pending_client_list');" >
                                    <i class="entypo-trash"></i>
                                    <?php echo get_phrase('delete'); ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<!-- calling ajax form submission plugin for specific form -->
<script src="assets/js/ajax-form-submission.js"></script>

<script src="<?php echo base_url(); ?>assets/js/neon-custom-ajax.js"></script>
<script type="text/javascript">
    jQuery(window).load(function ()
    {
        var $ = jQuery;

        $("#table-2").dataTable({
            "sPaginationType": "bootstrap",
            "sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>"      
        });

        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });

        // Highlighted rows
        $("#table-2 tbody input[type=checkbox]").each(function (i, el)
        {
            var $this = $(el),
                    $p = $this.closest('tr');

            $(el).on('change', function ()
            {
                var is_checked = $this.is(':checked');

                $p[is_checked ? 'addClass' : 'removeClass']('highlight');
            });
        });

        // Replace Checboxes
        $(".pagination a").click(function (ev)
        {
            replaceCheckboxes();
        });
    });
</script>