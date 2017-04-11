<script type="text/javascript">
    //tinh toan don vi triet khau
    function onChangeDiscount() {
        var selected_donvi = $('select[name=donvi-chietkhau]').val();
        if ( selected_donvi == 'money' ) {
            $('#discount-value').val($('#input-discount').val());
        }
        if ( selected_donvi == 'percent' ) {
            var project_buget = $('input[name=budget]').val();
            console.log(project_buget);
            var project_discount = $('#input-discount').val();
            console.log(project_discount);
            var convert = project_buget * project_discount / 100;
            console.log(convert);
            $('#discount-value').val(convert);
        }
    }
</script>
<!-- ajax change category -->
<?php
    //get all categroy
    $cats = $this->db->get('project_category')->result_array();
?>
<script src="<?php echo base_url();  ?>assets/js/moment.js"></script>
<script type="text/javascript">
   function onChangeCategory() {
        var cats_array = <?php echo json_encode($cats); ?>;
        var selected_category =  $('select[name=category]').val();
   
        var len = cats_array.length;
        var cat_gia = 0;
        var cat_time = 0;
     
        for (var i = 0; i< len ;i++) {
            if ( cats_array[i].project_category_id == selected_category ) {
                cat_gia = cats_array[i].cat_ngansach;
                cat_time = cats_array[i].cat_time;
                break;
            }
        }
        //update textbox
        $('input[name="budget"]').val(cat_gia);

        //update time
        cat_time = parseInt(cat_time);
        cat_time = cat_time + Math.round(cat_time / 7);
        var today = moment();
        var end_day = today.add('days',cat_time);
        document.getElementById('timestamp_end').value = end_day.format('DD/MM/YYYY');

    }

</script>
<!-- end ajax -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title" >
                    <i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('project_form'); ?>
                </div>
            </div>
            <div class="panel-body">

                <?php echo form_open(base_url() . 'index.php?admin/project/create/', array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data')); ?>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('project_title'); ?></label>

                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="title" id="title" data-validate="required" 
                               data-message-required="<?php echo get_phrase('value_required'); ?>" value="" autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('description'); ?></label>

                    <div class="col-sm-8">
                        <textarea class="form-control wysihtml5" rows="10" name="description" id="post_content" 
                                  data-stylesheet-url="assets/css/wysihtml5-color.css"></textarea>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo "Gói:"; ?></label>
               
                    <div class="col-sm-5">
                        <select name="category" class="form-control selectboxit" onchange="onChangeCategory();">
                            <option value="-1"></option>
                            <?php
                           
                            foreach ($cats as $cat):
                                ?>
                                <option value="<?php echo $cat['project_category_id']; ?>">
                                    <?php echo $cat['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
              
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('budget'); ?></label>

                    <div class="col-sm-5">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="entypo-bookmarks"></i></span>
                            <input type="text" class="form-control" name="budget"  value="" >
                        </div>
                    </div>
                </div>
                
                 <!-- qhxh code -->
                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('discount'); ?></label>

                   
                        <div class="col-xs-2">
                            <input type="text" class="form-control" id="input-discount" name="input-discount"  value="0" >
                        </div>
                        <div class="col-xs-2">
                            <select class="form-control pull-left" name="donvi-chietkhau" onchange="onChangeDiscount();">
                                <option value="money" selected> Đơn vị </option>
                                <option value="money" > VND </option>
                                <option value="percent"> % </option>
                            </select>
                        </div>
                        <div class="col-xs-2">
                            <input type="text" class="form-control" id="discount-value" name="discount" value="0" > 
                        </div>
        
                </div>
                <!-- end qhxh code -->

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('start_time'); ?></label>

                    <div class="col-sm-5">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="entypo-calendar"></i></span>
                            <input type="text" id = "timestamp_start" data-format="dd/mm/yy" class="form-control datepicker" name="timestamp_start"  value="<?php echo date('d/m/y') ?>" >
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('ending_time'); ?></label>

                    <div class="col-sm-5">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="entypo-calendar"></i></span>
                            <input type="text" id="timestamp_end" class="form-control datepicker" data-format="dd/mm/yy" name="timestamp_end"  value="" >
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('demo_url'); ?></label>

                    <div class="col-sm-5">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="entypo-globe"></i></span>
                            <input type="text" class="form-control" name="demo_url"  value="" >
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('progress_status'); ?></label>

                    <div class="col-sm-5" style="padding-top:9px;">
                        <div class="slider2 slider slider-blue" data-prefix="" data-postfix="%" 
                             data-min="-1" data-max="101" data-value="0"></div>
                        <input type="hidden" name="progress_status" id="progress_status" value="0" >
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('client'); ?></label>

                    <div class="col-sm-5">
                        <select id="client_id" name="client_id" class="select2">
                            <!-- client ajax load-->
                            <option><?php echo get_phrase('select_a_client'); ?></option>
                            <?php
                            $clients = $this->db->get('client')->result_array();
                            foreach ($clients as $row):
                                ?>
                                <option value="<?php echo $row['client_id']; ?>">
                                    <?php echo $row['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                
                <!-- qhxh code modal add client -->
                   
                 <button class="btn btn-default pull-left" data-izimodal-open="add-client-modal" data-izimodal-transitionin="fadeInDown">
                      <i class="entypo-plus-circled"></i>
                        <?php echo get_phrase('add');?>
            
                     </button>
                 <div id="add-client-modal">
                       <button class="btn btn-danger pull-right" data-izimodal-close="" style="margin:5px;">Đóng</button>
                 </div>
                <!-- end qhxh code -->
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('company'); ?></label>

                    <div class="col-sm-5">
                        <select id="company_select" name="company_id" class="form-control selectboxit">
                            <option><?php echo get_phrase('select_company'); ?></option>
                            <?php
                            $companies = $this->db->get('company')->result_array();
                            foreach ($companies as $row):
                                ?>
                                <option value="<?php echo $row['company_id']; ?>">
                                    <?php echo $row['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
               <!-- qhxh code modal add company -->
                   
                   <button class="btn btn-default pull-left" data-izimodal-open="add-company-modal" data-izimodal-transitionin="fadeInDown">
                      <i class="entypo-plus-circled"></i>
                        <?php echo get_phrase('add');?>
                   
                     </button>
                     <div id="add-company-modal">
                           <button class="btn btn-danger pull-right" data-izimodal-close="" style="margin:5px;">Đóng</button>
                     </div>
                    
                    
                <!-- end qhxh code -->
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('assign_staff'); ?></label>

                    <div class="col-sm-8">
                        <select multiple="multiple" name="staffs[]" class="form-control multi-select">
                            <?php
                            $staffs = $this->db->get('staff')->result_array();
                            foreach ($staffs as $row):
                                ?>
                                <option value="<?php echo $row['staff_id']; ?>">
                                    <?php echo $row['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"></label>

                    <div class="col-sm-8">
                        <div class="checkbox checkbox-replace color-blue">
                            <input type="checkbox" name="notify_check" id="notify" value="yes" checked>
                            <label> <?php echo get_phrase('notify_client'); ?></label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-8">
                        <button type="submit" class="btn btn-info" id="submit-button">
                            <?php echo get_phrase('add_new_project'); ?></button>
                        <span id="preloader-form"></span>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<!---qhxh code: ajax load select -->
<script type="text/javascript">
            $(document).ready(function() {

                $("#add-client-modal").iziModal({
                    title: "THÊM KHÁCH HÀNG",
                    closeButton: true,
                    zindex: 3,
                    headerColor: '#006470',
                    iframe: true,
                    iframeURL: "<?php echo base_url();?>index.php?/admin/add_client_modal/",
                    onClosed: function(){
                       
                        $("#client_id").empty();
                        $.get("<?php echo base_url() ?>" + "index.php?admin/ajax_get_client", function (data,status){
                            var list_client = JSON.parse(data);
                            //debug console
                           
                            var len = list_client.length;
                            for ( var i=0 ; i<len; i++ ) {
                                //console.log(list_client[i].client_id + "->"+ list_client[i].name);
                                
                                var option = $('<option value="'+list_client[i].client_id+'">'+ list_client[i].name+'</option>');
                                $('#client_id').append(option);
                            }   
                            $('#client_id').trigger("chosen:updated");
                        });
            
                        return false;
                    }
                });
                
                    $(document).on('click', '.trigger', function (event) {
                    event.preventDefault();
                    $('#add-client-modal').iziModal('open',this); // Use "this" to get URL href or option 'iframeURL'
                });
                /**************************************** add company modal ************************/
               $("#add-company-modal").iziModal({
                    title: "THÊM CÔNG TY",
                    closeButton: true,           
                    zindex: 3,
                    headerColor: '#006470',
                    iframe: true,
                    iframeURL: "<?php echo base_url();?>index.php?/admin/add_company_modal/",
                    onClosed: function(){
                        
                            $("#company_select").empty();
                
                            $.get("<?php echo base_url() ?>" + "index.php?admin/ajax_get_company", function (data,status){
                                var list_company = JSON.parse(data);
                                //debug console
                                var len_2 = list_company.length;
                                var option_company = '';
                
                                for ( var i=0 ; i < len_2 ; i++ ) {
                                    //console.log(list_company[i].client_id + "->"+ list_company[i].name);
                                    var new_option = '<option value = "' + list_company[i].company_id + '">' + list_company[i].name + '</option>';
                                    option_company += new_option;
                                }
                               
                                
                                $('#company_select').append(option_company);
                                $('#company_select').trigger("chosen:updated");
                            });
                
                            return false;
        
                    }
                });
                
                    $(document).on('click', '.trigger', function (event) {
                    event.preventDefault();
                    $('#add-company-modal').iziModal('open',this); // Use "this" to get URL href or option 'iframeURL'
                });
               
            });
        </script>
