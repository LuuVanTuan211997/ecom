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
    @yield('header')
    <!-- Theme style -->
    <link rel="stylesheet" href="/static/css/AdminLTE.css">
    <link rel="stylesheet" href="/static/css/custom.css">
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
    
    
    @if(session('message_success'))
    <script type="text/javascript">
        $.growl.notice({title: "Success", message: "{{session('message_success')}}" });
    </script>
    @endif
    
    @yield('script')
</body>

</html>