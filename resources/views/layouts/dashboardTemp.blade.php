<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" type="image/jpg" href="{{asset('img/favicon.jpg')}}" />

  <!-- Custom fonts for this template-->
  <link href="{{asset('css/all.min.css')}}"  rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet" type="text/css">

   <style>
       body{
         color: #000;
         background-color: #f8f9fc;
         /*font-family: Arial, Helvetica, sans-serif;*/

       }
       @media (min-width: 576px) {
         #CarteTubeModal {
           max-width: 1000px;
         }
       }
       #cardBackdrop table{
         min-width: 0;
       }
       #CarteTubeTable > tbody > tr > td ,#CarteTubeTable > tbody > tr > th  {
         border:1px solid blue;
         font-weight: bold;

       }
       #CarteTubeTable > tbody > tr > th{
         background-color: #0275d8;
         color:#fff;
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
       section{
         background-color: #fff;
         border-radius: 10px;
         padding: 20px;
         /*box-shadow: #ddd -2px -2px 2px;*/
         margin-top: 20px;
         border: 2px solid #ddd;
         box-shadow: 0 .15rem 1.75rem 0 rgba(58,59,69,.15)!important;
       }
       td{
         vertical-align: middle !important;
         text-align: center;

       }
       .table{
         color : #000;
         table-layout: auto;
         width: 100%;
       }
       .table tbody{
         cursor:pointer;
       }
       .table-container  {
         overflow-x: auto;
       }

       .table th{
         position: sticky;
         top: 0;
         background-color: #0275d8;
       }
       table button
       ,table i.fa{
         font-size: 20px;
         border:none;
         background-color: rgba(0,0,0,0);
       }

     input[type=text]{
       padding: 0px 0px;
       text-align: center;
     }
     input:invalid,select:invalid{
       border: 1px solid red;
     }
     .card{
       cursor:pointer;
     }
     th{
       text-align: center;
     }
     .form-control{
       color:#000;
       text-align: center;
     }
     .form-group label{
       font-weight: bold;
     }
       .container-fluid{
           padding-bottom: 50px;
       }
       #FoncTable thead th{
         background-color: #fe4c50;
         color:white;
       }

   </style>
  @yield('style')

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('home')}}">
        <div class="sidebar-brand-icon ">

          <img    src="{{asset('img/favicon.jpg')}}"  width="70px" height="70px"/>
          <div class="sidebar-brand-text mx-3" style="font-size: 20px">GPAO</div>
        </div>

      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="{{route('Dashboard.index')}}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span style="font-size: 14px">Tableau De Bord</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div style="font-size: 12px" class="sidebar-heading text-white">
        Rapports
      </div>

      <!-- Nav Item - Contrôle Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" style="cursor: pointer"  data-toggle="collapse" data-target="#collapseContrôle" aria-expanded="true" aria-controls="collapseContrôle">
          <i class="fas fa-fw fa-eye"></i>
          <span  style="font-size: 16px">Contrôle</span>
        </a>
        <div id="collapseContrôle" class="collapse" aria-labelledby="headingContrôle" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded" >
            <h6 class="collapse-header">Rapports Journaliers:</h6>
            <a class="collapse-item" style="padding:.4rem 1rem" href="{{route('USDailyRep.index')}}">US Automatique</a>
            <a class="collapse-item" style="padding:.4rem 1rem" href="{{route('VisuelDailyRep.index')}}">Contrôle Visuel</a>
            <a class="collapse-item" style="padding:.4rem 1rem" href="{{route('RX1DailyRep.index')}}">Radiographie Numérique</a>
            <a class="collapse-item" style="padding:.4rem 1rem" href="{{route('NDTDailyRep.index')}}">UT Automatique</a>
            <a class="collapse-item" style="padding:.4rem 1rem" href="{{route('RX2DailyRep.index')}}">Radioscopique RX2</a>
            <a class="collapse-item" style="padding:.4rem 1rem" href="{{route('VFDailyRep.index')}}">Contrôle Visuel Final</a>
            <a class="collapse-item" style="padding:.4rem 1rem" href="{{route('VFRDailyRep.index')}}">Tubes Réfusés Au Final</a>
            <a class="collapse-item" style="padding:.4rem 1rem" href="{{route('RecDailyRep.index')}}">Réception</a>
            <a class="collapse-item" style="padding:.4rem 1rem" href="{{route('RevIntDailyRep.index')}}">Revêtement Intérieur</a>
            <a class="collapse-item" style="padding:.4rem 1rem" href="{{route('RevExtDailyRep.index')}}">Revêtement Extérieur</a>
            <a class="collapse-item" style="padding:.4rem 1rem" href="{{route('ExpDailyRep.index')}}">Expédiditon</a>
          </div>
        </div>
      </li>
      <!-- Nav Item - Fabrication Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" style="cursor: pointer" data-toggle="collapse" data-target="#collapseFabrication" aria-expanded="true" aria-controls="collapseFabrication">
          <i class="fas fa-fw fa-cog"></i>
          <span   style="font-size: 16px" >Fabrication</span>
        </a>
        <div id="collapseFabrication" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded"  >
            <h6 class="collapse-header ">Rapports Journaliers:</h6>
            <a class="collapse-item" style="padding:.4rem 1rem" href="{{route('RecBobDailyRep.index')}}">Réception Bobine</a>
            <a class="collapse-item" style="padding:.4rem 1rem" href="{{route('M3DailyRep.index')}}">Préparation Bobine</a>
            <a class="collapse-item" style="padding:.4rem 1rem" href="{{route('FabDailyRep.index')}}">Production</a>
            <a class="collapse-item" style="padding:.4rem 1rem" href="{{route('RepDailyRep.index')}}">Soudure Manuelle</a>
            <a class="collapse-item" style="padding:.4rem 1rem" href="{{route('M17DailyRep.index')}}">Chutage M17</a>
            <a class="collapse-item" style="padding:.4rem 1rem" href="{{route('M24DailyRep.index')}}">Test Hydrostatique M24</a>
            <a class="collapse-item" style="padding:.4rem 1rem" href="{{route('M25DailyRep.index')}}">Chanfreinage M25</a>
          </div>
        </div>
      </li>


      @if (isset(Auth::user()->role) && (strpos(Auth::user()->role,'Admin')!==false) )
      <!-- Nav Item - Gestion de l'application Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" style="cursor: pointer" data-toggle="collapse" data-target="#collapseGestion" aria-expanded="true" aria-controls="collapseGestion">
          <i class="fas fa-fw fa-eye"></i>
          <span  style="font-size: 16px">Gestion Générale</span>
        </a>
        <div id="collapseGestion" class="collapse" aria-labelledby="headingContrôle" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded" >
            <a class="collapse-item" style="padding:.4rem 1rem" href="{{route('projects.index')}}">Gestion Des Projets</a>
            <a class="collapse-item" style="padding:.4rem 1rem" href="{{route('details_project.index')}}">Détails Des Projets</a>
            <a class="collapse-item" style="padding:.4rem 1rem" href="{{route('clients.index')}}">Gestion des Clients</a>
            <a class="collapse-item" style="padding:.4rem 1rem" href="{{route('Defauts.index')}}">Gestion des Defauts</a>
            <a class="collapse-item" style="padding:.4rem 1rem" href="{{route('Operations.index')}}">Gestion des Opérations</a>
            <a class="collapse-item" style="padding:.4rem 1rem" href="{{route('affectations.index')}}">Affectation Des Agents</a>
            <a class="collapse-item" style="padding:.4rem 1rem" href="{{route('Locations.index')}}">Gestion Des Locations</a>
            <a class="collapse-item" style="padding:.4rem 1rem" href="{{route('agents.index')}}">Gestion Des Agents</a>
            <a class="collapse-item" style="padding:.4rem 1rem" href="{{route('users.index')}}">Gestion Des Utilisateurs</a>
          </div>
        </div>
      </li>
      @endif
    <!-- Divider -->

    @if(Auth::check() && Auth::user()->role == "Chef Production")
      <!-- Divider -->
        <hr class="sidebar-divider" style="margin-bottom: 0"><!-- Nav Item - Dashboard -->
        <li class="nav-item active">
          <a class="nav-link" href="{{route('ContRecBob.index')}}">
            <i class="fas fa-fw fa-vial"></i>
            <span style="font-size: 14px">Tests des Bobines</span></a>
        </li>

      @endif
      <hr class="sidebar-divider my-0">
      <li class="nav-item active">
        <a class="nav-link" href="{{route('ListeGlobale.index')}}">
          <i class="fas fa-fw fa-file"></i>
          <span style="font-size: 16px">Liste Globale</span></a>
      </li>
      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <button class="nav-link btn "  data-toggle="modal" data-target="#cardBackdrop" >
          <i class="fas fa-fw fa-file-invoice"></i>
          <span style="font-size: 16px">Carte Tube</span></button>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>


          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <b><span class="mr-2 d-none d-lg-inline text-gray-600 ">@if(\Illuminate\Support\Facades\Auth::check()){{\Illuminate\Support\Facades\Auth::user()->username}}@endif</span>
                <i class="fa fa-user-circle"></i></b>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

                <a class="dropdown-item" href="{{route('resetpassword')}}">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Changer Le Mot de Passe
                </a>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->
    @yield('content')

      </div>
      <!-- End of Main Content -->

      {{--<!-- Footer -->--}}
      {{--<div class="container-fluid">--}}
      {{--<footer class="sticky-footer  ">--}}
          {{--<div class="copyright  my-auto">--}}
          {{--<section>--}}
            {{--<div class="row ">--}}
              {{--<div class="top-content col-xl-6 col-lg-8 col-md-10 col-sm-12  offset-xl-4 offset-lg-3 offset-md-2 ">--}}
                {{--<div class="row ">--}}
                  {{--<img id="top-image" class="col-2 " src="{{asset('img/Login.png')}}">--}}
                  {{--<div class="col-10">--}}
                    {{--<h2>Projet : <b>{{$projet->Nom}}</b></h2>--}}
                    {{--<h4 style="text-align: inherit; color: #000;">Client : <b>{{$projet->client->name}}</b></h4>--}}
                    {{--<b  >Copyright © GPAO {{date('Y')}}</b>--}}
                  {{--</div>--}}
                {{--</div>--}}
                {{--<br>--}}

              {{--</div>--}}
            {{--</div>--}}
          {{--</section>--}}
          {{--</div>--}}
      {{--</footer>--}}
      {{--</div>--}}
      {{--<!-- End of Footer -->--}}

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  @include('layouts.CarteTubeLayout')
  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" role="button" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('js/jquery.min.js')}}"></script>
  <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('js/bootstrap-select.min.js')}}"></script>


  <!-- Core plugin JavaScript-->
  <script src="{{asset('js/jquery.easing.min.js')}}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{asset('js/sb-admin-2.min.js')}}"></script>
  <script src="{{asset('js/SortTable.js')}}"></script>
 @yield('script')
 <script>
     function calculateColumn(index) {
         var total = 0;
         $('table tbody tr[style*="display: table-row;"]').each(function() {

             var value =  Number($('td', this).eq(index).text());

             if (!isNaN(value)) {
                 total += value;
             }
         });

         $('table tfoot td').eq(index).html('<span class="text-danger"><b>' +(Math.round((total + Number.EPSILON) * 1000) / 1000 )+"</b></span>");
     }
 </script>

  @include('layouts.CarteTubeScript')
</body>

</html>
