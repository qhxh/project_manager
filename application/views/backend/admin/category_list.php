    <a href="<?php echo base_url(); ?>index.php?admin/cat_create" 
    class="btn btn-primary pull-right" style="margin-bottom: 10px">
        <i class="entypo-user-add"></i>
        <?php echo 'Thêm gói mới';?>
</a>
<table class="table table-bordered table-striped datatable" id="table_export">
    <thead>
        <tr>
            <th style="width:30px;">

            </th>
            <th><div><?php echo get_phrase('name'); ?></div></th>
            <th><div><?php echo get_phrase('budget'); ?></div></th>
            <th><div><?php echo get_phrase('time'); ?> (<?php echo get_phrase('days'); ?>)</div></th>
            <th><div><?php echo get_phrase('option'); ?> </div></th>
		</tr>
	</thead>

	<tbody>
		<?php 
			foreach ($all_categories as $cat) {
		?>
			<tr>
				<td> </td>
				<td> <?php echo $cat->name; ?> </td>
				<td> <?php echo money_format('%n', $cat->cat_ngansach); ?> </td>
				<td> <?php echo $cat->cat_time; ?> </td>
				<td>
				<div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle " data-toggle="dropdown">
                        Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                        <!-- EDITING LINK -->
                        <li>
                            <a href="<?php echo base_url(); ?>index.php?admin/cat_edit/<?php echo $cat->project_category_id; ?>" >
                                <i class="entypo-pencil"></i>
                                <?php echo get_phrase('edit'); ?>
                            </a>
                        </li>
                        <li class="divider"></li>

                        <!-- DELETION LINK -->
                        <li>
                            <a href="<?php echo base_url(); ?>index.php?admin/cat_delete/<?php echo $cat->project_category_id; ?>" >
                                <i class="entypo-trash"></i>
                                <?php echo get_phrase('delete'); ?>
                            </a>
                        </li>
                    </ul>
                </div>
             	</td>
			</tr>
		<?php	
			$num_cats--;
			}
		?>
	</tbody>     
</table>
<!-- calling ajax form submission plugin for specific form -->
<script src="assets/js/ajax-form-submission.js"></script>

<script src="assets/js/neon-custom-ajax.js"></script>  

