
<?php 
	$this->db->order_by('note_id' , 'desc');
	$this->db->where('user_id' , $this->session->userdata('login_user_id'));
	$this->db->where('user_type' , $this->session->userdata('login_type'));
	$notes = $this->db->get('note')->result_array();
?>

<ul class="nav tabs-vertical" style="width: 30%;">

<?php 
$counter = 0;
foreach ($notes as $row):
$counter++;
?>
	<li class="<?php 
                    if (isset($active_note_id) && $active_note_id > 0)
                    {
                        if ($active_note_id == $row['note_id']) echo 'active';
                    }
                    else 
                    {
                        if ($counter == 1) echo 'active';
                    }
                    ?>">
        <a href="#<?php echo $row['note_id'];?>" data-toggle="tab">
            <i class="entypo-right-open-mini"></i> <?php echo $row['title'];?>
        </a>
    </li>
<?php endforeach;?>

</ul>
			
<div class="tab-content" style="width: 70%;">

<?php 
$counter = 0;
foreach ($notes as $row):
$counter++;
?>


	<div class="tab-pane <?php 
                    if (isset($active_note_id) && $active_note_id > 0)
                    {
                        if ($active_note_id == $row['note_id']) echo 'active';
                    }
                    else 
                    {
                        if ($counter == 1) echo 'active';
                    }
                    ?>" 
		id="<?php echo $row['note_id'];?>">

        <?php echo form_open(base_url() . 'index.php?client/note/save/' . $row['note_id'] , array(
            'class' => 'note-save-' . $row['note_id']));
        ?>
        <div  style="padding:5px; background-color: #FFFCEE; border: 1px #f3f3f3 solid;">
    		<div class="form-group" style="margin: 0px;">
    	        <div class="col-md-12" style="padding:0px; background-color: #FFFCEE; font-size: 14px;">
    	            <input type="text" class="form-control" rows="14" style="padding: 5px; border:0px; background-color: #FFFCEE; font-size: 18px;"  
    	                name="title" placeholder="<?php echo get_phrase('untitled');?>"
    	                	value="<?php echo $row['title'];?>">
    	        </div>
    	    </div>

    	    <hr style="margin: 0px;" />

    		<div class="form-group">
    	        <div class="col-md-12" style="padding:0px; background-color: #FFFCEE;">
    	            <textarea class="form-control autogrow" rows="14" style="padding: 5px; border:0px; background-color: #FFFCEE; min-height: 400px;"  
    	                name="note" placeholder="Write notes....."><?php echo $row['note'];?></textarea>
    	        </div>
    	    </div>
        </div>
        <br />

        <!-- NOTE SAVING BUTTON -->
        <button type="submit" class="btn btn-info" id="submit-button">
            <i class="entypo-floppy"></i>
            <?php echo get_phrase('save_note'); ?>
        </button>

        <!-- NOTE DELETION BUTTON-->
        <button type="button" class="btn btn-white pull-right" id="submit-button" 
            onclick="confirm_modal('<?php echo base_url(); ?>index.php?client/note/delete/<?php echo $row['note_id']; ?>', 
                                    '<?php echo base_url(); ?>index.php?client/reload_notes_tab_body');">
            <i class="entypo-trash"></i>
            <?php echo get_phrase('delete_note'); ?>
        </button>

        <?php echo form_close();?>
	</div>

<?php endforeach;?>

</div>



<script>
    // url for refresh data after ajax form submission
    var post_refresh_url    =   '<?php echo base_url();?>index.php?client/reload_notes_tab_body';
</script>

<!-- calling ajax form submission plugin for specific form -->
<script src="assets/js/jquery.form.js"></script>

<script type="text/javascript">
    // ajax form plugin calls at each modal loading,
$(document).ready(function() { 
    
    <?php foreach ($notes as $row):?>
        // configuration for ajax form submission
        var option<?php echo $row['note_id'];?> = { 
            //beforeSubmit        :   validate,  
            success             :   showResponse<?php echo $row['note_id'];?>,  
            resetForm           :   true 
        }; 
        
        // binding the form for ajax submission
    
        $('.note-save-<?php echo $row['note_id'];?>').submit(function() { 
            $(this).ajaxSubmit(option<?php echo $row['note_id'];?>); 
            
            
            // prevents normal form submission
            return false; 
        }); 

    <?php endforeach;?>
});

<?php foreach ($notes as $row):?>
    // ajax success response after form submission, post_refresh_url is sent from modal body
    function showResponse<?php echo $row['note_id'];?>(responseText, statusText, xhr, $form)  { 
        
        toastr.success("Note saved", "Success");
        //reload_data(post_refresh_url);
        $.ajax({
        url: "<?php echo base_url();?>index.php?client/reload_notes_tab_body/<?php echo $row['note_id'];?>",
        success: function(response)
        {
                // Replace new page data
                jQuery('.main_data').html(response);

                // Auto Size for Textarea
                $("textarea.autogrow, textarea.autosize").autosize();


            }
        });
    }
<?php endforeach;?>


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
// custom function for data deletion by ajax and post refreshing call
function delete_data(delete_url , post_refresh_url)
{
    
    $.ajax({
        url: delete_url,
        success: function(response)
        {
            toastr.info("Note deleted.", "Success");
            
            $('#modal_delete').modal('hide');

            // reload the notes
            reload_data(post_refresh_url);
        }
    });
}
</script>



