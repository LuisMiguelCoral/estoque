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
                    <a class="nav-link" href="{{ route('home') }}">
                        <img src="{{ asset('images/Logo-rog.png') }}" alt="Rogimar" height="30" style="margin-right: 10px;">
                        <!-- Lista de Produtos -->
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('produtos.create') }}">Registrar Produto</a> 
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('historico.index') }}">Histórico de Vendas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('media.mensal') }}">Média de Vendas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('relatorio.vendas') }}">Relatório de Vendas</a> <!-- Rota do Relatório de Vendas -->
                </li>
            </ul>
        </div>
    </div>          
</nav>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header text-center">Lista de Produtos</div>
                    <div class="card-body">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                        <div class="d-flex justify-content-between mb-3">
                            <a href="{{ route('produtos.create') }}" class="btn btn-primary">Registrar Novo Produto</a>
                        </div>
                        <table class="table-bordered table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Quantidade</th>
                                    <th>Vendas</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produtos as $produto)
                                    <tr>
                                        <td>{{ $produto->id }}</td>
                                        <td>{{ $produto->nome }}</td>
                                        <td>{{ $produto->quantidade }}</td>
                                        <td>{{ $produto->vendas }}</td>
                                        <td>
                                            <a href="{{ route('produtos.edit', $produto->id) }}"
                                                class="btn btn-warning btn-sm me-2">Editar</a>
                                             
                                             <form id="delete-form-{{ $produto->id }}"
                                                   action="{{ route('produtos.destroy', $produto->id) }}" method="POST"
                                                   style="display: inline;">
                                                 @csrf
                                                 @method('DELETE')
                                                 <button type="submit" class="btn btn-danger btn-sm">
                                                     Excluir
                                                 </button>
                                             </form>
                                             
                                        </td>
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
