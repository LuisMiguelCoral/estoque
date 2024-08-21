@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mx-auto">
                <div class="card-header text-center">Histórico de Produtos</div>
                <div class="card-body">
                    @if ($historicos->isEmpty())
                        <p>Nenhum histórico encontrado.</p>
                    @else
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Produto ID</th>
                                    <th>Nome</th>
                                    <th>Quantidade</th>
                                    <th>Vendas</th>
                                    <th>Data de Criação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($historicos as $historico)
                                <tr>
                                    <td>{{ $historico->id }}</td>
                                    <td>{{ $historico->produto_id }}</td>
                                    <td>{{ $historico->nome }}</td>
                                    <td>{{ $historico->quantidade }}</td>
                                    <td>{{ $historico->vendas }}</td>
                                    <td>{{ $historico->created_at->format('d/m/Y H:i:s') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
