<span class="todo_data">
    <?php include 'todo_body.php';?>
</span>

<?php if (($this->session->flashdata('flash_message')) != ""): ?>
    <script type="text/javascript">
        toastr.info("<?php echo $this->session->flashdata('flash_message'); ?>");
    </script>
<?php endif; ?>

<script>
function start_clock() {
    //setInterval(updateClock, 1000);
    
}
    
</script>