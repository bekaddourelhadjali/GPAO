<div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  " role="document" id="ArretsModal">
        <section>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Arrets Machine</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"> <button data-dismiss="modal"
                                                              onclick="$('#arretForm').trigger('reset')"
                                                              class="btn btn-danger"><b>X</b></button></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="arretForm" autocomplete="off">
                        <div class="row">
                            <div class="col-xl-2 col-lg-2 col-md-4 col-6">
                                <div class="form-group row">
                                    <label class="col-12" for="type_arret">Type D'arrêt</label>
                                    <select class="form-control col-10" id="type_arret" name="type_arret" required  >
                                        <option value="" disabled selected></option>
                                        <option value="P1">P1</option>
                                        <option value="P3">P3</option>
                                        <option value="P4">P4</option>
                                        <option value="RB">RB</option>
                                        <option value="FAB">FAB</option>
                                        <option value="Arret">Arret</option>
                                        <option value="Autres">Autres</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-8 col-6">
                                <div class="form-group row">
                                    <label class="col-12" for="cause">Cause</label>
                                    <input class="form-control col-12" id="cause" name="cause" required>
                                    <datalist id="panneP1List">
                                        <option value="PE">PE</option>
                                        <option value="PH">PH</option>
                                        <option value="PM">PM</option>
                                        <option value="PO">PO</option>
                                        <option value="Autre">Autre</option>
                                    </datalist>
                                    <datalist id="pannesList">
                                        <option value="Pause NDT">Pause NDT</option>
                                        <option value="RX1">RX1</option>
                                        <option value="Manque Bobine/flux">Manque Bobine/flux</option>
                                        <option value="Air comp/Man,D'eau">Air comp/Man,D'eau</option>
                                        <option value="NJ">NJ</option>
                                        <option value="CO2">CO2</option>
                                        <option value="Fin com">Fin com</option>
                                        <option value="R.pos/Manu">R.pos/Manu</option>
                                        <option value="Manque Oxyc">Manque Oxyc</option>
                                        <option value="Manque Elec">Manque Elec</option>
                                        <option value="Apsent">Apsent</option>
                                        <option value="Manque Charge">Manque Charge</option>
                                        <option value="RSA">RSA</option>
                                        <option value="AVAL">AVAL</option>
                                        <option value="Chandiam">Chandiam</option>
                                        <option value="Chang Joint">Chang Joint</option>
                                        <option value="Netoyage Zone">Netoyage Zone</option>
                                        <option value="Equipe Rég">Equipe Rég</option>
                                        <option value="Préparation Machine">Préparation Machine</option>
                                        <option value="CH .EP">CH .EP</option>
                                    </datalist>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-6 col-8">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group  ">
                                            <label class="col-12" for="du">Du</label>
                                            <input class="col-12 form-control" type="time" id="du" name="du" value="00:00"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group  ">
                                            <label class="col-12" for="au">Au</label>
                                            <input class="col-12 form-control" type="time" id="au" name="au" value="00:00"
                                                   required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-1 col-lg-1 col-md-2 col-4">
                                <div class="form-group row">
                                    <label class="col-12" for="duree">Durée(m)</label>
                                    <input class="col-10 form-control" type="number" id="duree" name="duree" min="1" value="" required>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-2 col-md-3 col-4">
                                <div class="form-group row">
                                    <label class="col-12" for="ndi">N°DI</label>
                                    <input class="col-10 form-control" type="number" id="ndi" name="ndi" value="">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-8">
                                <div class="form-group row">
                                    <label class="col-12" for="obs">Obs</label>
                                    <input class="col-11 form-control" type="text" id="obs" name="obs" value="">
                                </div>
                            </div>
                            <div class="col-xl-1 col-lg-1 col-md-2 col-5 ">
                                <div class="col-12">
                                    <label class="col-12"> &nbsp;</label>
                                    <button type="reset" class="btn btn-secondary"  id="annulerPanne"> Annuler</button>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-4 col-7">
                                <div class="col-10"><label class="col-12"> &nbsp;</label>
                                </div>
                                <button class="col-10 btn btn-success offset-2" type="button" type="submit" id="ajouterPanne">
                                    Ajouter panne
                                </button>
                            </div>
                        </div>


                    </form>
                    <hr>
                    <div class="table-container">
                        <table class="table table-striped table-hover table-borderless" id="ArretTable">
                            <thead class="bg-primary text-white">
                            <tr>
                                <th>Type Arret</th>
                                <th>Du</th>
                                <th>Au</th>
                                <th>Duree</th>
                                <th>Cause</th>
                                <th>N°DI</th>
                                <th>Obs</th>

                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($arrets))
                                @foreach($arrets as $arret)
                                    <tr id="arret{{$arret->id}}">
                                        <td id="type{{$arret->id}}">{{$arret->TypeArret}}</td>
                                        <td id="du{{$arret->id}}">{{$arret->Du}}</td>
                                        <td id="au{{$arret->id}}">{{$arret->Au}}</td>
                                        <td id="duree{{$arret->id}}">{{$arret->Durée}}</td>
                                        <td id="cause{{$arret->id}}">{{$arret->Cause}}</td>
                                        <td id="ndi{{$arret->id}}"> {{$arret->NDI}}</td>
                                        <td id="obs{{$arret->id}}">{{$arret->Obs}}</td>
                                        <td>
                                            <button id="arret{{$arret->id}}Edit" class="arretEdit text-primary"><i
                                                        class="fa fa-edit"></i></button>
                                            <button id="arret{{$arret->id}}Delete" class="arretDelete text-danger"><i
                                                        class="fa fa-trash"></i></button>
                                        </td>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>