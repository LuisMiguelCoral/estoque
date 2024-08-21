
@extends('layouts.app')

@section('content')
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
                                    class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="quantidade">Vendas:</label>
                                <input type="number" name="vendas" value="{{ $produto->vendas }}"
                                    class="form-control" required>
                            </div>

                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-success">Atualizar</button>
                                <a href="{{ route('produtos.index') }}" class="btn btn-secondary">Voltar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

