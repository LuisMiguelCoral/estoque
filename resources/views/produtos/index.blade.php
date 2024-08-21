
@extends('layouts.app')

@section('content')
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
                            <a href="{{ route('home') }}" class="btn btn-primary">Voltar</a>
                            <a href="{{ route('produtos.create') }}" class="btn btn-primary">Registrar Novo Produto</a>
                        </div>
                        <table class="table-bordered table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Quantidade</th>
                                    <th>Preço</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produtos as $produto)
                                    <tr>
                                        <td>{{ $produto->id }}</td>
                                        <td>{{ $produto->nome }}</td>
                                        <td>{{ $produto->quantidade }}</td>
                                        <td>R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                                        <td>
                                            <a href="{{ route('produtos.edit', $produto->id) }}"
                                                class="btn btn-warning btn-sm">Editar</a>

                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="event.preventDefault(); if(confirm('Tem certeza que deseja excluir este produto?')){ document.getElementById('delete-form-{{ $produto->id }}').submit(); }">Excluir</button>

                                            <form id="delete-form-{{ $produto->id }}"
                                                action="{{ route('produtos.destroy', $produto->id) }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                                @method('DELETE')
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
