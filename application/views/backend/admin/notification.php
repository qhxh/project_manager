<form method="POST" action="<?php echo base_url(); ?>/index.php?admin/delete_notify">
<table class="table table-bordered table-striped datatable" id="table_export">
    <thead>
        <tr>
            <th style="width:30px;">

            </th>
            <th><div><?php echo get_phrase('title'); ?></div></th>
            <th><div><?php echo get_phrase('content'); ?></div></th>
            <th><div><?php echo get_phrase('time'); ?></div></th>
           
        </tr>
</thead>

<tbody>
    <?php
    if ( ! empty( $all_notify ) ):
    foreach ($all_notify as $notify):
        ?>
        <tr>
            <td>
                <input type="checkbox" name="notify_check[]" value="<?php echo $notify['notify_id']; ?>" />
            </td>
            <td><?php echo $notify['notify_title']; ?></td>
            <td><?php echo $notify['notify_content']; ?></td>
            <td><?php echo $notify['notify_time']; ?></td>
        </tr>
    <?php endforeach; ?>
    <?php endif; ?>
</tbody>
</table>
<input type="submit" name="notify_delete_submit" value="xóa" class="btn btn-danger" />
</form>

