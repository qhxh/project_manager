<table class="table table-bordered table-striped datatable" id="table_export">
    <thead>
        <tr>
            <th style="width:30px;">

            </th>
            <th><div><?php echo get_phrase('name'); ?></div></th>
            <th><div><?php echo get_phrase('address'); ?></div></th>
            <th><div><?php echo get_phrase('project'); ?></div></th>
            <th><div><?php echo get_phrase('email'); ?></div></th>
            <th><div><?php echo get_phrase('skype'); ?></div></th>
            <th><div><?php echo get_phrase('phone'); ?></div></th>
            <th><div><?php echo get_phrase('company'); ?></div></th>
            <th><div><?php echo get_phrase('website'); ?></div></th>
            <th><div><?php echo get_phrase('contact'); ?></div></th>
            <th><div><?php echo get_phrase('options'); ?></div></th>
</tr>
</thead>
<tbody>
    <?php
    $counter = 1;
    $this->db->order_by('client_id', 'desc');
    $clients = $this->db->get('client')->result_array();
    foreach ($clients as $row):
        ?>
        <tr>
            <td style="width:30px;">
                <?php echo $counter++; ?>
            </td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['address']; ?></td>
            <td><?php echo $this->db->get_where('project', array('client_id' => $row['client_id']))->num_rows(); ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['skype_id']; ?></td>
            <td><?php echo $row['phone']; ?></td>
            <td>
                <?php 
                    $query =  $this->db->get_where('company' , array('client_id' => $row['client_id']));
                    if ($query->num_rows() > 0)
                        echo $query->row()->name;
                ?>
            </td>
            <td><?php echo $row['website']; ?></td>
            <td>
                <?php if ($row['skype_id'] != ''): ?>
                    <a class="tooltip-primary" data-toggle="tooltip" data-placement="top" 
                       data-original-title="<?php echo get_phrase('call_skype'); ?>"	
                       href="skype:<?php echo $row['skype_id']; ?>?chat" style="color:#bbb;">
                        <i class="entypo-skype"></i>
                    </a>
                <?php endif; ?>
                <?php if ($row['email'] != ''): ?>
                    <a class="tooltip-primary" data-toggle="tooltip" data-placement="top" 
                       data-original-title="<?php echo get_phrase('send_email'); ?>"	
                       href="mailto:<?php echo $row['email']; ?>" style="color:#bbb;">
                        <i class="entypo-mail"></i>
                    </a>
                <?php endif; ?>
                <?php if ($row['phone'] != ''): ?>
                    <a class="tooltip-primary" data-toggle="tooltip" data-placement="top" 
                       data-original-title="<?php echo get_phrase('call_phone'); ?>"	
                       href="tel:<?php echo $row['phone']; ?>" style="color:#bbb;">
                        <i class="entypo-phone"></i>
                    </a>
                <?php endif; ?>
                <?php if ($row['facebook_profile_link'] != ''): ?>
                    <a class="tooltip-primary" data-toggle="tooltip" data-placement="top" 
                       data-original-title="<?php echo get_phrase('facebook_profile'); ?>"	
                       href="<?php echo $row['facebook_profile_link']; ?>" style="color:#bbb;" target="_blank">
                        <i class="entypo-facebook"></i>
                    </a>
                <?php endif; ?>
                <?php if ($row['twitter_profile_link'] != ''): ?>
                    <a class="tooltip-primary" data-toggle="tooltip" data-placement="top" 
                       data-original-title="<?php echo get_phrase('twitter_profile'); ?>"	
                       href="<?php echo $row['twitter_profile_link']; ?>" style="color:#bbb;" target="_blank">
                        <i class="entypo-twitter"></i>
                    </a>
                <?php endif; ?>
                <?php if ($row['linkedin_profile_link'] != ''): ?>
                    <a class="tooltip-primary" data-toggle="tooltip" data-placement="top" 
                       data-original-title="<?php echo get_phrase('linkedin_profile'); ?>"	
                       href="<?php echo $row['linkedin_profile_link']; ?>" style="color:#bbb;" target="_blank">
                        <i class="entypo-linkedin"></i>
                    </a>
                <?php endif; ?>
                <?php if ($row['website'] != ''): ?>
                    <a class="tooltip-primary" data-toggle="tooltip" data-placement="top" 
                       data-original-title="<?php echo get_phrase('website'); ?>"	
                       href="<?php echo $row['website']; ?>" style="color:#bbb;" target="_blank">
                        <i class="entypo-network"></i>
                    </a>
                <?php endif; ?>
            </td>
            <td>


                <!--<a class="btn btn-primary btn-xs tooltip-primary" data-toggle="tooltip" data-placement="top" 
                          title="" data-original-title="<?php echo get_phrase('view_profile'); ?>" 
                          onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/client_profile/<?php echo $row['client_id']; ?>');">
                                  <i class="entypo-user"></i>
                    </a>
                 
                <a class="btn btn-info btn-xs tooltip-primary" data-toggle="tooltip" data-placement="top" 
                          title="" data-original-title="<?php echo get_phrase('edit_client'); ?>" 
                          onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/client_edit/<?php echo $row['client_id']; ?>');">
                                  <i class="entypo-pencil"></i>
                    </a>
                 
                <a class="btn btn-danger btn-xs tooltip-primary" data-toggle="tooltip" data-placement="top" 
                          title="" data-original-title="<?php echo get_phrase('delete_client'); ?>" 
                          onclick="confirm_modal('<?php echo base_url(); ?>index.php?staff/client/delete/<?php echo $row['client_id']; ?>' , '<?php echo base_url(); ?>index.php?staff/reload_client_list');" >
                                  <i class="entypo-trash"></i>
                    </a>-->
                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle " data-toggle="dropdown">
                        Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                        <!-- PROFILE LINK -->
                        <li>
                            <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/client_profile/<?php echo $row['client_id']; ?>');">
                                <i class="entypo-user"></i>
                                <?php echo get_phrase('profile'); ?>
                            </a>
                        </li>

                        <!-- EDITING LINK -->
                        <li>
                            <a onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/client_edit/<?php echo $row['client_id']; ?>');">
                                <i class="entypo-pencil"></i>
                                <?php echo get_phrase('edit'); ?>
                            </a>
                        </li>
                        <li class="divider"></li>

                        <!-- DELETION LINK -->
                        <li>
                            <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?staff/client/delete/<?php echo $row['client_id']; ?>', '<?php echo base_url(); ?>index.php?staff/reload_client_list');" >
                                <i class="entypo-trash"></i>
                                <?php echo get_phrase('delete'); ?>
                            </a>
                        </li>
                    </ul>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>
</table>


<!-- calling ajax form submission plugin for specific form -->
<script src="assets/js/ajax-form-submission.js"></script>

<script src="assets/js/neon-custom-ajax.js"></script>
<script type="text/javascript">



    jQuery(document).ready(function ($)
    {
        //convert all checkboxes before converting datatable
        replaceCheckboxes();
        var datatable = $("#table_export").dataTable({
            "sPaginationType": "bootstrap",
            "sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>",
            "aoColumns": [
                {"bSortable": false}, //0,checkbox
                {"bVisible": true}, //1,name
                {"bVisible": false}, //2,address
                {"bVisible": true}, //3,total project
                {"bVisible": false}, //4,email
                {"bVisible": false}, //5,skype
                {"bVisible": false}, //6,phone
                {"bVisible": true}, //7,company
                {"bVisible": false}, //8,website
                {"bVisible": true}, //9,contact
                {"bVisible": true}		//10,option
            ],
            "oTableTools": {
                "aButtons": [
                    {
                        "sExtends": "xls",
                        "mColumns": [1, 2, 3, 4, 5, 6, 7, 8]
                    },
                    {
                        "sExtends": "pdf",
                        "mColumns": [1, 2, 3, 4, 5, 6, 7, 8]
                    },
                    {
                        "sExtends": "print",
                        "fnSetText": "Press 'esc' to return",
                        "fnClick": function (nButton, oConfig) {
                            datatable.fnSetColumnVis(0, false);
                            datatable.fnSetColumnVis(1, true);
                            datatable.fnSetColumnVis(2, true);
                            datatable.fnSetColumnVis(3, true);
                            datatable.fnSetColumnVis(4, true);
                            datatable.fnSetColumnVis(5, true);
                            datatable.fnSetColumnVis(6, true);
                            datatable.fnSetColumnVis(7, true);
                            datatable.fnSetColumnVis(8, true);
                            datatable.fnSetColumnVis(9, false);
                            datatable.fnSetColumnVis(10, false);

                            this.fnPrint(true, oConfig);

                            window.print();

                            $(window).keyup(function (e) {
                                if (e.which == 27) {
                                    datatable.fnSetColumnVis(0, true);
                                    datatable.fnSetColumnVis(1, true);
                                    datatable.fnSetColumnVis(2, true);
                                    datatable.fnSetColumnVis(3, true);
                                    datatable.fnSetColumnVis(4, false);
                                    datatable.fnSetColumnVis(5, false);
                                    datatable.fnSetColumnVis(6, false);
                                    datatable.fnSetColumnVis(7, false);
                                    datatable.fnSetColumnVis(8, false);
                                    datatable.fnSetColumnVis(9, true);
                                    datatable.fnSetColumnVis(10, true);
                                }
                            });
                        },
                    },
                ]
            },
        });
        // Highlighted rows
        $("#table_export tbody input[type=checkbox]").each(function (i, el)
        {
            var $this = $(el),
                    $p = $this.closest('tr');

            $(el).on('change', function ()
            {
                var is_checked = $this.is(':checked');

                $p[is_checked ? 'addClass' : 'removeClass']('highlight');
            });
        });

        //customize the select menu 
        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });

    });




</script>