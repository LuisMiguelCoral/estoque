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
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('produtos.create') }}">Registrar Produto</a> 
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('historico.index') }}">Histórico de Vendas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('media.mensal') }}">Média de Vendas</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('relatorio.vendas') }}">Relatório de Vendas</a> 
                </li> --}}
            </ul>
        </div>
    </div>          
</nav>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">Editar Produto</div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('produtos.update', $produto->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="nome">Nome:</label>
                                <input type="text" name="nome" value="{{ $produto->nome }}" class="form-control"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="quantidade">Quantidade:</label>
                                <input type="number" name="quantidade" value="{{ $produto->quantidade }}"
                                    class="form-control" required min="0">
                            </div>

                            <div class="form-group">
                                <label for="vendas">Vendas:</label>
                                <input type="number" name="vendas" value="{{ $produto->vendas }}"
                                    class="form-control" required min="0">
                            </div>

                            <div class="form-group text-center mt-2">
                                <button type="submit" class="btn btn-primary btn-block">Atualizar</button>
                                <a href="{{ route('produtos.index') }}" class="btn btn-secondary ms-3">Voltar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
