@extends('layouts.app')

@section('content')
<nav class="navbar navbar-expand-lg navbar-light fixed-top" data-spy="affix" data-offset-top="0">
    <div class="container">
        <a class="navbar-brand" href="#"><img src="assets/imgs/logo-removebg-preview.png" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('produtos.index') }}">Lista de Produtos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('produtos.create') }}">Registrar Produto</a> 
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Voltar</a> 
                </li>
            </ul>
        </div>
    </div>          
</nav>

<div class="container mt-5 pt-5">
    <div class="row">
        <!-- Conteúdo Principal -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">Média de Vendas de Bolos no Mês</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>Produto</th>
                                <th>Quantidade Produzida</th>
                                <th>Vendas</th>
                                <th>Média de Vendas Diárias</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produtos as $nome => $produto)
                                <tr>
                                    <td>{{ $nome }}</td>
                                    <td>{{ $produto['quantidade'] }}</td>
                                    <td>{{ $produto['vendas'] }}</td>
                                    <td>{{ number_format($produto['media'], 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
