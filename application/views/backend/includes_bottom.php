
<link rel="stylesheet" href="assets/js/daterangepicker/daterangepicker-bs3.css">

<link rel="stylesheet" href="assets/js/selectboxit/jquery.selectBoxIt.css">

<link rel="stylesheet" href="assets/js/wysihtml5/bootstrap-wysihtml5.css">
<link rel="stylesheet" href="assets/js/selectboxit/jquery.selectBoxIt.css">
<link rel="stylesheet" href="assets/js/datatables/responsive/css/datatables.responsive.css">
<link rel="stylesheet" href="assets/js/select2/select2-bootstrap.css">
<link rel="stylesheet" href="assets/js/select2/select2.css">

<!-- Bottom Scripts -->
<script src="assets/js/gsap/main-gsap.js"></script>
<script src="assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/joinable.js"></script>
<script src="assets/js/resizeable.js"></script>
<script src="assets/js/neon-api.js"></script>
<script src="assets/js/bootstrap-switch.min.js"></script>
<script src="assets/js/raphael-min.js"></script>
<script src="assets/js/morris.min.js"></script>
<script src="assets/js/toastr.js"></script>
<script src="assets/js/jquery.validate.min.js"></script>
<script src="assets/js/fullcalendar/fullcalendar.min.js"></script>
<script src="assets/js/bootstrap-datepicker.js"></script>
<script src="assets/js/fileinput.js"></script>
<script src="assets/js/wysihtml5/wysihtml5-0.4.0pre.min.js"></script>
<script src="assets/js/wysihtml5/bootstrap-wysihtml5.js"></script>
<script src="assets/js/jquery.multi-select.js"></script>
<script src="assets/js/jquery.knob.js"></script>
<script src="assets/js/selectboxit/jquery.selectBoxIt.min.js"></script>
<script src="assets/js/jquery.inputmask.bundle.min.js"></script>
<script src="assets/js/daterangepicker/moment.min.js"></script>
<script src="assets/js/daterangepicker/daterangepicker.js"></script>

<link rel="stylesheet" href="assets/js/dropzone/dropzone.css">
<script src="assets/js/dropzone/dropzone.js"></script>

<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/datatables/TableTools.min.js"></script>
<script src="assets/js/dataTables.bootstrap.js"></script>
<script src="assets/js/datatables/jquery.dataTables.columnFilter.js"></script>
<script src="assets/js/datatables/lodash.min.js"></script>
<script src="assets/js/datatables/responsive/js/datatables.responsive.js"></script>
<script src="assets/js/select2/select2.min.js"></script>
<script src="assets/js/bootstrap-colorpicker.min.js"></script>

<script src="assets/js/neon-calendar.js"></script>
<script src="assets/js/neon-chat.js"></script>
<script src="assets/js/neon-custom.js"></script>
<script src="assets/js/neon-demo.js"></script>
<script src="assets/js/neon-notes.js"></script>
<script src="assets/js/jquery.form.js"></script>

<script type="text/javascript">
    $(".email_template_editors").wysihtml5();
</script>

<?php if (($this->session->flashdata('flash_message')) != ""): ?>
    <script type="text/javascript">
        toastr.info("<?php echo $this->session->flashdata('flash_message'); ?>");
    </script>
<?php endif; ?>