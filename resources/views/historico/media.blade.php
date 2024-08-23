@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- Rotas no Canto Esquerdo -->
        <div class="col-md-2">
            <div class="d-flex flex-column align-items-start mb-3">
                <a href="{{ route('produtos.index') }}" class="btn btn-primary">Lista de Produtos</a>
                <a href="{{ route('produtos.create') }}" class="btn btn-primary">Registrar Produto</a>
                <a href="{{ route('home') }}" class="btn btn-primary">Voltar</a>
            </div>
        </div>

        <!-- Conteúdo Principal -->
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-center">Média de Vendas de Bolos no Mês</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>Produto</th>
                                <th>Quantidade Produzida</th>
                                <th>Vendas</th>
                                <th>Média de Vendas Diárias</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produtos as $nome => $produto)
                                <tr>
                                    <td>{{ $nome }}</td>
                                    <td>{{ $produto['quantidade'] }}</td>
                                    <td>{{ $produto['vendas'] }}</td>
                                    <td>{{ number_format($produto['media'], 2) }}</td>
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
