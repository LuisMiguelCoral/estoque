@extends('layouts.app')

@section('content')
<nav class="navbar navbar-expand-lg navbar-light fixed-top" data-spy="affix" data-offset-top="0">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('produtos.index') }}">
                        <img src="{{ asset('images/Logo-rog.png') }}" alt="Rogimar" height="30" style="margin-right: 10px;">
                        Lista de Produtos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('produtos.create') }}">Registrar Produto</a> 
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('media.mensal') }}">Média de Vendas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('relatorio.vendas') }}">Relatório de Vendas</a> 
                </li>
            </ul>
        </div>
    </div>          
</nav>

<div class="container mt-5 pt-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-center">Histórico de Produtos</div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success text-center">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('historico.index') }}" method="GET" class="form-inline mb-3">
                        <div class="form-group mt-2">
                            <label for="date" class="mr-2">Filtrar por data:</label>
                            <input type="date" name="date" id="date" class="form-control-sm ms-2" value="{{ request('date') }}">
                            <button type="submit" class="btn btn-primary ms-2">Filtrar</button>
                        </div>
                    </form>
                    
                    <form action="{{ route('historico.updateAll') }}" method="POST">
                        @csrf
                        @method('PUT')

                        @if ($historicos->isEmpty())
                            <p>Nenhum histórico encontrado.</p>
                        @else
                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Produto ID</th>
                                        <th>Nome</th>
                                        <th>Quantidade</th>
                                        <th>Vendas</th>
                                        <th>Data de Atualização</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($historicos as $historico)
                                    <tr>
                                        <td>{{ $historico->id }}</td>
                                        <td>{{ $historico->produto_id }}</td>
                                        <td>{{ $historico->nome }}</td>
                                        <td>
                                            <input type="number" name="historicos[{{ $historico->id }}][quantidade]" value="{{ $historico->quantidade }}" class="form-control">
                                        </td>
                                        <td>
                                            <input type="number" name="historicos[{{ $historico->id }}][vendas]" value="{{ $historico->vendas }}" class="form-control">
                                        </td>
                                        <td>{{ $historico->created_at->format('d/m/Y H:i:s') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
