<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>MyStore-Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="{{ asset('admin_assets').'/css/styles.css' }}" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
    @include('admin.layout_partials.header')
    <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
              @include('admin.layout_partials.sidebar_nav')
            </div>
            <div id="layoutSidenav_content">
              @include('flash_data')
              @yield('content')
              @include('admin.layout_partials.footer')
            </div>
    </div>
    @include('admin.layout_partials.footer_script')      
    </body>
</html>