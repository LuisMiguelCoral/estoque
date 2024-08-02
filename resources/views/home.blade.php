@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mx-auto">
                <div class="card-header text-center">Home</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="d-flex flex-column align-items-center">
                        <a href="{{ route('produtos.index') }}" class="btn btn-secondary custom-hover mb-2 w-50 text-center">Lista de Produtos</a>
                        <a href="{{ route('produtos.create') }}" class="btn btn-secondary custom-hover mb-2 w-50 text-center">Registrar Produto</a>
                        <a href="{{ route('produtos.create') }}" class="btn btn-secondary custom-hover mb-2 w-50 text-center">Média de Vendas</a>
                        <a href="{{ route('produtos.create') }}" class="btn btn-secondary custom-hover mb-2 w-50 text-center">Relatorio de Vendas</a>
                        <a href="{{ route('produtos.create') }}" class="btn btn-secondary custom-hover mb-2 w-50 text-center">Historico de Vendas</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
