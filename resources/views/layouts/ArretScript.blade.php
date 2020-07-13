<script>
    $(document).ready(function () {

        addArretsListeners();
        $('#annulerPanne').click(function () {
            $('#ajouterPanne').html(' Ajouter ');
            $('#annulerPanne').hide();
            $('#rx1Form').trigger('reset');
        });

        function addArretsListeners() {
            $('.arretDelete').each(function (e) {
                $(this).off('click');
                $(this).click(function (e) {

                    tr = $(this).parent().parent();
                    const id = $(this).attr("id").replace(/[^0-9]/g, '');

                    e.preventDefault();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{url('/arret_machine/')}}/" + id,
                        method: 'post',
                        data: {
                            _token: '{{csrf_token()}}',
                            id: id,
                            _method: 'delete'

                        },
                        success: function (result) {
                            tr.remove();
                        },
                        error: function (result) {
                            alert(result.responseJSON.message);
                        }
                    });
                });
            });
            $('.arretEdit').each(function (e) {
                $(this).off('click');
                $(this).click(function (e) {
                    e.preventDefault();
                    tr = $(this).parent().parent();
                    const id = $(this).attr("id").replace(/[^0-9]/g, '');
                    $('#cause').val(tr.find('#cause' + id).html());
                    $('#du').val(tr.find('#du' + id).html());
                    $('#au').val(tr.find('#au' + id).html());
                    $('#duree').val(tr.find('#duree' + id).html());
                    $('#ndi').val(tr.find('#ndi' + id).html());
                    $('#obs').val(tr.find('#obs' + id).html());
                    $('#relv').val(tr.find('#relv' + id).html());
                    $('#idArret').val(id);

                    if ($('#type' + id).html() === 'panne') {
                        $('#type_arret').find('option[value=panne]').attr('selected', 'selected');
                        $('#type_arret').find('option[value=arret]').removeAttr('selected');

                    } else {
                        $('#type_arret').find('option[value=panne]').removeAttr('selected');
                        $('#type_arret').find('option[value=arret]').attr('selected', 'selected');
                    }
                    $('#ajouterPanne').html(' Modifier panne ');
                    $('#annulerPanne').show();

                });
            });
        }

        $('#ajouterPanne').click(function (e) {
            if ($('#arretForm')[0].checkValidity()) {
                const id = $('#idArret').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                e.preventDefault();
                if ($('#ajouterPanne').html() !== ' Modifier panne ') {

                    $.ajax({
                        url: "{{ route('arret_machine.store')}}",
                        method: 'post',
                        data: {
                            _token: '{{csrf_token()}}',
                            Machine: $('#Machine').val(),
                            Pid: $('#Pid').val(),
                            Did: $('#Did').val(),
                            NumRap: $('#NumRap').val(),
                            type_arret: $('#type_arret').val(),
                            du: $('#du').val(),
                            au: $('#au').val(),
                            duree: $('#duree').val(),
                            cause: $('#cause').val(),
                            ndi: $('#ndi').val(),
                            obs: $('#obs').val(),
                            relv: $('#relv').val(),
                        },
                        success: function (result) {


                            $('#ArretTable').append('<tr id="arret' + result.arret.id + '">' +
                                '<td id="type' + result.arret.id + '">' + result.arret.TypeArret + '</td>' +
                                '<td id="du' + result.arret.id + '">' + result.arret.Du + '</td>' +
                                '<td id="au' + result.arret.id + '">' + result.arret.Au + '</td>' +
                                '<td id="duree' + result.arret.id + '">' + result.arret.Durée + '</td>' +
                                '<td id="cause' + result.arret.id + '">' + result.arret.Cause + '</td>' +
                                '<td id="ndi' + result.arret.id + '">' + result.arret.NDI + '</td>' +
                                '<td id="obs' + result.arret.id + '">' + result.arret.Obs + '</td>' +
                                '<td id="relv' + result.arret.id + '">' + result.arret.Relv_Compt + '</td>' +
                                '<td><button id="arret' + result.arret.id + 'Edit" class="arretEdit text-primary" ><i class="fa fa-edit"></i></button>' +
                                '<button   id="arret' + result.arret.id + 'Delete" class="arretDelete text-danger" ><i class="fa fa-trash"></i></button></td></tr>');

                            addArretsListeners();
                        },
                        error: function (result) {
                            console.log(result.responseJSON);
                            alert(result.responseJSON.message);
                        }
                    });
                } else {
                    $.ajax({
                        url: "{{url('/arret_machine/')}}/" + id,
                        method: 'post',
                        data: {
                            _token: '{{csrf_token()}}',
                            id: id,
                            _method: 'put',
                            Machine: $('#Machine').val(),
                            Pid: $('#Pid').val(),
                            Did: $('#Did').val(),
                            NumRap: $('#NumRap').val(),
                            type_arret: $('#type_arret').val(),
                            du: $('#du').val(),
                            au: $('#au').val(),
                            duree: $('#duree').val(),
                            cause: $('#cause').val(),
                            ndi: $('#ndi').val(),
                            obs: $('#obs').val(),
                            relv: $('#relv').val(),
                        },
                        success: function (result) {

                            $('#ArretTable').find('#arret' + result.arret.id).html(
                                '<td id="type' + result.arret.id + '">' + result.arret.TypeArret + '</td>' +
                                '<td id="du' + result.arret.id + '">' + result.arret.Du + '</td>' +
                                '<td id="au' + result.arret.id + '">' + result.arret.Au + '</td>' +
                                '<td id="duree' + result.arret.id + '">' + result.arret.Durée + '</td>' +
                                '<td id="cause' + result.arret.id + '">' + result.arret.Cause + '</td>' +
                                '<td id="ndi' + result.arret.id + '">' + result.arret.NDI + '</td>' +
                                '<td id="obs' + result.arret.id + '">' + result.arret.Obs + '</td>' +
                                '<td id="relv' + result.arret.id + '">' + result.arret.Relv_Compt + '</td>' +
                                '<td><button id="arret' + result.arret.id + 'Edit" class="arretEdit text-primary" ><i class="fa fa-edit"></i></button>' +
                                '<button   id="arret' + result.arret.id + 'Delete" class="arretDelete text-danger" ><i class="fa fa-trash"></i></button></td>');
                            $('#ajouterPanne').html(' Ajouter panne ');
                            $('#annulerPanne').hide();
                            $('#arretForm').trigger("reset");
                            addArretsListeners();
                        },
                        error: function (result) {
                            alert(result.responseJSON.message);
                        }
                    });


                }
            } else {
                alert('Remplir tous les champs qui sont obligatoires svp!');
            }
        });
        $("#au , #du").click(function (event) {


            if ($("#du").val() != "" && $("#au").val() != "") {
                var du = parseTime($("#du").val()) / 60000;
                var au = parseTime($("#au").val()) / 60000;
                if (du > au) {
                    au = au + (24 * 60);
                }
                $('#duree').val((au - du));
            }
        });

        function parseTime(cTime) {
            if (cTime == '') return null;
            var d = new Date();
            var time = cTime.match(/(\d+)(:(\d\d))?\s*(p?)/);
            d.setHours(parseInt(time[1]) + ((parseInt(time[1]) < 12 && time[4]) ? 12 : 0));
            d.setMinutes(parseInt(time[3]) || 0);
            d.setSeconds(0, 0);
            return d;
        }
    });
</script>