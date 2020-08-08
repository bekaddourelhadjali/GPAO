@extends('layouts.dashboardTemp')
@section('style')
     <title>Changer Le Mot De Passe</title>
    @endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Changer Le Mot De Passe') }}</div>

                <div class="card-body">
                    <form  id="RPForm">

                        <input type="hidden" id="token" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right" >Le nom d'utilisateur</label>

                            <div class="col-md-6">
                                <input id="username" type="text"  readonly  class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{\Illuminate\Support\Facades\Auth::user()->username}}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="oldpassword" class="col-md-4 col-form-label text-md-right">{{ __("L'ancien mot de passe") }}</label>

                            <div class="col-md-6">
                                <input id="oldpassword" type="password" minlength="8" class="form-control{{ $errors->has('oldpassword') ? ' is-invalid' : '' }}" name="oldpassword" required>

                                @if ($errors->has('oldpassword'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('oldpassword') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right" >{{ __('Le nouveau mot de passe') }}</label>

                            <div class="col-md-6">
                                <input id="password" minlength="8" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmez le mot de passe') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" minlength="8" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" id="SubmitForm">
                                    {{ __('Réinitialiser le mot de passe') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section("script")
    <script>
        $(document).ready(function(){
            $('#SubmitForm').click(function (e) {
                if ($('#RPForm')[0].checkValidity()){
                    e.preventDefault();
                    if( $('#password').val()===$('#password-confirm').val()) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: "{{ route('resetpassword') }}",
                        method: 'post',
                        data: {
                            username:$('#username').val(),
                            oldpassword:$('#oldpassword').val(),
                            password:$('#password').val(),
                            password_confirm:$('#password-confirm').val(),
                            _token:$('#token').val(),
                        },
                        success: function (result) {
                            window.location.href="{{route('home')}}";
                        },
                        error: function (result) {
                            console.log(result);
                            alert(result.responseJSON.message);
                        }
                    });
                }else {
                    if($('#password').val()!==$('#password-confirm').val()){
                        alert("La confirmation de nouveau mot de passe n'est pas valide");
                    }
                }}
            });
            $('#password-confirm').keyup(function(){
               if($('#password').val()!==$('#password-confirm').val()) {
                   $('#password-confirm').css('border-color','red');
               }else{
                   $('#password-confirm').css('border-color','green');
               }
            });
        });
    </script>
    @endsection
