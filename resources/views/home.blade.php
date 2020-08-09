@extends('layouts.app')
@section('style')
    <title>Page D'accueil</title>
    <style>

        .section-home{
            padding: 5px 0  ;
            text-align: center;
            margin: 0;
        }
        .section{
            padding: 0;

            height: 100%;
        }
        section{
            margin-top:5px !important;
        }
        a:hover{
            text-decoration: none;
        }
        .nav-link{

            padding: 5px;
        }
        body{
            background-color: #4e73df;
            background-image: linear-gradient(180deg,#4e73df 10%,#224abe 100%);
            background-size: cover;
        }
    </style>
    @endsection
@section('content')
<div class="container-fluid  " >
    <section class="row justify-content-end"> <a href="{{route('login')}}" class="nav-link">Connexion</a> </section>
    <br>
    <div class="row">
        <div class="col-lg-3 col-md-4 col-6 nav-link">
            <a href="{{route('rapports_RecBob.index')}}" class="section-home">  <section >
                Rapport De Réception Des Bobines
            </section></a>
        </div>
        <div class="col-lg-3 col-md-4 col-6 nav-link">
            <a href="{{route('rapports_M3.index')}}" class="section-home">  <section >
                    Rapport De Préparation Des Bobines
                </section></a>
        </div>
        <div class="col-lg-3 col-md-4 col-6 nav-link">
            <a href="{{route('rapports.index')}}" class="section-home">  <section >
                    Rapport De Production
                </section></a>
        </div>
        <div class="col-lg-3 col-md-4 col-6 nav-link">
            <a href="{{route('rapports_Ultrason.index')}}" class="section-home">  <section >
                    Rapport US Automatique
                </section></a>
        </div>
        <div class="col-lg-3 col-md-4 col-6 nav-link">
            <a href="{{route('rapports_visuels.index')}}" class="section-home">  <section >
                    Rapport De Contrôle Visuel
                </section></a>
        </div>
        <div class="col-lg-3 col-md-4 col-6 nav-link">
            <a href="{{route('rapports_RX1.index')}}" class="section-home">  <section >
                    Rapport De Contrôle Radiographie Numérique
                </section></a>
        </div>
        <div class="col-lg-3 col-md-4 col-6 nav-link">
            <a href="{{route('rapports_Rep.index')}}" class="section-home">  <section >
                    Rapport De Soudure Manuelle
                </section></a>
        </div>
        <div class="col-lg-3 col-md-4 col-6 nav-link">
            <a href="{{route('rapports_M17.index')}}" class="section-home">  <section >
                    Rapport De Chutage
                </section></a>
        </div>
        <div class="col-lg-3 col-md-4 col-6 nav-link">
            <a href="{{route('rapports_M24.index')}}" class="section-home">  <section >
                    Rapport De Test Hydrostatique
                </section></a>
        </div>
        <div class="col-lg-3 col-md-4 col-6 nav-link">
            <a href="{{route('rapports_M25.index')}}" class="section-home">  <section >
                    Rapport De Chanfreinage
                </section></a>
        </div>
        <div class="col-lg-3 col-md-4 col-6 nav-link">
            <a href="{{route('rapports_Ndt.index')}}" class="section-home">  <section >
                    Rapport De Contrôle UT Automatique
                </section></a>
        </div>
        <div class="col-lg-3 col-md-4 col-6 nav-link">
            <a href="{{route('rapports_RX2.index')}}" class="section-home">  <section >
                    Rapport De Contrôle Radioscopique
                </section></a>
        </div>
        <div class="col-lg-3 col-md-4 col-6 nav-link">
            <a href="{{route('rapports_VisuelFinal.index')}}" class="section-home">  <section >
                    Rapport De Contrôle Visuel Final
                </section></a>
        </div>
        <div class="col-lg-3 col-md-4 col-6 nav-link">
            <a href="{{route('rapports_VFRefuses.index')}}" class="section-home">  <section >
                    Rapport Des Tubes Réfusés Au Final
                </section></a>
        </div>
        <div class="col-lg-3 col-md-4 col-6 nav-link">
            <a href="{{route('rapports_Reception.index')}}" class="section-home">  <section >
                    Rapport De Réception
                </section></a>
        </div>
        <div class="col-lg-3 col-md-4 col-6 nav-link">
            <a href="{{route('rapports_RevInt.index')}}" class="section-home">  <section >
                    Rapport De Revêtement Intérieur
                </section></a>
        </div>
        <div class="col-lg-3 col-md-4 col-6 nav-link">
            <a href="{{route('rapports_RevExt.index')}}" class="section-home">  <section >
                    Rapport De Revêtement Extérieur
                </section></a>
        </div>
        <div class="col-lg-3 col-md-4 col-6 nav-link">
            <a href="{{route('rapports_Expedition.index')}}" class="section-home">  <section >
                    Rapport D'Expédition
                </section></a>
        </div>
    </div>
</div>

@endsection
@section('script')
    @endsection