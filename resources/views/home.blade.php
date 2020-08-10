@extends('layouts.app')
@section('style')
    <title>Page D'accueil</title>
    <style>

        .section-home {
            padding: 5px 0;
            text-align: center;
            margin: 0;

        }

        .section {
            padding: 0;

            height: 100%;
        }

        section {
            margin-top: 5px !important;
            /* border: 0;
             border:5px solid #1c294e;*/
            height: 100px;
        }

        a:hover {
            text-decoration: none;
        }

        .nav-link {

            padding: 5px;
        }

        .nav {
            background-color: #fff;
        }

        .nav .nav-link {
            min-height: 50px;
            height: 100%;
            font-size: 20px;
            text-align: center;
        }


        #thumbs {
            margin: 0;
            padding: 0;
        }

        #thumbs li {
            list-style-type: none;
            margin-top: 5px;
            background-color: transparent;
            padding: 0  ;
            box-shadow: 0 1.75rem 1.75rem 0 rgba(58, 59, 69, .15) !important;
        }

        .item-thumbs {
            position: relative;
            overflow: hidden;
            margin-bottom: 30px;
            cursor: pointer;
        }

        .item-thumbs a {
            width: 100%;
            height: 170px;
        }

        .item-thumbs img {
            width: 104%;
            height: 170px;
        }

        .item-thumbs .hover-wrap {
            position: absolute;
            display: block;
            width: 100%;
            height: 100%;
        }

        .item-thumbs .hover-wrap .overlay-img {
            position: absolute;
            width: 100%;
            height: 100%;
            background: #111;

            opacity: 0.70;
            filter: alpha(opacity=70);
        }

        .item-thumbs .hover-wrap .overlay-img-thumb {
            position: absolute;
            width: 100%;
            top: 50%;
            text-align: center;
            vertical-align: middle;
            color: #fee715;
            font-size: 1.6em;
            /*line-height: 1.5em;*/
            transform: translateY(-50%);
            opacity: 1;
            filter: alpha(opacity=100);
        }


    </style>
@endsection
@section('content')
    <div class="container-fluid  ">

        <nav class="navbar navbar-light bg-white border-bottom-primary">
            <a class="navbar-brand nav-link text-primary" href="{{route('home')}}">
                <img src="{{asset('img/Login.jpg')}}" width="30" height="30" class="d-inline-block align-top"  >
                Gestion De La Production Assistée Par Ordinateur
            </a>
            <a href="{{route('login')}}" class="nav-item nav-link active ml-auto  " style="font-size: 20px">Connexion</a>
        </nav>
        <br>

        <nav  >
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active col-sm-12 col-md-6 " id="nav-production-tab" data-toggle="tab"
                   href="#nav-production"
                   role="tab" aria-controls="nav-production" aria-selected="true">Rapports De Contrôle Production</a>
                <a class="nav-item nav-link nav-qualite col-sm-12 col-md-6 " id="nav-qualite-tab" data-toggle="tab"
                   href="#nav-qualite" role="tab"
                   aria-controls="" aria-selected="false">Rapports De Contrôle Qualité</a>
            </div>
        </nav>
        <div class="tab-content bg-white" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-production" role="tabpanel"
                 aria-labelledby="nav-production-tab">
                <div class="row" id="thumbs">
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <li class="item-thumbs span3 design  nav-link">

                            <a class="hover-wrap fancybox" data-fancybox-group="gallery"
                               title="Rapport De Réception Des Bobines" href="{{route('rapports_RecBob.index')}}">
                                <span class="overlay-img"></span>
                                <span class="overlay-img-thumb font-icon-plus">Rapport De Réception Des Bobines</span>
                            </a>
                            <img src="{{asset('img/home/RecBob.jpg')}}" alt="Lorem ">
                        </li>

                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <li class="item-thumbs span3 design  nav-link">
                            <a class="hover-wrap fancybox" data-fancybox-group="gallery"
                               title="Rapport De Préparation Des Bobines" href="{{route('rapports_M3.index')}}">
                                <span class="overlay-img"></span>
                                <span class="overlay-img-thumb font-icon-plus">Rapport De Préparation Des Bobines</span>
                            </a>
                            <img src="{{asset('img/home/PrepBob.jpg')}}" alt="Lorem ">
                        </li>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <li class="item-thumbs span3 design  nav-link">
                            <a class="hover-wrap fancybox" data-fancybox-group="gallery" title="Rapport De Production"
                               href="{{route('rapports.index')}}">
                                <span class="overlay-img"></span>
                                <span class="overlay-img-thumb font-icon-plus">Rapport De Production</span>
                            </a>
                            <img src="{{asset('img/home/PRod.jpg')}}" alt="Lorem ">
                        </li>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <li class="item-thumbs span3 design  nav-link">
                            <a class="hover-wrap fancybox" data-fancybox-group="gallery"
                               title="Rapport De Soudure Manuelle"
                               href="{{route('rapports_Rep.index')}}">
                                <span class="overlay-img"></span>
                                <span class="overlay-img-thumb font-icon-plus">Rapport De Soudure Manuelle</span>
                            </a>
                            <img src="{{asset('img/home/Rep.jpg')}}" alt="Lorem ">
                        </li>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <li class="item-thumbs span3 design  nav-link">
                            <a class="hover-wrap fancybox" data-fancybox-group="gallery" title="Rapport De Chutage"
                               href="{{route('rapports_M17.index')}}">
                                <span class="overlay-img"></span>
                                <span class="overlay-img-thumb font-icon-plus">Rapport De Chutage</span>
                            </a>
                            <img src="{{asset('img/home/Chutage.jpg')}}" alt="Lorem ">
                        </li>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <li class="item-thumbs span3 design  nav-link">
                            <a class="hover-wrap fancybox" data-fancybox-group="gallery"
                               title="Rapport De Test Hydrostatique"
                               href="{{route('rapports_M24.index')}}">
                                <span class="overlay-img"></span>
                                <span class="overlay-img-thumb font-icon-plus">Rapport De Test Hydrostatique</span>
                            </a>
                            <img src="{{asset('img/home/Hyd.jpg')}}" alt="Lorem ">
                        </li>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <li class="item-thumbs span3 design  nav-link">
                            <a class="hover-wrap fancybox" data-fancybox-group="gallery" title="Rapport De Chanfreinage"
                               href="{{route('rapports_M25.index')}}">
                                <span class="overlay-img"></span>
                                <span class="overlay-img-thumb font-icon-plus">Rapport De Chanfreinage</span>
                            </a>
                            <img src="{{asset('img/home/Chanf.jpg')}}" alt="Lorem ">
                        </li>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <li class="item-thumbs span3 design  nav-link">
                            <a class="hover-wrap fancybox" data-fancybox-group="gallery" title="
                                Rapport De Fonctionnement D'Atelier PE"
                               href="{{route('rapports_FoncRevInt.index')}}">
                                <span class="overlay-img"></span>
                                <span class="overlay-img-thumb font-icon-plus">
                                Rapport De Fonctionnement D'Atelier PE</span>
                            </a>
                            <img src="{{asset('img/home/PE.jpg')}}" alt="Lorem ">
                        </li>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <li class="item-thumbs span3 design  nav-link">
                            <a class="hover-wrap fancybox" data-fancybox-group="gallery" title="
                                Rapport De Fonctionnement D'Atelier EPOXY"
                               href="{{route('rapports_FoncRevExt.index')}}">
                                <span class="overlay-img"></span>
                                <span class="overlay-img-thumb font-icon-plus">
                                Rapport De Fonctionnement D'Atelier EPOXY</span>
                            </a>
                            <img src="{{asset('img/home/EPOXY.jpg')}}" alt="Lorem ">
                        </li>
                    </div>
                </div>

            </div>
            <div class="tab-pane fade" id="nav-qualite" role="tabpanel" aria-labelledby="nav-qualite-tab">
                <div class="row" id="thumbs">

                    <div class="col-lg-3 col-md-4 col-sm-6">
                    <li class="item-thumbs span3 design  nav-link">
                        <a class="hover-wrap fancybox" data-fancybox-group="gallery" title="
                                Rapport US Automatique"
                           href="{{route('rapports_Ultrason.index')}}">
                            <span class="overlay-img"></span>
                            <span class="overlay-img-thumb font-icon-plus">
                                Rapport US Automatique</span>
                        </a>
                        <img src="{{asset('img/home/US.jpg')}}" alt="Lorem ">
                    </li>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                    <li class="item-thumbs span3 design  nav-link">
                        <a class="hover-wrap fancybox" data-fancybox-group="gallery" title="
                                Rapport De Contrôle Visuel"
                           href="{{route('rapports_visuels.index')}}">
                            <span class="overlay-img"></span>
                            <span class="overlay-img-thumb font-icon-plus">
                                Rapport De Contrôle Visuel</span>
                        </a>
                        <img src="{{asset('img/home/Vis.jpg')}}" alt="Lorem ">
                    </li>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                    <li class="item-thumbs span3 design  nav-link">
                        <a class="hover-wrap fancybox" data-fancybox-group="gallery" title="
                                Rapport De Contrôle Radiographie Numérique"
                           href="{{route('rapports_RX1.index')}}">
                            <span class="overlay-img"></span>
                            <span class="overlay-img-thumb font-icon-plus">
                                Rapport De Contrôle Radiographie Numérique</span>
                        </a>
                        <img src="{{asset('img/home/RX1.jpg')}}" alt="Lorem ">
                    </li>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                    <li class="item-thumbs span3 design  nav-link">
                        <a class="hover-wrap fancybox" data-fancybox-group="gallery" title="
                                Rapport De Contrôle UT Automatique"
                           href="{{route('rapports_Ndt.index')}}">
                            <span class="overlay-img"></span>
                            <span class="overlay-img-thumb font-icon-plus">
                                Rapport De Contrôle UT Automatique</span>
                        </a>
                        <img src="{{asset('img/home/ndt.jpg')}}" alt="Lorem ">
                    </li>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                    <li class="item-thumbs span3 design  nav-link">
                        <a class="hover-wrap fancybox" data-fancybox-group="gallery" title="
                                Rapport De Contrôle Radioscopique"
                           href="{{route('rapports_RX2.index')}}">
                            <span class="overlay-img"></span>
                            <span class="overlay-img-thumb font-icon-plus">
                                Rapport De Contrôle Radioscopique</span>
                        </a>
                        <img src="{{asset('img/home/RX1.jpg')}}" alt="Lorem ">
                    </li>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                    <li class="item-thumbs span3 design  nav-link">
                        <a class="hover-wrap fancybox" data-fancybox-group="gallery" title="
                                Rapport De Contrôle Visuel Final"
                           href="{{route('rapports_VisuelFinal.index')}}">
                            <span class="overlay-img"></span>
                            <span class="overlay-img-thumb font-icon-plus">
                                Rapport De Contrôle Visuel Final</span>
                        </a>
                        <img src="{{asset('img/home/VF.jpg')}}" alt="Lorem ">
                    </li>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                    <li class="item-thumbs span3 design  nav-link">
                        <a class="hover-wrap fancybox" data-fancybox-group="gallery" title="
                                Rapport Des Tubes Réfusés Au Final"
                           href="{{route('rapports_VFRefuses.index')}}">
                            <span class="overlay-img"></span>
                            <span class="overlay-img-thumb font-icon-plus">
                                Rapport Des Tubes Réfusés Au Final</span>
                        </a>
                        <img src="{{asset('img/home/VFR.jpg')}}" alt="Lorem ">
                    </li>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                    <li class="item-thumbs span3 design  nav-link">
                        <a class="hover-wrap fancybox" data-fancybox-group="gallery" title="
                                Rapport De Réception"
                           href="{{route('rapports_Reception.index')}}">
                            <span class="overlay-img"></span>
                            <span class="overlay-img-thumb font-icon-plus">
                                Rapport De Réception</span>
                        </a>
                        <img src="{{asset('img/home/Rec.webp')}}" alt="Lorem ">
                    </li>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                    <li class="item-thumbs span3 design  nav-link">
                        <a class="hover-wrap fancybox" data-fancybox-group="gallery" title="
                                Rapport De Revêtement Intérieur"
                           href="{{route('rapports_RevInt.index')}}">
                            <span class="overlay-img"></span>
                            <span class="overlay-img-thumb font-icon-plus">
                                Rapport De Revêtement Intérieur</span>
                        </a>
                        <img src="{{asset('img/home/PE.jpg')}}" alt="Lorem ">
                    </li>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                    <li class="item-thumbs span3 design  nav-link">
                        <a class="hover-wrap fancybox" data-fancybox-group="gallery" title="
                                Rapport De Revêtement Extérieur"
                           href="{{route('rapports_RevExt.index')}}">
                            <span class="overlay-img"></span>
                            <span class="overlay-img-thumb font-icon-plus">
                                Rapport De Revêtement Extérieur</span>
                        </a>
                        <img src="{{asset('img/home/EPOXY.jpg')}}" alt="Lorem ">
                    </li>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                    <li class="item-thumbs span3 design  nav-link">
                        <a class="hover-wrap fancybox" data-fancybox-group="gallery" title="
                                Rapport D'Expédition"
                           href="{{route('rapports_Expedition.index')}}">
                            <span class="overlay-img"></span>
                            <span class="overlay-img-thumb font-icon-plus">
                                Rapport D'Expédition</span>
                        </a>
                        <img src="{{asset('img/home/Exp.jpg')}}" alt="Lorem ">
                    </li>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        $(document).ready(function () {

            $('#title-section').remove();
        });
    </script>
@endsection