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
                    <table class="table table-bordered">
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Quantidade</th>
                            <th>Vendas</th> 
                            <th>Remover</th>
                        </tr>
                        @foreach ($produtos as $produto)
                        <tr>
                            <td>{{ $produto->id }}</td>
                            <td>{{ $produto->nome }}</td>
                            <td>{{ $produto->quantidade }}</td>
                            
                            <td>
                                <form action="{{ route('produtos.update', $produto->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" name="vendas" value="{{ $produto->vendas ?? 0 }}" class="form-control" style="display: inline-block; width: 70px;">
                                    <button type="submit" class="btn btn-primary btn-sm">Atualizar</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Excluir</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
