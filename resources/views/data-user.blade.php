@extends('layouts.app')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{ asset('css/styles.css') }}" rel="stylesheet">

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dados do Usuário</div>

                <div class="panel-body">
                    <h2 class="text-center">Olá, {{ Auth::user()->name }}!</h2>
                    <div class="user-profile">
                        <div class="profile-picture">
                            @if(isset(Auth::user()->image))
                            <img id="profile-image" src="{{ url('storage/uploads/'.Auth::user()->image) }}" alt="" class="img-responsive">
                            @else
                            <img src="{{ url('storage/uploads/default.png') }}" alt="" class="img-responsive">
                            @endif
                        </div>
                        <div class="div-inputCampo">
                            <label for="name" class="col-md-4 control-label">Nome:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" readonly>
                            </div>
                        </div>
                        <div class="div-inputCampo">
                            <label for="email" class="col-md-4 control-label">E-mail:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}" readonly>
                            </div>
                        </div>
                        <div class="div-inputCampo">
                            <label for="cep" class="col-md-4 control-label">CEP:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="cep" name="cep" value="{{ $user->cep }}" readonly>
                            </div>
                        </div>
                        <div class="div-inputCampo">
                            <label for="logradouro" class="col-md-4 control-label">Rua:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="logradouro" name="logradouro" value="{{ $user->logradouro }}" readonly>
                            </div>
                        </div>
                        <div class="div-inputCampo">
                            <label for="bairro" class="col-md-4 control-label">Bairro:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="bairro" name="bairro" value="{{ $user->bairro }}" readonly>
                            </div>
                        </div>
                        <div class="div-inputCampo">
                            <label for="cidade" class="col-md-4 control-label">Cidade:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="cidade" name="cidade" value="{{ $user->cidade }}" readonly>
                            </div>
                        </div>
                        <div class="div-inputCampo">
                            <label for="uf" class="col-md-4 control-label">UF:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="uf" name="uf" value="{{ $user->estado }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="divButtonVoltar">
                    <a class="button-container btn btn-primary" href="{{ route('home') }}">Editar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection