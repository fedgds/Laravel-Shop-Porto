<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title')</title>
  
  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{asset('fe-asset')}}/assets/images/icons/favicon.png">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('assets')}}/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{asset('assets')}}/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{asset('assets')}}/css/AdminLTE.css">
  <link rel="stylesheet" href="{{asset('assets')}}/css/_all-skins.min.css">
  <link rel="stylesheet" href="{{asset('assets')}}/css/jquery-ui.css">
  <link rel="stylesheet" href="{{asset('assets')}}/css/style.css" />
  <script src="{{asset('assets')}}/js/angular.min.js"></script>
  <script src="{{asset('assets')}}/js/app.js"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
    {{-- Header --}}
    @include('admin.layouts.header')
    
    {{-- Menu --}}
    @include('admin.layouts.menu')

    {{-- Main content --}}
    @yield('main-content')

    {{-- Footer --}}
    @include('admin.layouts.footer')

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->

<script src="{{asset('assets')}}/js/jquery.min.js"></script>
<script src="{{asset('assets')}}/js/jquery-ui.js"></script>
<script src="{{asset('assets')}}/js/bootstrap.min.js"></script>
<script src="{{asset('assets')}}/js/adminlte.min.js"></script>
<script src="{{asset('assets')}}/js/dashboard.js"></script>
<script src="{{asset('assets')}}/js/function.js"></script>
@yield('custom-js')
</body>
</html>
