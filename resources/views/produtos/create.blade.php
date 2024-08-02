@extends('layouts.app')

@section('content')
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
                            <button type="submit" class="btn btn-primary mr-2">Registrar Produto</button>
                            <a href="{{ route('produtos.index') }}" class="btn btn-secondary">Listar Produtos</a>
                        </div>
                    </form>
                    <div class="d-flex justify-content-center mt-3">
                        <a href="{{ route('home') }}" class="btn btn-secondary">Voltar para Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
