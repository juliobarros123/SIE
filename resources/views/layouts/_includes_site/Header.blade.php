<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    {{-- <link rel="preconnect" href="https://fonts.googleapis.com"> --}}
    {{-- <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> --}}
    {{-- <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> --}}

    <title>S.I.E</title>

    <!-- Bootstrap core CSS -->
    <link href="/site/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link href="/site/assets/css/style.css" rel="stylesheet">
    <link href="/site/assets/css/fontsGoogleapis.css" rel="stylesheet">
    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="/site/assets/css/fontawesome.css">
    <link rel="stylesheet" href="/site/assets/css/templatemo-digimedia-v1.css">
    <link rel="stylesheet" href="/site/assets/css/animated.css">
    <link rel="stylesheet" href="/site/assets/css/owl.css">
    <script src="/js/sweetalert2.all.min.js"></script>
<!--

TemplateMo 568 DigiMedia

https://templatemo.com/tm-568-digimedia

-->
<script src="/js/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  </head>

<body>

        @include('layouts._includes_site.Menu')
       
       
                        @yield('conteudo')

             
     
    @include('layouts._includes_site.Footer')
</body>

</html>
