<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Backend Foxpay</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="/static/components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/static/components/font-awesome/css/font-awesome.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="/static/components/select2/dist/css/select2.min.css">

    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="/static/components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="/static/components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="/static/plugins/jquery.growl/jquery.growl.css">

    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="/static/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    
    <!-- Theme style -->
    <link rel="stylesheet" href="/static/css/AdminLTE.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/static/plugins/iCheck/square/blue.css">
    
    <link rel="stylesheet" href="{{ asset('static/plugins/toast/toastr.css') }}"/>
    <link rel="stylesheet" href="/static/css/custom.css">
    <link rel="stylesheet" href="{{ asset('static/plugins/fancybox/jquery.fancybox.css') }}"/>
    @yield('header')
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="/" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>FP</b></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>Fox</b>PAY</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                @include('partials.user_info')
            </nav>
        </header>
        
        {!! view('partials/sidebar', ['menuLinks' => $menuLinks, 'permissions' => $userPermissions]) !!}

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            
            @include('partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])

            @yield('content')
        </div>
        <!-- /.content-wrapper -->
        
        {!! view('partials.delete_modal') !!}
        
        {!! view('partials.deactivate_modal') !!}
        
        @include('partials.modal')

        <footer class="main-footer">
            <strong>Copyright &copy; 2019.</strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery 3 -->
    <script src="/static/components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap 3.3.7 -->
    <script src="/static/components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Select2 -->
    <script src="/static/components/select2/dist/js/select2.full.min.js"></script>
    <!-- bootstrap datepicker -->
    <script src="/static/components/moment/min/moment.min.js"></script>
    <script src="/static/components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <!-- SlimScroll -->
    <script src="/static/components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="/static/components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="/static/js/adminlte.min.js"></script>
    <script src="/static/plugins/jquery.growl/jquery.growl.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>

    <!-- iCheck -->
    <script src="/static/plugins/iCheck/icheck.min.js"></script>
    <!-- CK Editor -->
    <script src="/static/components/ckeditor/ckeditor.js"></script>
    <!-- AdminLTE for demo purposes -->
    

    <script src="{{ asset('static/plugins/jquery-validation/dist/jquery.validate.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('static/plugins/toast/toastr.min.js') }}"></script>
    
    <script src="{{ asset('static/plugins/input-mask/jquery.inputmask.bundle.js') }}"></script>
    <!-- <script src="{{ asset('static/plugins/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('static/plugins/input-mask/jquery.inputmask.numeric.extensions.js') }}"></script>
	<script src="{{ asset('static/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script> -->
    
    <script src="{{ asset('static/plugins/fancybox/jquery.fancybox.js') }}"></script>
    
    <script src="/static/js/helper.js"></script>
    
    <script type="text/javascript">
        
        var popUpWin = 0; // Popup
        var submitForm = false;  // Form state
        
        // Initial messages
        var selectItemToExecuteMsg = '<?php echo trans('global.you_must_select_at_least_one_item') ?>';
        var selectActionToExecuteMsg = '<?php echo trans('global.you_must_select_an_action') ?>';

        toastr.options.closeButton = true;
        toastr.options.closeDuration = 0;
        toastr.options.timeOut = 10000;
        
        // Handle delete modal
        $('.row-delete-modal').on('click', function (e) {
            e.preventDefault();
            var el = $(this).parent();
            var title = el.attr('data-title');
            var msg = el.attr('data-message');
            var dataForm = el.attr('data-form');
            $('#row-delete-form').attr('action', dataForm);
        });

        $('#row-delete-modal').on('click', '#delete-modal-submit-btn', function (e) {
            $('#row-delete-form').submit();
        });
        
        // Handle deactive modal
        $('.row-deactivate-modal').on('click', function (e) {
            e.preventDefault();
//            var el = $(this).parent();
            var el = $(this);
            var title = el.attr('data-title');
            var msg = el.attr('data-message');
            var dataForm = el.attr('data-form');
            $('#row-deactivate-form').attr('action', dataForm);
            if (title) $('.modal-title', '#row-deactivate-form').html(title);
            if (msg) $('.modal-body', '#row-deactivate-form').html(msg);
        });

        $('#row-deactivate-modal').on('click', '#submit-btn', function (e) {
            $('#row-deactivate-form').submit();
        });

        $('#mass-delete-modal').on('click', '#submit-btn', function (e) {
            $('#list-form').submit();
        });

        $('#mass-actions-btn').click(function (event) {

            if ($('#mass_actions').val() !== '') {

                var items = $("*[name='ids[]']:checked:enabled");

                if (items.length == 0) {
                    bsWarning(selectItemToExecuteMsg);
                    return;
                }
                
                var selectedAction = $('#mass_actions option:selected');
                var action = selectedAction.data('action');
                var url = $('#mass_actions').val();
                
                if (action == 'mass-delete') {
                    $('#list-form').attr('action', url);
                    $('#mass-delete-modal').modal('show');
                    return;
                } else if (action == 'mass-activate') {
                    $('#list-form').append('<input type="hidden" name="status" value="1" />');
                } else if (action == 'mass-deactivate') {
                    $('#list-form').append('<input type="hidden" name="status" value="0" />');
                }

                
//                if (url.indexOf('mass-delete') > 0) {
//                    $('#list-form').attr('action', url);
//                    $('#mass-delete-modal').modal('show');
//                    return;
//                }

                // Disables the element.
                $(this).attr('disabled', 'disabled');

                $('#list-form').attr('action', url);

                $('#list-form').submit();

            } else {
                bsWarning(selectActionToExecuteMsg);
            }
        });

        $('#filter-reset-btn').click(function (event) {
            document.location = $(this).parent('a').attr('href');
        });

    </script>
    <script src="/static/js/main.js"></script>
    <script src="/static/js/common.js"></script>
    <script src="/static/plugins/bootbox/bootbox.js"></script>


    <?php if (Session::has('message_success')) : ?>
    <script type="text/javascript">
        $(document).ready(function (event) {
            toastr.success('{{ Session::get('message_success') }}');
        });
    </script>
    <?php endif; ?>

    <?php if (Session::has('message_error')) : ?>
    <script type="text/javascript">
        $(document).ready(function (event) {
            toastr.error('{{ Session::get('message_error') }}');
        });
    </script>
    <?php endif; ?>
    
    @yield('script')
</body>

</html>