<?php 
    $edit_data = $this->db->get_where('expense_category' , array('expense_category_id' => $param2))->result_array();
    foreach ($edit_data as $row):
?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title" >
                    <i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('add_expense_category'); ?>
                </div>
            </div>
            <div class="panel-body">

                <?php echo form_open(base_url() . 'index.php?staff/accounting_expense_category/edit/' . $param2 , array(
                    'class' => 'form-horizontal form-groups-bordered validate expense-category-edit', 'enctype' => 'multipart/form-data')); ?>

                <div class="form-group">
                    <label for="field-1" class="col-sm-4 control-label"><?php echo get_phrase('title'); ?></label>

                    <div class="col-sm-7">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="entypo-star"></i></span>
                            <input type="text" class="form-control" name="title" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" 
                                value="<?php echo $row['title'];?>">
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label for="field-2" class="col-sm-4 control-label"><?php echo get_phrase('description'); ?></label>

                    <div class="col-sm-7">
                        <div class="input-group ">
                            <span class="input-group-addon"><i class="entypo-pencil"></i></span>
                            <textarea class="form-control autogrow" name="description" style="height:48px;"><?php echo $row['description'];?></textarea>
                        </div>
                    </div> 
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-7">
                        <button type="submit" class="btn btn-info" id="submit-button"><?php echo get_phrase('update'); ?></button>
                        <span id="preloader-form"></span>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<?php endforeach;?>


<script>
    // url for refresh data after ajax form submission
    var post_refresh_url = '<?php echo base_url(); ?>index.php?staff/reload_expense_category_list';
</script>

<script type="text/javascript">
    // ajax form plugin calls at each modal loading,
$(document).ready(function() {

   //config for project milestone adding
    var options = {
        beforeSubmit: validate_expense_category_edit,
        success: show_response_expense_category_edit,
        resetForm: true
    };
    $('.expense-category-edit').submit(function () {
        $(this).ajaxSubmit(options);
        return false;
    });
    
    
});

function validate_expense_category_edit(formData, jqForm, options) {

    if (!jqForm[0].title.value)
    {
        toastr.error("Please enter a title", "Error");
        return false;
    }
}

// ajax success response after form submission
function show_response_expense_category_edit(responseText, statusText, xhr, $form)  {

    
    toastr.success("Data updated successfully", "Success");
    $('#modal_ajax').modal('hide');
    reload_data(post_refresh_url);
}



/*-----------------custom functions for ajax post data handling--------------------*/



// custom function for reloading table data
function reload_data(url)
{
    $.ajax({
        url: url,
        success: function(response)
        {
            // Replace new page data
            jQuery('.main_data').html(response);

        }
    });
}

</script>