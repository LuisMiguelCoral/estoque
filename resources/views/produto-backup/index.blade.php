@extends('layouts.app')

@section('content')
<div class="container dark-mode mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card card-custom mx-auto">
                <div class="card-header text-center">Dados de Produtos Armazenados</div>
                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <form method="GET" action="{{ route('produto-backup.index') }}" class="mb-4">
                        <div class="form-group row">
                            <label for="date" class="col-md-2 col-form-label">Filtrar por Data:</label>
                            <div class="col-md-4">
                                <input type="date" id="date" name="date" class="form-control" value="{{ request('date') }}">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">Filtrar</button>
                            </div>
                        </div>
                    </form>
                    
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Quantidade</th>
                                <th>Vendas</th>
                                <th>Data de Armazenamento</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produtosBackup as $produto)
                            <tr>
                                <td>{{ $produto->produto_id }}</td>
                                <td>{{ $produto->nome }}</td>
                                <td>{{ $produto->quantidade }}</td>
                                <td>{{ $produto->vendas }}</td>
                                <td>{{ $produto->created_at->format('d/m/Y H:i:s') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
@endsection
