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
                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('produtos.create') }}">Registrar Produto</a> 
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('historico.index') }}">Histórico de Vendas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('media.vendas.mensal') }}">Média de Vendas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Voltar</a> 
                </li>
            </ul>
        </div>
    </div>          
</nav>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mx-auto">
                <div class="card-header text-center">Registrar Produto</div>
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
                    <form method="POST" action="{{ route('produtos.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="nome">Nome do Produto</label>
                            <input type="text" name="nome" class="form-control" required value="{{ old('nome') }}">
                        </div>
                        <div class="form-group">
                            <label for="quantidade">Quantidade:</label>
                            <input type="number" name="quantidade" id="quantidade" class="form-control" required>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">Registrar Produto</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
