<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="{{asset('img/favicon.jpg')}}"/>

    <!-- Custom fonts for this template-->
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/bootstrap-select.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{asset('css/selectize.css')}}" />

    <style>
        @media (min-width: 576px) {
            #CarteTubeModal {
                max-width: 1000px;
            }
        }
        .TCVal{
            color: orangered;
        }
        .CTCollapse{
            background-color: #043084;
            color:#fff;
            margin-top:15px;
        }
        .CTButton{
            background-color: #043084;
            color:#fff;
        }
        body {
            color: #000;
            background-color: #f8f9fc;
            /*font-family: Arial,  sans-serif;*/
        }
        .nav-link{
            font-weight: bold;
        }
        .table{
            color : #000;
            table-layout: auto;
            width: 100%;
            text-align: center;
        }
        table button
        ,table i.fa{
            font-size: 20px;
            border:none;
            background-color: rgba(0,0,0,0);
        }
        section {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            /*box-shadow: #ddd -2px -2px 2px;*/
            margin-top: 20px;
            border: 2px solid #ddd;
            box-shadow: 0 .15rem 1.75rem 0 rgba(58,59,69,.15)!important;
        }
        input[type=text] {
            padding: 0px 0px;
            text-align: center;
        }

        input:invalid, select:invalid {
            border: 1px solid red;
        }

        legend {
            border-bottom: 1px solid #ddd;
            width: 80% !important;
        }

        footer.sticky-footer {
            padding-bottom: 0;
        }

        .table-container {
            min-width: 100%;
            max-height: 500px;
            max-width: 120%;
        }
        #bottom-actions button{
            padding: 5px 0px;
        }
        .form-control{
            color:#000;
        }
        #cardBackdrop table{
            min-width: 0;
        }
        #CarteTubeTable > tbody > tr > td ,#CarteTubeTable > tbody > tr > th  {
            border:1px solid blue;
            font-weight: bold;
        }
    </style>
    @yield('style')

</head>

<body id="page-top">
<section class="mt-0" id="title-section">

    <h3 id="titleVal" class="font-weight-bolder text-primary text-center nav-link " ></h3>
</section>
<!-- Page Wrapper -->
<div id="wrapper">


    @yield('content')


</div>
<!-- End of Page Wrapper -->

<footer class="sticky-footer container-fluid ">
    <section class="mt-0" id="title-section  ">
        <a class="navbar-brand text-center col-12 nav-link " href="{{route('home')}}">
            <img src="{{asset('img/Login.jpg')}}" width="30" height="30" class="d-inline-block align-top"  >
            Page D'accueil
        </a>
    </section>
</footer>

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>


<!-- Bootstrap core JavaScript-->
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/bootstrap-select.min.js')}}"></script>


<!-- Core plugin JavaScript-->
<script src="{{asset('js/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset('js/sb-admin-2.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/selectize.min.js')}}"></script>
@yield('script')
<script>
    $(document).ready(function(){

        $('#titleVal').html($('title').html());
       $('td button i.fa.fa-edit').parent().parent().css("min-width","100px");
    });
</script>

</body>

</html>
