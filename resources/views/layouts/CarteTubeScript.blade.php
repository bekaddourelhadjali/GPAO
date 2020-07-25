<script>
    $(document).ready(function () {
        $('#VFRRoot').hide();
        $('#ReceptionRoot').hide();
        $('#RevIntRoot').hide();
        $('#RevExtRoot').hide();
        $('#ExpeditionRoot').hide();
        $('#CTTube').change(function () {
            if ($('#CTTube').val() != "") {
                if ($('#CTTubes option[value=' + $('#CTTube').val() + ']').val() !== undefined) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: "{{url('/CarteTube/getTubeData')}}/" + $('#CTTube').val() + '',
                        method: 'get',
                        data: {
                            Did: $('#CTDid').val()
                        },
                        success: function (result) {
                            $('.TCVal').html('');
                            console.log(result);
                            if (result.tube != null) {
                                $('#Coulee').html(result.tube.Coulee);
                                $('#Bobine').html(result.tube.Bobine);
                                $('#LongueurFab').html(result.tube.Longueur);
                                $('#DateFab').html(result.tube.DateFab);
                                $('#Fournisseur').html(result.Fournisseur);
                            }
                            if (result.visuels != null && result.visuels.length > 0) {
                                $('#visuels').html('');
                                result.visuels.forEach(function (item, index) {
                                    $('#visuels').append(' <tr>\n' +
                                        '                        <td>U: <span class="TCVal">' + item.U + '</span></td>\n' +
                                        '                        <td>S: <span class="TCVal">' + item.S + '</span></td>\n' +
                                        '                        <td>W: <span class="TCVal">' + item.W + '</span></td>\n' +
                                        '                        <td>A.C: <span class="TCVal">' + item.AC + '</span></td>\n' +
                                        '                        </tr>\n' +
                                        '                        <tr>\n' +
                                        '                        <td>EY: <span class="TCVal">' + item.EY + '</span></td>\n' +
                                        '                        <td>Y: <span class="TCVal">' + item.Y + '</span></td>\n' +
                                        '                        <td>E: <span class="TCVal">' + item.E + '</span></td>\n' +
                                        '\n' +
                                        '                        <td>RB: <span class="TCVal">' + item.RB + '</span></td>\n' +
                                        '                        </tr>\n' +
                                        '                        <tr>\n' +
                                        '\n' +
                                        '                        <td colspan="2">Longueur : <span class="TCVal">' + item.Longueur + '</span></td>\n' +
                                        '                        <td colspan="2">Date : <span class="TCVal">' + (new Date(item.DateSaisie).toLocaleDateString().replace(new RegExp("/", "g"), '-')) + '</span></td>\n' +
                                        '                        </tr>\n' +
                                        '                        <tr>\n' +
                                        '                        <td  > Defs Metal</td>\n' +
                                        '                        <td  colspan="3"> <span class="TCVal">' + item.ObsMetal + '</span></td>\n' +
                                        '                        </tr>' +
                                        '                         <tr>' +
                                        '                        <td  > Defs Soudure</td>\n' +
                                        '                        <td  colspan="3"> <span class="TCVal">' + item.ObsSoudure + '</span></td>\n' +
                                        '                        </tr>');
                                });

                            }
                            if (result.RX1 != null && result.RX1.length > 0) {
                                $('#RX1').html('');
                                if (result.RX1 != null) {
                                    if (result.RX1.length > 0) {
                                        $('#RX1').append('<tr><th>Code Soudeur</th><th>Intégration</th><th>Date</th></tr>');
                                        result.RX1.forEach(function (item, index) {
                                            $('#RX1').append('<tr>  <td > <span class="TCVal" id="CodeSoud">' + item.CodeSoude + '</span> </td>' +
                                                ' <td  ><span class="TCVal" id="Integration">' + item.Integration + '</span> </td>' +
                                                ' <td > <span class="TCVal" id="Date">' + (new Date(item.DateSaisie).toLocaleDateString().replace(new RegExp("/", "g"), '-')) + '</span> </td>' +
                                                '</tr> ');
                                            $('#RX1').append('<tr><td>Defauts</td> <td colspan="2" ><span class="TCVal" id="Defauts">' + item.Defauts + '</span> </td></tr>');
                                        });

                                    }
                                }
                            }
                            if (result.Reparation != null && result.Reparation.length > 0) {
                                $('#Reps').html('');
                                result.Reparation.forEach(function (item, index) {
                                    $('#Reps').append('<tr>\n' +
                                        '                        <td colspan="2" style="min-width:100px"> Defauts </td>\n' +
                                        '                        <td colspan="3" > <span class="TCVal" id="">' + item.Defauts + '</span></td>\n' +
                                        '                        </tr>' +
                                        '<tr>  <td colspan="5">Date : <span class="TCVal">' + (new Date(item.DateSaisie).toLocaleDateString().replace(new RegExp("/", "g"), '-')) + '</span></td>' +
                                        '                              </tr>');
                                });


                            }
                            if (result.M17 != null && result.M17.length > 0) {
                                $('#M17s').html('');
                                result.M17.forEach(function (item, index) {
                                    $('#M17s').append('  <tr>  <td colspan="2">Long Chutée: <span class="TCVal">' + item.LongCh + '</span> mm</td>  ' +
                                        ' <td colspan="2">Date : <span class="TCVal">' + (new Date(item.DateSaisie).toLocaleDateString().replace(new RegExp("/", "g"), '-')) + '</span></td>' +
                                        '</tr>\n' +
                                        '                        <tr><td colspan="2" style="min-width:100px"> Defauts </td>\n' +
                                        '                        <td > <span class="TCVal">' + item.Defauts + '</span></td>\n' +
                                        '                        </tr>');
                                });


                            }
                            if (result.M24 != null && result.M24.length > 0) {
                                $('#M24s').html('');
                                if (result.M24 != null) {
                                    if (result.M24.length > 0) {
                                        result.M24.forEach(function (item, index) {
                                            $('#M24s').append('<tr>  <td >Pression: <span class="TCVal" id="Pression">' + item.Pression + '</span> bar</td>' +
                                                ' <td >Date : <span class="TCVal" id="Date">' + (new Date(item.DateSaisie).toLocaleDateString().replace(new RegExp("/", "g"), '-')) + '</span> </td>' +
                                                '</tr> ');
                                        });

                                    }
                                }
                            }
                            if (result.M25 != null && result.M25.length > 0) {
                                $('#M25s').html('');
                                if (result.M25 != null) {
                                    if (result.M25.length > 0) {
                                        $('#M25s').append('<tr><th>Chanf Debut</th><th>Chanf Fin</th><th>Date</th></tr>');
                                        result.M25.forEach(function (item, index) {
                                            Debut = "Non";
                                            Fin = "Non"
                                            if (item.Debut == true) Debut = 'Oui';
                                            if (item.Fin == true) Fin = 'Oui';
                                            $('#M25s').append('<tr>  <td > <span class="TCVal" id="ChanfD">' + Debut + '</span> </td>' +
                                                ' <td  ><span class="TCVal" id="ChanfF">' + Fin + '</span> </td>' +
                                                ' <td > <span class="TCVal" id="Date">' + (new Date(item.DateSaisie).toLocaleDateString().replace(new RegExp("/", "g"), '-')) + '</span> </td>' +
                                                '</tr> ');
                                        });

                                    }
                                }
                            }
                            if (result.NDT != null && result.NDT.length > 0) {
                                $('#NDT').html('');
                                if (result.NDT != null) {
                                    if (result.NDT.length > 0) {
                                        $('#NDT').append('<tr><th>SNUP</th><th>OPR</th><th>REP-D</th><th>REP-G</th><th>Date</th></tr>');
                                        result.NDT.forEach(function (item, index) {
                                            $('#NDT').append('<tr>  <td > <span class="TCVal" id="SNUP">' + item.Snup + '</span> </td>' +
                                                ' <td  ><span class="TCVal" id="OPR">' + item.OPR + '</span> </td>' +
                                                ' <td  ><span class="TCVal" id="REPD">' + item.Repd + '</span> </td>' +
                                                ' <td  ><span class="TCVal" id="REPG">' + item.Repg + '</span> </td>' +
                                                ' <td > <span class="TCVal" id="Date">' + (new Date(item.DateSaisie).toLocaleDateString().replace(new RegExp("/", "g"), '-')) + '</span> </td>' +
                                                '</tr> ');
                                        });

                                    }
                                }
                            }
                            if (result.RX2 != null && result.RX2.length > 0) {
                                $('#RX2').html('');
                                if (result.RX2 != null) {
                                    if (result.RX2.length > 0) {
                                        $('#RX2').append('<tr><th>Code Soudeur</th><th>Intégration</th><th>Date</th></tr>');
                                        result.RX2.forEach(function (item, index) {
                                            $('#RX2').append('<tr>  <td > <span class="TCVal" id="CodeSoud">' + item.CodeSoude + '</span> </td>' +
                                                ' <td  ><span class="TCVal" id="Integration">' + item.Integration + '</span> </td>' +
                                                ' <td > <span class="TCVal" id="Date">' + (new Date(item.DateSaisie).toLocaleDateString().replace(new RegExp("/", "g"), '-')) + '</span> </td>' +
                                                '</tr> ');
                                            $('#RX2').append('<tr><td>Defauts</td> <td colspan="2" ><span class="TCVal" id="Defauts">' + item.Defauts + '</span> </td></tr>');
                                        });

                                    }
                                }
                            }
                            if (result.VisuelFinal != null && result.VisuelFinal.length > 0) {
                                $('#VF').html('');
                                if (result.VisuelFinal != null) {
                                    if (result.VisuelFinal.length > 0) {
                                        result.VisuelFinal.forEach(function (item, index) {
                                            $('#VF').append('<tr> ' +
                                                ' <td >Epais Deb: <span class="TCVal" >' + item.EpaisseurD + '</span> </td>' +
                                                ' <td >Epais Corps: <span class="TCVal"  >' + item.EpaisseurC + '</span> </td>' +
                                                ' <td >Epais Fin: <span class="TCVal"  >' + item.EpaisseurF + '</td>' +
                                                ' <td >Diam Deb: <span class="TCVal" >' + item.DiametreD + '</span> </td>' +
                                                ' <td >Diam Corps: <span class="TCVal"  >' + item.DiametreC + '</span> </td>' +
                                                ' <td >Diam Fin: <span class="TCVal"  >' + item.DiametreF + '</td>' +
                                                '</tr> ');
                                            $('#VF').append('<tr> ' +
                                                ' <td >Ovalisation: <span class="TCVal" >' + item.Ovalisation + '</span> </td>' +
                                                ' <td >Orthogo Deb: <span class="TCVal"  >' + item.OrthogonaliteD + '</span> </td>' +
                                                ' <td >Orthogo Fin: <span class="TCVal"  >' + item.OrthogonaliteF + '</td>' +
                                                ' <td >Rectitude: <span class="TCVal" >' + item.Rectitude + '</span> </td>' +
                                                ' <td >Chanf Deb: <span class="TCVal"  >' + item.ChanfreinD + '</span> </td>' +
                                                ' <td >Chanf Fin: <span class="TCVal"  >' + item.ChanfreinF + '</td>' +
                                                '</tr> ');
                                            $('#VF').append('<tr> ' +
                                                ' <td  >Longueur: <span class="TCVal" >' + item.Longueur + '</span> </td>' +
                                                ' <td  >Date: <span class="TCVal"  >' + (new Date(item.DateSaisie).toLocaleDateString().replace(new RegExp("/", "g"), '-')) + '</span> </td>' +
                                                '<td>Defauts</td> <td colspan="3" ><span class="TCVal" id="Defauts">' + item.Defauts + '</span> </td>' +
                                                '</tr> ');
                                        });

                                    }
                                }
                            }
                            if (result.VFRefuses != null) {
                                $('#VFRRoot').show();
                                $('#VFR').html('');
                                $('#VFR').append('  <tr>    <td colspan="2">Date : <span class="TCVal">' + (new Date(result.VFRefuses.DateSaisie).toLocaleDateString().replace(new RegExp("/", "g"), '-')) + '</span></td>' +
                                    '</tr>\n' +
                                    '                        <tr><td " style="min-width:100px"> Defauts </td>\n' +
                                    '                        <td > <span class="TCVal">' + result.VFRefuses.Defauts + '</span></td>\n' +
                                    '                        </tr>');

                            }else{
                                $('#VFRRoot').hide();
                            }
                            if (result.Reception != null) {
                                $('#ReceptionRoot').show();
                                $('#Rec').html('');
                                $('#Rec').append('  <tr> ' +
                                    '<td  colspan="2">Longueur: <span class="TCVal">'+result.Reception.Longueur+'</span></td> ' +
                                    '<td  colspan="2">NumLot: <span class="TCVal">'+result.Reception.NumLot+'</span></td> ' +
                                    '</tr>\n' +
                                    '<tr> '+
                                    '<td  colspan="2">NumReception: <span class="TCVal">'+result.Reception.NumReception+'</span></td> ' +
                                     ' <td colspan="2">Date : <span class="TCVal">' + (new Date(result.Reception.DateSaisie).toLocaleDateString().replace(new RegExp("/", "g"), '-')) + '</span></td>' +
                                    '</tr>\n' +
                                    '');

                            }else{
                                $('#ReceptionRoot').hide();
                            }
                            if (result.RevInt != null &&result.RevInt.length>0) {

                                $('#RevIntRoot').show();
                                $('#RevInt').html('');
                                result.RevInt.forEach(function (item, index) {
                                    Accepte='Non';
                                    if(item.Accepte==true){
                                        Accepte='Oui';
                                    }
                                $('#RevInt').append('  <tr> ' +
                                    '<td  colspan="2">Longueur: <span class="TCVal">'+item.Longueur+'</span></td> ' +
                                    '<td  colspan="2">Aspect: <span class="TCVal">'+item.Aspect+'</span></td> ' +
                                    '</tr>\n' +
                                    '<tr> '+
                                    '<td  colspan="2">Accepte: <span class="TCVal">'+Accepte+'</span></td> ' +
                                    ' <td colspan="2">Date : <span class="TCVal">' + (new Date(item.DateSaisie).toLocaleDateString().replace(new RegExp("/", "g"), '-')) + '</span></td>' +
                                    '</tr>\n' +
                                    '');
                                });
                            }else{
                                $('#RevIntRoot').hide();
                            }
                            if (result.RevExt != null &&result.RevExt.length>0) {

                                $('#RevExtRoot').show();
                                $('#RevExt').html('');
                                result.RevExt.forEach(function (item, index) {
                                    Accepte='Non';
                                    if(item.Accepte==true){
                                        Accepte='Oui';
                                    }
                                    $('#RevExt').append('  <tr> ' +
                                        '<td  colspan="2">Longueur: <span class="TCVal">'+item.Longueur+'</span></td> ' +
                                        '<td  colspan="2">Aspect: <span class="TCVal">'+item.Aspect+'</span></td> ' +
                                        '</tr>\n' +
                                        '<tr> '+
                                        '<td  colspan="2">Accepte: <span class="TCVal">'+Accepte+'</span></td> ' +
                                        ' <td colspan="2">Date : <span class="TCVal">' + (new Date(item.DateSaisie).toLocaleDateString().replace(new RegExp("/", "g"), '-')) + '</span></td>' +
                                        '</tr>\n' +
                                        '');
                                });
                            }else{
                                $('#RevExtRoot').hide();
                            }
                            if (result.Expedition != null  ) {
                                $('#ExpeditionRoot').show();
                                $('#Expedition').html('');
                                    $('#Expedition').append('  <tr> ' +
                                        '<td  colspan="2">Longueur: <span class="TCVal">'+result.Expedition.Longueur+'</span></td> ' +
                                        '<td  colspan="2">Poids: <span class="TCVal">'+result.Expedition.Poids+'</span></td> ' +
                                        '</tr>\n' +
                                        '  <tr> ' +
                                        '<td  colspan="2">N°Bon: <span class="TCVal">'+result.Expedition.NumBon+'</span></td> ' +
                                        '<td  colspan="2">N°Expedition: <span class="TCVal">'+result.Expedition.NumExpedition+'</span></td> ' +
                                        '</tr>\n' +
                                        '<tr> '+
                                        '<td  colspan="2">Site: <span class="TCVal">'+result.Expedition.Site+'</span></td> ' +
                                        ' <td colspan="2">Date : <span class="TCVal"> '+result.Expedition.DateExpedition + '</span></td>' +
                                        '</tr>\n' +
                                        '<td  colspan="4">Transporteur: <span class="TCVal">'+result.Expedition.Transporteur+'</span></td> ' +
                                        '<tr> '+
                                        '</tr>\n' );

                            }else{
                                $('#ExpeditionRoot').hide();
                            }

                        },
                        error: function (result) {
                            console.log(result);

                        }
                    });
                } else {
                    $('#CTTube').val('');
                    $('.TCVal').html('');
                    $('#RX1').html('');
                    $('#visuels').html('');
                    $('#Reps').html('');
                    $('#M17s').html('');
                    $('#M24s').html('');
                    $('#M25s').html('');
                    $('#NDT').html('');
                    $('#RX2').html('');
                    $('#VFR').html('');
                    $('#Rec').html('');
                    $('#RevInt').html('');
                    $('#RevExt').html('');
                    $('#Expedition').html('');
                    $('#VFRRoot').hide();
                    $('#ReceptionRoot').hide();
                    $('#RevIntRoot').hide();
                    $('#RevExtRoot').hide();
                    $('#ExpeditionRoot').hide();
                }
            } else {
                $('.TCVal').html('');
                $('#RX1').html('');
                $('#visuels').html('');
                $('#Reps').html('');
                $('#M17s').html('');
                $('#M24s').html('');
                $('#M25s').html('');
                $('#NDT').html('');
                $('#RX2').html('');
                $('#VFR').html('');
                $('#Rec').html('');
                $('#RevInt').html('');
                $('#RevExt').html('');
                $('#Expedition').html('');
                $('#VFRRoot').hide();
                $('#ReceptionRoot').hide();
                $('#RevIntRoot').hide();
                $('#RevExtRoot').hide();
                $('#ExpeditionRoot').hide();
            }
        });
        $('#CTDid').change(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{url('/CarteTube/getTubes')}}/" + $('#CTDid').val() + '',
                method: 'get',
                data: {},
                success: function (result) {
                    $('#CTTubes').html('');
                    result.tubes.forEach(function (item, index) {

                        if (item.Bis) {
                            $('#CTTubes').append('  <option value="' + item.Tube + 'bis">' + item.Tube + 'bis</option>');
                        } else {
                            $('#CTTubes').append(' <option value="' + item.Tube + '">' + item.Tube + '</option>');
                        }


                    });
                },
                error: function (result) {
                    console.log(result);

                }
            });

        });
        $('.collapse').each(function () {
            $(this).on('hidden.bs.collapse', function () {
                $(this).parent().find('i.fa.fa-angle-up').removeClass('fa-angle-up').addClass('fa-angle-down');
            });
            $(this).on('show.bs.collapse', function () {
                $(this).parent().find('i.fa.fa-angle-down').removeClass('fa-angle-down').addClass('fa-angle-up');
            });
        });
        $('.collapse').collapse();

    });

</script>