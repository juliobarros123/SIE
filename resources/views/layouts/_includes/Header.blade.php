<!DOCTYPE html>
<html lang="en">



<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('titulo')</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="/admin/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="/admin/vendors/base/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- inject:css -->
    <link rel="stylesheet" href="/admin/css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="/admin/images/favicon.png" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="/js/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="/admin/css/datatable.css">
 


</head>

<body>
    <!-- Pre-loader start -->
    <div class="container-scroller">
        @include('layouts._includes.Menu')
        <div class="container-fluid page-body-wrapper">
            <!-- partial:../../partials/_sidebar.html -->



            @include('layouts._includes.Menu_aside')



            @yield('conteudo')

        

        </div>
    </div>

    @include('layouts._includes.Footer')
  

</body>

</html>
