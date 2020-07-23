<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reprendre un rapport</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="RepRapForm">
                <div class="row"></div>
                <div class="form-group  form-inline">
                    <label class="col-md-4 col-6" for="NumRap" style="margin-right:10px"><h5>Numero de Rapport
                            :</h5></label>
                    <input class="col-3 form-control" oninput="validity.valid||(value='');"
                           style="margin-right:10px" name="numRap" id="numRap" type="number" min="1" required>
                    <button type="submit" id="reprendreButton" style="margin-right:10px"
                            class="col-2 offset-md-0  btn btn-primary">Entrer
                    </button>

                </div>
                </form>
            </div>
        </div>
    </div>
</div>