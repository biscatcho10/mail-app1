<!-- Footer -->

<footer class="main-footer">
    <strong>Copyright &copy; {{date("Y")}} <a href="https://www.creativetwinkles.com/">Creative Twinkles</a>.</strong>
    All rights reserved.
</footer>

<!-- Control Sidebar -->
{{--<aside class="control-sidebar control-sidebar-dark">--}}
{{--    <!-- Control sidebar content goes here -->--}}
{{--</aside>--}}
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="/styles/admin/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/styles/admin/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="/styles/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="/styles/admin/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="/styles/admin/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="/styles/admin/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="/styles/admin/plugins/jqvmap/maps/jquery.vmap.world.js"></script>
<!-- jQuery Knob Chart -->
<script src="/styles/admin/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="/styles/admin/plugins/moment/moment.min.js"></script>
<script src="/styles/admin/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Select2 -->
<script src="/styles/admin/plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="/styles/admin/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="/styles/admin/plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- bootstrap color picker -->
<script src="/styles/admin/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Bootstrap Switch -->
<script src="/styles/admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- BS-Stepper -->
<script src="/styles/admin/plugins/bs-stepper/js/bs-stepper.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
{{--<script src="/styles/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/js/tempusdominus-bootstrap-4.js"></script>

<!-- Summernote -->
<script src="/styles/admin/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="/styles/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/styles/admin/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/styles/admin/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/styles/admin/dist/js/pages/dashboard.js"></script>
<script src="//cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
<script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
@stack("scripts")

<!-- enable upload image in cke editor -->
<script>
    CKEDITOR.replace('editor');
    CKEDITOR.config.extraPlugins = 'uploadimage';
    CKEDITOR.config.uploadUrl = "{{route('upload.image', ['_token' => csrf_token() ])}}";
    CKEDITOR.config.filebrowserUploadUrl = "{{route('upload.image', ['_token' => csrf_token() ])}}";
    CKEDITOR.config.filebrowserImageUploadUrl = "{{route('upload.image', ['_token' => csrf_token() ])}}";
</script>


</body>
</html>
