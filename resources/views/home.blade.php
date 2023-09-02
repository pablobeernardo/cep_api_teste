@extends('layouts.app')

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

                    <h2 class="text-center">Perfil de Usuário</h2>

                    <div class="user-profile">
                        <div class="profile-picture">
                            <img src="{{ asset('https://w7.pngwing.com/pngs/340/946/png-transparent-avatar-user-computer-icons-software-developer-avatar-child-face-heroes-thumbnail.png') }}" alt="Perfil do Usuário">
                        </div>

                        <form class="form-horizontal" id="cep-form">                           
                            <div class="form-group">
                                <label for="cep" class="col-md-4 control-label">Digite seu CEP:</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="cep" name="cep" placeholder="Digite seu CEP">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">Buscar Endereço</button>
                                </div>
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
                        </form>

                        <!-- Script JavaScript -->
                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <script>
                            $(document).ready(function() {
                                $('#cep-form').submit(function(event) {
                                    event.preventDefault(); // Impede o envio do formulário padrão

                                    var cep = $('#cep').val();

                                    $.ajax({
                                        url: "https://viacep.com.br/ws/" + cep + "/json", // Substitua pela URL real da API de CEP.
                                        type: "GET",
                                        dataType: "json",
                                        success: function(data) {
                                            // Atualize os campos de endereço com os dados do CEP
                                            $('#logradouro').val(data.logradouro);
                                            $('#bairro').val(data.bairro);
                                            $('#cidade').val(data.localidade);
                                            $('#estado').val(data.uf);
                                        },
                                        error: function() {
                                            // Trate erros, por exemplo, exibindo uma mensagem ao usuário.
                                            alert("Erro ao buscar o CEP. Verifique se o CEP é válido.");
                                        }
                                    });
                                });
                            });
                        </script>
                        <!-- Fim do Script JavaScript -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection