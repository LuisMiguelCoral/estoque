@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- Rotas no Canto Esquerdo -->
        <div class="col-md-2">
            <div class="d-flex flex-column align-items-start mb-3">
                <!-- Rotas Acima do Card de Histórico -->
                <a href="{{ route('produtos.index') }}" class="btn btn-primary">Lista de Produtos</a>
                <a href="{{ route('produtos.create') }}" class="btn btn-primary">Registrar Produto</a>
                <a href="{{ route('home') }}" class="btn btn-primary">Voltar</a>
            </div>
        </div>

        <!-- Conteúdo Principal -->
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-center">Histórico de Produtos</div>
                <div class="card-body">

                    <!-- Formulário de Filtro -->
                    <form action="{{ route('historico.index') }}" method="GET" class="form-inline mb-3">
                        <div class="form-group mr-2">
                            <label for="date" class="mr-2">Filtrar por data:</label>
                            <input type="date" name="date" id="date" class="form-control-sm" value="{{ request('date') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Filtrar</button>
                    </form>

                    <form action="{{ route('historico.updateAll') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                        </div>

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
                                        <th>Data de Atualização</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($historicos as $historico)
                                    <tr>
                                        <td>{{ $historico->id }}</td>
                                        <td>{{ $historico->produto_id }}</td>
                                        <td>{{ $historico->nome }}</td>
                                        <td>
                                            <input type="number" name="historicos[{{ $historico->id }}][quantidade]" value="{{ $historico->quantidade }}" class="form-control">
                                        </td>
                                        <td>
                                            <input type="number" name="historicos[{{ $historico->id }}][vendas]" value="{{ $historico->vendas }}" class="form-control">
                                        </td>
                                        <td>{{ $historico->created_at->format('d/m/Y H:i:s') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
