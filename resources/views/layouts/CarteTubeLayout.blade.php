<div class="modal fade" id="cardBackdrop" data-backdrop="static" tabindex="-1" role="dialog"
     style="padding-right: 0"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  " role="document" id="CarteTubeModal">
        <div class="modal-content " style="overflow: auto;   ">
            <div class="modal-header  ">
                <div class="col-10 modal-title">

                    <div class="input-group mb-3">
                        <label class="col-12 col-md-6 text-success "
                               style="margin-bottom:0; font-size: 25px; font-weight: bolder">CARTE TUBE : <span
                                    id="tubeTop"></span></label>

                        <div class="input-group-prepend  ">
                            <span class="input-group-text text-dark">N° Tube :</span>
                        </div>
                        <input class="form-control col-4 col-sm-4  " pattern="[A-Z]\d{4}" type="text"
                               id="tubeCard"
                               pattern="[A-Z]\d{4}" name="tubeCard" value="" maxlength="5" minlength="5"
                               required>
                    </div>

                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"> <button data-dismiss="modal"
                                                              onclick="$('#arretForm').trigger('reset')"
                                                              class="btn btn-danger"><b>X</b></button></span>
                </button>
            </div>
            <div class="modal-body  ">
                <div class="row">
                <table class="table table-borderless" id="CarteTubeTable"  >
                    <thead></thead>
                    <tbody>
                   <tr>
                        <td colspan="5">Fourinsseur: THYSSEN</td>
                        <td colspan="5"><h4>Carte Tube</h4></td>
                        <td>Machine</td>
                        <td>N°Tube</td>
                        <td>Epaisseur</td>
                    </tr>
                   <tr>
                       <td colspan="5">N°Bobine: 3880671</td>
                       <td colspan="2">Code: 12.477</td>
                       <td colspan="1">Rev: 0</td>
                       <td colspan="2">Date: 05/05/2015</td>
                       <td>E</td>
                       <td>6382</td>
                       <td rowspan="3"> 25.4 mm</td>
                   </tr>
                   <tr>
                       <td colspan="5">N°Coulee: 669337</td>
                       <td colspan="5" >Code: GAINE <br>
                                        Diamètre: 60 &nbsp; Nuance:X70
                       </td>
                       <td>Poste
                           <hr>A
                       </td>
                       <td>Date
                           <hr>23/03/2020 </td>
                   </tr>
                    <tr>
                    <td colspan="2">U S Auto</td>
                    <td colspan="4">VISUEL</td>
                    <td colspan="3">REPARATION</td>
                    <td colspan="4">TRONCONNAGE</td>
                    </tr>
                    <tr>
                        <td>U</td>
                        <td></td>
                        <td>Y</td>
                        <td>3</td>
                        <td colspan="2">Int: 2Y |A Réparé| 1Y |A MEULE| </td>
                        <td colspan="3">Int: 2Y |A Réparé| 1Y |A MEULE| </td>
                        <td colspan="2">Origine motif-Observation </td>
                        <td colspan="2">Longueur/mm Visa tronc </td>
                    </tr>
                    </tbody>
                </table>

                </div>
            </div>
        </div>
    </div>
</div>
</div>


