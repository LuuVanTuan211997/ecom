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
    <link rel="stylesheet" href="/static/plugins/toast/toastr.css">

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    @yield('header')
    <!-- Theme style -->
    <link rel="stylesheet" href="/static/css/AdminLTE.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/static/plugins/iCheck/square/blue.css">
    <link rel="stylesheet" href="/static/css/custom.css">
    <link rel="stylesheet" href="/static/plugins/fancybox/jquery.fancybox.css">
</head>

<body>
    <!-- Site wrapper -->
    <div class="">

        
        <!-- Content Wrapper. Contains page content -->
        <div class="">
            @yield('content')            
        </div>
        <!-- /.content-wrapper -->

		
        
    </div>
    <!-- ./wrapper -->

    <!-- jQuery 3 -->
    <script src="/static/components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap 3.3.7 -->
    <script src="/static/components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('static/plugins/toast/toastr.min.js') }}"></script>

    <script type="text/javascript">
        jQuery(function(){
            toastr.options.closeButton = true;
            toastr.options.closeDuration = 0;
            toastr.options.timeOut = 10000;
            
            $.fn.loading = function(status) {
                var self = $(this);
                
                if (self.length == 1 && self.prop('nodeName') == 'FORM') {
                    if (status === false) {
                        self.find('div.loading').remove();
                        self.find('button.btn').attr('disabled', false);
                    }
                    else {
                        var html = '<div class="loading" style="width: 100%;height: 100%;top: 0px;left: 0px;position: fixed;display: block;opacity: 0.5;background-color: transparent;z-index: 99;text-align: center;">'+
                                    '<div style="height: 48%"></div>'+
            //                        '<img src="'+BASE_URL+'/assets/images/loaders/loader6.gif" alt="waiting..." style="z-index: 100;">'+
                                '</div>';
                        $(html).appendTo(self);
                        self.find('button').attr('disabled', true);
                    }  
                }
                else {
                    $.each(self, function(){
                        var self = $(this);
                        
                        if( self.prop('nodeName') == 'A' || self.prop('nodeName') == 'BUTTON' ) {
                            if (status === false) {
                                self.button('reset');
                            }
                            else {
                                self.data('loading-text', '<i class="fa fa-spinner fa-spin"></i> ' + (status || self.text()));
                                self.button('loading');
                            }
                        }
                    }); 
                }
            };

            $.fn.showValidationMessage = function(messages, class_name) {
                var form = $(this);
                if (!class_name) class_name = '.error';
                if ($.type(messages) == "object") {
                    var focus = 0;
                    $.each(messages, function(key, value){
                        var field = $('[name='+ key +']', form);
                        var error = $(class_name+'[for='+ key +']', form);
                        if (!error.length) error = field.parent().find(class_name);
                        if (!error.length) error = field.parent().parent().find(class_name);
                        if (!error.length) error = field.parent().parent().parent().find(class_name);
                        if (!error.length) error = field.parent().parent().parent().parent().find(class_name);
                        error.text(value[0]);
                        error.closest('.form-group').addClass('has-error')
                        if (focus === 0) {
                            field.focus();
                            focus = 1;
                        }
                    });
                }
                else if ($.type(messages) == "string") {
                    $.growl.error({title: "Error", message: messages });
                }
            };
        });
    </script>
    @if(session('message_success'))
    <script type="text/javascript">
        $.growl.notice({title: "Success", message: "{{session('message_success')}}" });
    </script>
    @endif
    
    @yield('script')
</body>

</html>