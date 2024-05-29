@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Registrar Produto</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('produtos.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="nome">Nome do Produto</label>
                            <input type="text" name="nome" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="quantidade">Quantidade</label>
                            <input type="number" name="quantidade" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Registrar Produto</button>
                        <a href="{{ route('produtos.index') }}" class="btn btn-secondary">Listar Produtos</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
