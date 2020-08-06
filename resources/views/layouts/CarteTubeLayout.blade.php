<div class="modal fade" id="cardBackdrop" data-backdrop="static" tabindex="-1" role="dialog"
     style="padding-right: 0"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  " role="document" id="CarteTubeModal" >
        <div class="modal-content " style="overflow: auto;   ">
            <div class="modal-header bg-gradient-light ">
                <div class="col-10 modal-title">
                    <div class="row">
                        <h3 class="text-center col-md-2 col-12 text-primary"><b>CARTE TUBE</b></h3>
                    <div class="col-lg-6 col-md-6 col-sm-8">
                        <div class="form-group ">
                            <label class="col-lg-12" style="padding-left: 0" for="CTDid">Detail Projet</label>
                            <select class="form-control col-12" id="CTDid" name="CTDid">
                                <option disabled selected></option>
                                @if(isset($details))
                                @foreach($details as $detail)
                                    <option value="{{$detail->Did}}">{{$detail->Nom}} -- Epais: {{$detail->Epaisseur}} mm -Diam : {{$detail->Diametre}}mm</option>
                                @endforeach
                                    @endif
                            </select>
                        </div>
                    </div>

                    <div class="form-group  col-md-3 col-sm-4   ">
                        <label class="col-12" for="CTTube" >N° Tube : </label>

                        <input class="form-control col-12  "   type="text" autocomplete="off"
                               id="CTTube"    name="CTTube" value="" list="CTTubes"  required>
                        <datalist id="CTTubes" >

                        </datalist>

                    </div>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"> <button data-dismiss="modal"
                                                              class="btn btn-danger"><b>X</b></button></span>
                </button>
            </div>
            <div class="modal-body " style="background-color: #eee; ">
                <div class="row">
                    <div class="table-container col-12">
                    <table class="col-12 table table-borderless bg-white" id="CarteTubeTable"  >
                        <thead></thead>
                        <tbody>
                        <tr>
                            <td>Fournisseur: <span class="TCVal" id="Fournisseur"></span></td>
                            <td>N°Coulee: <span class="TCVal" id="Coulee"></span></td>
                            <td>N°Bobine: <span class="TCVal" id="Bobine"></span></td>
                            <td>Longueur Fab: <span class="TCVal" id="LongueurFab"></span></td>
                            <td>Date Fab: <span class="TCVal" id="DateFab"></span></td>
                        </tr>
                        </tbody>
                    </table>
                    </div>
                    <div class="col-md-6">

                        <div class="col-12">
                            <!-- Collapse Panel 1--><a data-toggle="collapse" href="#VisuelCollapse" role="button" aria-expanded="true" aria-controls="VisuelCollapse" class="btn CTCollapse btn-block  shadow-sm with-chevron">
                                <p class="d-flex align-items-center justify-content-between mb-0 px-3 "><strong class="text-uppercase   text-center ">Controle visuel</strong><i class="fa fa-angle-down"></i></p>
                            </a>
                            <div id="VisuelCollapse" class="collapse shadow-sm show">
                                <div class="card">
                                    <div class="card-body">
                                        <p class="font-italic mb-0 text-muted">
                                        <table class="col-12 table table-borderless bg-white" id="CarteTubeTable"  >
                                            <thead></thead>
                                            <tbody id="visuels">

                                            </tbody>
                                        </table>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <!-- Collapse Panel 1--><a data-toggle="collapse" href="#RX1Collapse" role="button" aria-expanded="true" aria-controls="RX1Collapse" class="btn CTCollapse  btn-block  shadow-sm with-chevron">
                                <p class="d-flex align-items-center justify-content-between mb-0 px-3 "><strong class="text-uppercase   text-center ">RX1</strong><i class="fa fa-angle-down"></i></p>
                            </a>
                            <div id="RX1Collapse" class="collapse shadow-sm show">
                                <div class="card">
                                    <div class="card-body">
                                        <p class="font-italic mb-0 text-muted">
                                        <table class="col-12 table table-borderless bg-white" id="CarteTubeTable"  >
                                            <thead></thead>
                                            <tbody id="RX1">


                                            </tbody>
                                        </table>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <!-- Collapse Panel 1--><a data-toggle="collapse" href="#RepCollapse" role="button" aria-expanded="true" aria-controls="RepCollapse" class="btn CTCollapse  btn-block  shadow-sm with-chevron">
                                <p class="d-flex align-items-center justify-content-between mb-0 px-3 "><strong class="text-uppercase   text-center ">Réparation</strong><i class="fa fa-angle-down"></i></p>
                            </a>
                            <div id="RepCollapse" class="collapse shadow-sm show">
                                <div class="card">
                                    <div class="card-body">
                                        <p class="font-italic mb-0 text-muted">
                                        <table class="col-12 table table-borderless bg-white" id="CarteTubeTable"  >
                                            <thead></thead>
                                            <tbody id="Reps">

                                            </tbody>
                                        </table>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <!-- Collapse Panel 1--><a data-toggle="collapse" href="#M17Collapse" role="button" aria-expanded="true" aria-controls="M17Collapse" class="btn CTCollapse  btn-block  shadow-sm with-chevron">
                                <p class="d-flex align-items-center justify-content-between mb-0 px-3 "><strong class="text-uppercase   text-center ">M17</strong><i class="fa fa-angle-down"></i></p>
                            </a>
                            <div id="M17Collapse" class="collapse shadow-sm show">
                                <div class="card">
                                    <div class="card-body">
                                        <p class="font-italic mb-0 text-muted">
                                        <table class="col-12 table table-borderless bg-white" id="CarteTubeTable"  >
                                            <thead></thead>
                                            <tbody id="M17s">

                                            </tbody>
                                        </table>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="col-12">
                        <!-- Collapse Panel 1--><a data-toggle="collapse" href="#M24Collapse" role="button" aria-expanded="true" aria-controls="M24Collapse" class="btn CTCollapse  btn-block  shadow-sm with-chevron">
                            <p class="d-flex align-items-center justify-content-between mb-0 px-3 "><strong class="text-uppercase   text-center ">M24</strong><i class="fa fa-angle-down"></i></p>
                        </a>
                        <div id="M24Collapse" class="collapse shadow-sm show">
                            <div class="card">
                                <div class="card-body">
                                    <p class="font-italic mb-0 text-muted">
                                    <table class="col-12 table table-borderless bg-white" id="CarteTubeTable"  >
                                        <thead></thead>
                                        <tbody id="M24s">


                                        </tbody>
                                    </table>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <!-- Collapse Panel 1--><a data-toggle="collapse" href="#M25Collapse" role="button" aria-expanded="true" aria-controls="M25Collapse" class="btn CTCollapse  btn-block  shadow-sm with-chevron">
                            <p class="d-flex align-items-center justify-content-between mb-0 px-3 "><strong class="text-uppercase   text-center ">M25</strong><i class="fa fa-angle-down"></i></p>
                        </a>
                        <div id="M25Collapse" class="collapse shadow-sm show">
                            <div class="card">
                                <div class="card-body">
                                    <p class="font-italic mb-0 text-muted">
                                    <table class="col-12 table table-borderless bg-white" id="CarteTubeTable"  >
                                        <thead></thead>
                                        <tbody id="M25s">


                                        </tbody>
                                    </table>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <!-- Collapse Panel 1--><a data-toggle="collapse" href="#NDTCollapse" role="button" aria-expanded="true" aria-controls="NDTCollapse" class="btn CTCollapse  btn-block  shadow-sm with-chevron">
                            <p class="d-flex align-items-center justify-content-between mb-0 px-3 "><strong class="text-uppercase   text-center ">NDT</strong><i class="fa fa-angle-down"></i></p>
                        </a>
                        <div id="NDTCollapse" class="collapse shadow-sm show">
                            <div class="card">
                                <div class="card-body">
                                    <p class="font-italic mb-0 text-muted">
                                    <table class="col-12 table table-borderless bg-white" id="CarteTubeTable"  >
                                        <thead></thead>
                                        <tbody id="NDT">


                                        </tbody>
                                    </table>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <!-- Collapse Panel 1--><a data-toggle="collapse" href="#RX2Collapse" role="button" aria-expanded="true" aria-controls="RX2Collapse" class="btn CTCollapse  btn-block  shadow-sm with-chevron">
                            <p class="d-flex align-items-center justify-content-between mb-0 px-3 "><strong class="text-uppercase   text-center ">RX2</strong><i class="fa fa-angle-down"></i></p>
                        </a>
                        <div id="RX2Collapse" class="collapse shadow-sm show">
                            <div class="card">
                                <div class="card-body">
                                    <p class="font-italic mb-0 text-muted">
                                    <table class="col-12 table table-borderless bg-white" id="CarteTubeTable"  >
                                        <thead></thead>
                                        <tbody id="RX2">


                                        </tbody>
                                    </table>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="col-12">
                        <!-- Collapse Panel 1--><a data-toggle="collapse" href="#VFCollapse" role="button" aria-expanded="true" aria-controls="VFCollapse" class="btn CTCollapse  btn-block  shadow-sm with-chevron">
                            <p class="d-flex align-items-center justify-content-between mb-0 px-3 "><strong class="text-uppercase   text-center ">Visuel Final</strong><i class="fa fa-angle-down"></i></p>
                        </a>
                        <div id="VFCollapse" class="collapse shadow-sm show">
                            <div class="card">
                                <div class="card-body">
                                    <p class="font-italic mb-0 text-muted">
                                    <table class="col-12 table table-borderless bg-white" id="CarteTubeTable"  >
                                        <thead></thead>
                                        <tbody id="VF">


                                        </tbody>
                                    </table>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="col-12" id="VFRRoot" >
                        <!-- Collapse Panel 1--><a data-toggle="collapse" href="#VFRCollapse" role="button" aria-expanded="true" aria-controls="VFRCollapse" class="btn CTCollapse  btn-block  shadow-sm with-chevron">
                            <p class="d-flex align-items-center justify-content-between mb-0 px-3 "><strong class="text-uppercase   text-center ">Visuel Final Refuses</strong><i class="fa fa-angle-down"></i></p>
                        </a>
                        <div id="VFRCollapse" class="collapse shadow-sm show">
                            <div class="card">
                                <div class="card-body">
                                    <p class="font-italic mb-0 text-muted">
                                    <table class="col-12 table table-borderless bg-white" id="CarteTubeTable"  >
                                        <thead></thead>
                                        <tbody id="VFR">


                                        </tbody>
                                    </table>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12" id="ReceptionRoot" >
                        <!-- Collapse Panel 1--><a data-toggle="collapse" href="#RecCollapse" role="button" aria-expanded="true" aria-controls="RecCollapse" class="btn CTCollapse  btn-block  shadow-sm with-chevron">
                            <p class="d-flex align-items-center justify-content-between mb-0 px-3 "><strong class="text-uppercase   text-center ">Reception</strong><i class="fa fa-angle-down"></i></p>
                        </a>
                        <div id="RecCollapse" class="collapse shadow-sm show">
                            <div class="card">
                                <div class="card-body">
                                    <p class="font-italic mb-0 text-muted">
                                    <table class="col-12 table table-borderless bg-white" id="CarteTubeTable"  >
                                        <thead></thead>
                                        <tbody id="Rec">


                                        </tbody>
                                    </table>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12" id="RevIntRoot" >
                        <!-- Collapse Panel 1--><a data-toggle="collapse" href="#RevIntCollapse" role="button" aria-expanded="true" aria-controls="RevIntCollapse" class="btn CTCollapse  btn-block  shadow-sm with-chevron">
                            <p class="d-flex align-items-center justify-content-between mb-0 px-3 "><strong class="text-uppercase   text-center ">Revêtement Interieur</strong><i class="fa fa-angle-down"></i></p>
                        </a>
                        <div id="RevIntCollapse" class="collapse shadow-sm show">
                            <div class="card">
                                <div class="card-body">
                                    <p class="font-italic mb-0 text-muted">
                                    <table class="col-12 table table-borderless bg-white" id="CarteTubeTable"  >
                                        <thead></thead>
                                        <tbody id="RevInt">


                                        </tbody>
                                    </table>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="col-12" id="RevExtRoot" >
                        <!-- Collapse Panel 1--><a data-toggle="collapse" href="#RevExtCollapse" role="button" aria-expanded="true" aria-controls="RevExtCollapse" class="btn CTCollapse  btn-block  shadow-sm with-chevron">
                            <p class="d-flex align-items-center justify-content-between mb-0 px-3 "><strong class="text-uppercase   text-center ">Revêtement Exterieur</strong><i class="fa fa-angle-down"></i></p>
                        </a>
                        <div id="RevExtCollapse" class="collapse shadow-sm show">
                            <div class="card">
                                <div class="card-body">
                                    <p class="font-italic mb-0 text-muted">
                                    <table class="col-12 table table-borderless bg-white" id="CarteTubeTable"  >
                                        <thead></thead>
                                        <tbody id="RevExt">


                                        </tbody>
                                    </table>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12" id="ExpeditionRoot" >
                        <!-- Collapse Panel 1--><a data-toggle="collapse" href="#ExpCollapse" role="button" aria-expanded="true" aria-controls="ExpCollapse" class="btn CTCollapse  btn-block  shadow-sm with-chevron">
                            <p class="d-flex align-items-center justify-content-between mb-0 px-3 "><strong class="text-uppercase   text-center ">Expédition</strong><i class="fa fa-angle-down"></i></p>
                        </a>
                        <div id="ExpCollapse" class="collapse shadow-sm show">
                            <div class="card">
                                <div class="card-body">
                                    <p class="font-italic mb-0 text-muted">
                                    <table class="col-12 table table-borderless bg-white" id="CarteTubeTable"  >
                                        <thead></thead>
                                        <tbody id="Expedition">


                                        </tbody>
                                    </table>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</div>


