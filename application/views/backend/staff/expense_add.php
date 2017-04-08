<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title" >
                    <i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('add_expense'); ?>
                </div>
            </div>
            <div class="panel-body">

                <?php echo form_open(base_url() . 'index.php?staff/accounting_expense/add/', array(
                    'class' => 'form-horizontal form-groups-bordered validate expense-add', 'enctype' => 'multipart/form-data')); ?>

                <div class="form-group">
                    <label for="field-1" class="col-sm-4 control-label"><?php echo get_phrase('title'); ?></label>

                    <div class="col-sm-7">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="entypo-star"></i></span>
                            <input type="text" class="form-control" name="title" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" value="" autofocus>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-4 control-label"><?php echo get_phrase('category'); ?></label>

                    <div class="col-sm-7">
                        <select name="expense_category_id" class="form-control selectboxit">
                            <option><?php echo get_phrase('select_expense_category'); ?></option>
                            <?php
                            $categories = $this->db->get('expense_category')->result_array();
                            foreach ($categories as $row):
                                ?>
                                <option value="<?php echo $row['expense_category_id']; ?>">
                                    <?php echo $row['title']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-4 control-label"><?php echo get_phrase('amount'); ?></label>

                    <div class="col-sm-7">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="entypo-credit-card"></i></span>
                            <input type="text" class="form-control" name="amount" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" value="">
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label for="field-2" class="col-sm-4 control-label"><?php echo get_phrase('description'); ?></label>

                    <div class="col-sm-7">
                        <div class="input-group ">
                            <span class="input-group-addon"><i class="entypo-pencil"></i></span>
                            <textarea class="form-control autogrow" name="description" style="height:48px;"></textarea>
                        </div>
                    </div> 
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-4 control-label"><?php echo get_phrase('date'); ?></label>

                    <div class="col-sm-7">
                        <div class="date">
                            <input type="text" name="timestamp" class="form-control datepicker" data-format="D, dd MM yyyy"
                                placeholder="set date">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-7">
                        <button type="submit" class="btn btn-info" id="submit-button"><?php echo get_phrase('add_expense'); ?></button>
                        <span id="preloader-form"></span>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>


<script>
    // url for refresh data after ajax form submission
    var post_refresh_url = '<?php echo base_url(); ?>index.php?staff/reload_expense_list';
</script>


<script type="text/javascript">
    // ajax form plugin calls at each modal loading,
$(document).ready(function() {

    // Datepicker
        if($.isFunction($.fn.datepicker))
        {
            $(".datepicker").each(function(i, el)
            {
                var $this = $(el),
                    opts = {
                        format: attrDefault($this, 'format', 'mm/dd/yyyy'),
                        startDate: attrDefault($this, 'startDate', ''),
                        endDate: attrDefault($this, 'endDate', ''),
                        daysOfWeekDisabled: attrDefault($this, 'disabledDays', ''),
                        startView: attrDefault($this, 'startView', 0),
                        rtl: rtl()
                    },
                    $n = $this.next(),
                    $p = $this.prev();
                                
                $this.datepicker(opts);
                
                if($n.is('.input-group-addon') && $n.has('a'))
                {
                    $n.on('click', function(ev)
                    {
                        ev.preventDefault();
                        
                        $this.datepicker('show');
                    });
                }
                
                if($p.is('.input-group-addon') && $p.has('a'))
                {
                    $p.on('click', function(ev)
                    {
                        ev.preventDefault();
                        
                        $this.datepicker('show');
                    });
                }
            });
        }

   //config for project milestone adding
    var options = {
        beforeSubmit: validate_expense_add,
        success: show_response_expense_add,
        resetForm: true
    };
    $('.expense-add').submit(function () {
        $(this).ajaxSubmit(options);
        return false;
    });
    
    
});

function validate_expense_add(formData, jqForm, options) {

    if (!jqForm[0].amount.value)
    {
        toastr.error("Please enter amount", "Error");
        return false;
    }
}

// ajax success response after form submission
function show_response_expense_add(responseText, statusText, xhr, $form)  {

    
    toastr.success("Expense added successfully", "Success");
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

