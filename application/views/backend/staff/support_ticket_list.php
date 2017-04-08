<div class="row">

    <div class="col-md-12">
        
        <ul class="nav nav-tabs bordered"><!-- available classes "bordered", "right-aligned" -->
            <li class="active">
                <a href="#opened" data-toggle="tab">
                    <span><i class="entypo-home"></i>
                    <?php echo get_phrase('opened');?></span>
                </a>
            </li>
            <li class="">
                <a href="#closed" data-toggle="tab">
                    <span><i class="entypo-archive"></i>
                    <?php echo get_phrase('closed');?></span>
                </a>
            </li>
        </ul>
        
        <div class="tab-content">
            <div class="tab-pane active" id="opened">
                
                <?php include 'support_ticket_opened.php';?>
                
            </div>
            <div class="tab-pane" id="closed">
                
                <?php include 'support_ticket_closed.php';?>
                    
            </div>
        </div>
        
        
    </div>

</div>


<script type="text/javascript">

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
        // showing user-friendly pre-loader image
        $('#preloader-delete').html('<img src="assets/images/preloader.gif" style="height:15px;margin-top:-10px;" />');
        
        // disables the delete and cancel button during deletion ajax request
        document.getElementById("delete_link").disabled=true;
        document.getElementById("delete_cancel_link").disabled=true;
        
        $.ajax({
            url: delete_url,
            success: function(response)
            {
                // remove the preloader 
                $('#preloader-delete').html('');
                
                // show deletion success msg.
                toastr.info("Data deleted successfully.", "Success");
                
                // hide the delete dialog box
                $('#modal_delete').modal('hide');
                
                // enables the delete and cancel button after deletion ajax request success
                document.getElementById("delete_link").disabled=false;
                document.getElementById("delete_cancel_link").disabled=false;
        
                // reload the table
                reload_data(post_refresh_url);
            }
        });
    }
</script>