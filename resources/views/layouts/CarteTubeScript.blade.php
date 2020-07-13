<script>
    $(document).ready(function () {
        $('#collapseFab').collapse('hide');
        $('#collapseVis').collapse('hide');
        $('#collapseM17').collapse('hide');
        $('#collapsePRE').collapse('hide');
        $('#collapseRX1').collapse('hide');
        $('#collapseM24').collapse('hide');
        $('#collapseM25').collapse('hide');
        $('#collapseNDT').collapse('hide');
        $('#tubeCard').change(function () {
            if ($('#tubeCard').valid()) {
                const tube = $('#tubeCard').val();
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{url('/CarteTube/')}}/" + tube + '',
                    method: 'get',
                    data: {},
                    success: function (result) {
                        $('#tbodyReprendre').html('');
                        result.rapports.forEach(function (rapport, index) {

                            if (rapport.Etat === 'C') {
                                $('#tbodyReprendre').append('<tr id="rapport' + rapport.Numero + '" class="Clot bg-success text-white">' +
                                    '                   <td>' + rapport.DateRapport + '</td>\n' +
                                    '                   <td>' + rapport.Poste + '</td>\n' +
                                    '                   <td>' + rapport.Machine + '</td>\n' +
                                    '                   <td>' + rapport.NomAgents + ' / ' + rapport.CodeAgent + '</td>\n' +
                                    '                   <td>' + rapport.NomAgents1 + ' / ' + rapport.CodeAgent1 + '</td>\n' +
                                    '                            <td>Oui</td>   ;');
                            } else {
                                $('#tbodyReprendre').append('<tr id="rapport' + rapport.Numero + '"  class="NotClot  "> ' +
                                    '                   <td>' + rapport.DateRapport + '</td>\n' +
                                    '                   <td>' + rapport.Poste + '</td>\n' +
                                    '                   <td>' + rapport.Machine + '</td>\n' +
                                    '                   <td>' + rapport.NomAgents + ' / ' + rapport.CodeAgent + '</td>\n' +
                                    '                   <td>' + rapport.NomAgents1 + ' / ' + rapport.CodeAgent1 + '</td>\n' +
                                    '                             <td>Non</td>   ;');
                            }

                        });
                        AddListeners();
                    },
                    error: function (result) {
                        console.log(result);
                        if (result !== undefined)
                            if (result.responseJSON.message.includes('Undefined offset: 0')) {
                                alert("Tube n°= " + tube + " n'existe pas dans les rapports RX1");
                            } else {
                                alert("Tube n°= " + tube + " n'existe pas dans les rapports RX1");
                            }
                    }
                });
            }
        });
    });
</script>