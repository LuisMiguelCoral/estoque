@extends('layouts.app')

@section('content')
<div class="container dark-mode mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card card-custom mx-auto">
                <div class="card-header text-center">Lista de Produtos</div>
                <div class="card-body">
                    <div class="d-flex justify-content-center mb-3">
                        <a href="{{ route('produtos.create') }}" class="btn btn-primary animate-button mr-2">Registrar Novo Produto</a>
                        <a href="{{ route('home') }}" class="btn btn-secondary">Voltar para Home</a>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('produtos.updateAll') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <table class="table table-bordered">
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
                                    <td>
                                        <input min="0" type="number" name="produtos[{{ $produto->id }}][quantidade]" value="{{ $produto->quantidade ?? 0 }}" class="form-control mr-2" style="width: 80px;">
                                    </td>
                                    <td>
                                        <input min="0" type="number" name="produtos[{{ $produto->id }}][vendas]" value="{{ $produto->vendas ?? 0 }}" class="form-control mr-2" style="width: 80px;">
                                    </td>
                                    <td>
                                        <form id="delete-form-{{ $produto->id }}" action="{{ route('produtos.destroy', $produto->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este produto?');">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center mt-3">
                            <button type="submit" class="btn btn-success">Atualizar Todos</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
