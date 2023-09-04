@extends('layouts.app')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{ asset('css/styles.css') }}" rel="stylesheet">

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Painel do Usuário</div>

                <div class="panel-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif

                    <h2 class="text-center">Olá, {{ Auth::user()->name }}!</h2>
                    <div class="user-profile">
                        <div class="profile-picture">
                            @if(session('user') && session('user')->image)
                            <img src="{{ url('storage/users/'.session('user')->image) }}" alt="" class="img-responsive">
                            @else
                            <img src="{{ url('storage/users/default.png') }}" alt="" class="img-responsive">
                            @endif
                        </div>
                        <form class="form-horizontal" id="user-form" action="{{ route('user.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <!-- Usando o método PUT -->
                            <input type="hidden" name="id" value="{{ Auth::user()->id }}">

                            <!-- Input para escolher uma imagem -->
                            <div class="div-buttonFoto">
                                <input type="file" name="image">
                            </div>

                            <!-- Campos para exibir informações de endereço -->
                            <div class="div-inputBuscar">
                                <label for="cep" class="col-md-4 control-label">Digite seu CEP:</label>
                                <input type="text" class="form-control" id="cep" name="cep" placeholder="Digite seu CEP">
                                <button type="button" class="button-container btn btn-primary" id="buscarEndereco">Buscar Endereço</button>
                            </div>

                            <div class="form-group">
                                <label for="logradouro" class="col-md-4 control-label">Rua:</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="logradouro" name="logradouro" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="bairro" class="col-md-4 control-label">Bairro:</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="bairro" name="bairro" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="cidade" class="col-md-4 control-label">Cidade:</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="cidade" name="cidade" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="estado" class="col-md-4 control-label">Estado:</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="estado" name="estado" readonly>
                                </div>
                            </div>

                            <button class=" button-container btn btn-primary">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#buscarEndereco').click(function() {
            var cep = $('#cep').val();

            $.ajax({
                url: "https://viacep.com.br/ws/" + cep + "/json",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('#logradouro').val(data.logradouro);
                    $('#bairro').val(data.bairro);
                    $('#cidade').val(data.localidade);
                    $('#estado').val(data.uf);
                },
                error: function() {
                    alert("Erro ao buscar o CEP. Verifique se o CEP é válido.");
                }
            });
        });
    });
</script>