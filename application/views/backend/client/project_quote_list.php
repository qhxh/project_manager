<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th></th>
            <th><?php echo get_phrase('title');?></th>
            <th><?php echo get_phrase('description');?></th>
            <th><?php echo get_phrase('client');?></th>
            <th><?php echo get_phrase('date');?></th>
            <th><?php echo get_phrase('amount');?></th>
            <th><?php echo get_phrase('options');?></th>
        </tr>
    </thead>

    <tbody>
        <?php 
        $count      = 1;
        $client_id  = $this->session->userdata('login_user_id');
        $this->db->order_by('quote_id', 'desc');
        $quotes     = $this->db->get_where('quote', array('user_id' => $client_id))->result_array();
        foreach ($quotes as $row) { ?>   
            <tr>
                <td><?php echo $count++; ?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td>
                    <?php $name = $this->db->get_where('client' , array('client_id' => $client_id ))->row()->name;
                        echo $name;?>
                </td>
                <td><?php echo date("d M, Y", $row['timestamp']); ?></td>
                <td><?php echo $row['amount']; ?></td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-sm dropdown-toggle " data-toggle="dropdown">
                            Action <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                            <!-- EDITING LINK -->
                            <li>
                                <a href="<?php echo base_url(); ?>index.php?client/project_quote_view/<?php echo $row['quote_id']; ?>" >
                                    <i class="entypo-eye"></i>
                                    <?php echo get_phrase('view_quote'); ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<script type="text/javascript">

    jQuery(document).ready(function ($)
    {
        var datatable = $("#table-2").dataTable({
            "sPaginationType": "bootstrap",
            "aoColumns": [
                {"bSortable": false},
                null,
                null,
                null,
                null,
                null,
                null
            ],
            aLengthMenu: [
            [-1 , 25 , 50 , 100 , 200],
            ["All" , 25 , 50 , 100 , 200]
            ],
        });

        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });

    });
        
</script>

<script src="assets/js/neon-custom-ajax.js"></script>