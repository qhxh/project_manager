<?php
    $user = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
?>

<div id="chat" class="fixed">

    <div class="chat-inner">

        <!-- Amchart Clock 
        <div id="chartdiv" style="width:250px; height:250px;"></div>
        -->

        <h2 style="color: #EFF3F4;font-weight: 100;text-align: center; margin-top:42px;">
            <?php echo date("l");?>
            <br />
            <?php echo date("jS F, Y");?>
        </h2>
        <h3 style="color: #fff;background-color: #34495e;font-size: 12px;padding: 5px; font-weight:200;">

            <i class="entypo-list"></i>
            To do list
        </h3>
        
        <div class="row">
            <div class="col-md-12">
                <?php echo form_open('admin/todo/add', array('class' => 'form-horizontal form-groups validate todo-add',
                    'enctype' => 'multipart/form-data')); ?>
                
                        <div class="form-group">

                            <div class="col-sm-10 col-sm-offset-1">
                                <input class="form-control" type="text" name="title" id="title" placeholder="+ Add todo list" 
                                    style="background-color: #364559;border: 1px solid #4F595E;color: rgba(170,170,170 ,1); "
                                        data-validate="required" autofocus/>
                            </div>
                            <input type="submit" value="" class="btn btn-primary btn-xs" style="width:0px; height:0px" />
                        </div>

                        <!--<div class="form-group">
                            <div class="col-sm-offset-4 col-sm-7">
                                <button type="submit" class="btn btn-info" id="submit-button">
                                    <?php echo get_phrase('add'); ?></button>
                                <span id="preloader-form"></span>
                            </div>
                        </div>-->
                <?php form_close(); ?>
                <table style="width: 83%;margin-left: 22px;">
                <?php 
                $this->db->where('user' , $user);
                $this->db->order_by('order' , 'asc');
                $todos  =   $this->db->get('todo')->result_array();
                foreach ($todos as $row):?>
                        <tr>
                            <td>
                                <li id="todo_1" 
                                    style="<?php if ($row['status'] == 1):?>text-decoration: line-through;<?php endif;?>font-size: 13px;
                                        <?php if ($row['status'] == 0):?>color: #fff;<?php endif;?>;">
                                    <?php echo $row['title'];?>
                                </li>
                            </td>
                            <td style="text-align:right;">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle " data-toggle="dropdown"
                                        style="padding:0px;background-color: #303641;border: 0px;-ms-transform: rotate(90deg); /* IE 9 */
    -webkit-transform: rotate(90deg); /* Chrome, Safari, Opera */
    transform: rotate(90deg);">
                                        <i class="entypo-dot-2" style="color:#B4BCBE;"></i> 
                                        <span class="" style="visibility:hidden; width:0px;"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu" style="text-align:left;">
                                        <li>
                                            <?php if ($row['status'] == 0):?>
                                                <a href="#" onclick="mark_as_done('<?php echo $row['todo_id'];?>');">
                                                    <i class="entypo-check"></i>
                                                    <?php echo get_phrase('mark_completed'); ?>
                                                </a>
                                            <?php endif;?>
                                            <?php if ($row['status'] == 1):?>
                                                <a href="#" onclick="mark_as_undone('<?php echo $row['todo_id'];?>');">
                                                    <i class="entypo-cancel"></i>
                                                    <?php echo get_phrase('mark_incomplete'); ?>
                                                </a>
                                            <?php endif;?>
                                        </li>


                                        <li>
                                            <a href="#" onclick="swap('up', '<?php echo $row['todo_id'];?>')">
                                                <i class="entypo-up"></i>
                                                <?php echo get_phrase('move_up'); ?>
                                            </a>
                                            <a href="#" onclick="swap('down', '<?php echo $row['todo_id'];?>')">
                                                <i class="entypo-down"></i>
                                                <?php echo get_phrase('move_down'); ?>
                                            </a>
                                        </li>
                                        <li class="divider"></li>


                                        <li>
                                            <a href="#" onclick="delete_todo('<?php echo $row['todo_id'];?>');">
                                                <i class="entypo-trash"></i>
                                                <?php echo get_phrase('delete'); ?>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach;?>
                </table>
            </div>
        </div>
        <h3 style="color: #fff;background-color: #34495e;font-size: 12px;padding: 5px; font-weight:200;">

            <i class="entypo-doc-text"></i>
            Calculator
        </h3>
        <!-- calculator-->
        <div class="col-sm-10">
            <style>
                .calculator_button{
                    border : 1px solid #303641;
                    width: 50px;
                    background-color: #5A606C;
                    color: #F5FAFC;
                    cursor:auto;
                }
                .calculator_button:hover{
                    border : 1px solid #303641;
                    background-color: #5A606C;
                    color: #F5FAFC;
                }
                .calculator_button:focus{
                    border : 1px solid #303641;
                    background-color: #5A606C;
                    color: #F5FAFC;
                }
            </style>    
            <form name="form1" onsubmit="return false">
            <table style="width: 83%;margin-left: 22px;">
                <tr>
                    <td colspan="4"><input type="text" id="display" style="width:100%; border:0px; background-color:#303641;text-align: right;  font-size: 24px;  font-weight: 100;  color: #fff;" readonly placeholder="0" /></td>
                </tr>
                <tr>
                    <td colspan="4"><button type="button" class="btn btn-default calculator_button" style="width:100%;"  onclick="reset()">Clear</button></td>
                </tr>
                <tr>
                    <td><button type="button" class="btn btn-default calculator_button" onclick="displaynum(7)">7</button></td>
                    <td><button type="button" class="btn btn-default calculator_button" onclick="displaynum(8)" >8</button></td>
                    <td><button type="button" class="btn btn-default calculator_button" onclick="displaynum(9)" >9</button></td>
                    <td><button type="button" class="btn btn-default calculator_button" onclick="operator(&quot;+&quot;)">+</button></td>
                </tr>
                <tr>
                    <td><button type="button" class="btn btn-default calculator_button" onclick="displaynum(4)">4</button></td>
                    <td><button type="button" class="btn btn-default calculator_button" onclick="displaynum(5)" >5</button></td>
                    <td><button type="button" class="btn btn-default calculator_button" onclick="displaynum(6)" >6</button></td>
                    <td><button type="button" class="btn btn-default calculator_button" onclick="operator(&quot;-&quot;)" >-</button></td>
                </tr>
                <tr>
                    <td><button type="button" class="btn btn-default calculator_button" onclick="displaynum(1)">1</button></td>
                    <td><button type="button" class="btn btn-default calculator_button" onclick="displaynum(2)" >2</button></td>
                    <td><button type="button" class="btn btn-default calculator_button" onclick="displaynum(3)" >3</button></td>
                    <td><button type="button" class="btn btn-default calculator_button" onclick="operator(&quot;*&quot;)" >&times;</button></td>
                </tr>
                <tr>
                    <td><button type="button" class="btn btn-default calculator_button" onclick="displaynum(0)">0</button></td>
                    <td><button type="button" class="btn btn-default calculator_button" onclick="displaynum(&quot;.&quot;)" >.</button></td>
                    <td><button type="button" class="btn btn-default calculator_button" onclick="equals()" >=</button></td>
                    <td><button type="button" class="btn btn-default calculator_button" onclick="operator(&quot;/&quot;)" >&divide;</button></td>
                </tr>
            </table>
            </form>


            
        </div>        
    </div>
    
</div>


<script src="assets/js/calculator.js"></script>


<script>
    
    // Custom functions for todo starts here.
    jQuery(document).ready(function ($)
    //$(document).ready(function () 
    {

        var options = {
            beforeSubmit: validate_todo_add,
            success: show_response_todo_add,
            resetForm: true
        };
        $('.todo-add').submit(function () {
            $(this).ajaxSubmit(options);
            return false;
        });
    });
    
    function validate_todo_add(formData, jqForm, options) {

        if (!jqForm[0].title.value)
        {
            return false;
        }
    }

    function show_response_todo_add(responseText, statusText, xhr, $form) {
        reload_todo_body();
    }

    function reload_todo_body()
    {
        $.ajax({
            url: '<?php echo base_url(); ?>index.php?admin/todo/reload',
            success: function (response)
            {
                jQuery('.todo_data').html(response);
            }
        });

        $.ajax({
            url: '<?php echo base_url(); ?>index.php?admin/todo/reload_incomplete_todo',
            success: function (response)
            {
                jQuery('#incomplete_todo_number').html(response);
            }
        });

    }
    
    function mark_as_done(todo_id)
    {
        $.ajax({
            url: '<?php echo base_url(); ?>index.php?admin/todo/mark_as_done/'+todo_id,
            success: function ()
            {
                reload_todo_body();
            }
        });
    }
    
    function mark_as_undone(todo_id)
    {
        $.ajax({
            url: '<?php echo base_url(); ?>index.php?admin/todo/mark_as_undone/'+todo_id,
            success: function ()
            {
                reload_todo_body();
            }
        });
    }
    
    function delete_todo(todo_id)
    {
        $.ajax({
            url: '<?php echo base_url(); ?>index.php?admin/todo/delete/'+todo_id,
            success: function ()
            {
                reload_todo_body();
            }
        });
    }
    
    function swap(swap_with, todo_id)
    {
        $.ajax({
            url: '<?php echo base_url(); ?>index.php?admin/todo/swap/'+todo_id+'/'+swap_with,
            success: function ()
            {
                reload_todo_body();
            }
        });
    }
    // Custom functions for todo ends here.
    
            
    // Amchart clock function start here.        
    var chart = AmCharts.makeChart("clock_div", {
        "type": "gauge",
        "theme": "light",
        "startDuration": 0.3,
        "marginTop":10,
        "marginBottom":10,
        "faceAlpha" : 1,
        "faceColor" : "#ffffff",
        "faceBorderAlpha" : 1,
        "faceBorderColor" : "#000000",
        "faceBorderWidth" : 3,
        "color" : "#000000",
        "axes": [{
            "axisAlpha": 0.3,
            "endAngle": 360,
            "endValue": 12,
            "minorTickInterval": 0.2,
            "showFirstLabel": false,
            "startAngle": 0,
            "axisThickness": 1,
            "valueInterval": 1
        }],
        "arrows": [{
            "radius": "50%",
            "innerRadius": 0,
            "clockWiseOnly": true,
            "nailRadius":10,
            "nailAlpha": 1
        }, {
            "nailRadius": 0,
            "radius": "80%",
            "startWidth": 6,
            "innerRadius": 0,
            "clockWiseOnly": true
        }, {
            "color": "#CC0000",
            "nailRadius": 4,
            "startWidth": 3,
            "innerRadius": 0,
            "clockWiseOnly": true,
            "nailAlpha": 1
        }]
    });
    
    // update each second
    $( document ).ready(function() {
        //setInterval(updateClock, 1000);
    });


    // update clock
    function updateClock() {
        // get current date
        var date = new Date();
        var hours = date.getHours();
        var minutes = date.getMinutes();
        var seconds = date.getSeconds();

        // set hours
        chart.arrows[0].setValue(hours + minutes / 60);
        // set minutes
        chart.arrows[1].setValue(12 * (minutes + seconds / 60) / 60);
        // set seconds
        chart.arrows[2].setValue(12 * date.getSeconds() / 60);
    }

</script>