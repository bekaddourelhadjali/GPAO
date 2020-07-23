<script>
    $(document).ready(function () {
        $('#reprendreButton').click(function (e) {
            e.preventDefault();
            if ($('#RepRapForm')[0].checkValidity()){
            const numRap = $('#numRap').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{url('/'.$rapport.'/')}}/" + numRap + '/edit',
                method: 'get',
                success: function (result) {
                    var rapport = result.rapport;
                    if (rapport.Etat === 'N')
                        window.location.href = '{{url("/".$next."/")}}/' + rapport.Numero;
                    else
                        alert('Rapport Cloturé');
                },
                error: function (result) {
                    alert(result.responseJSON.error);
                    console.log(result);
                }
            });
            }
        });
    });
</script>