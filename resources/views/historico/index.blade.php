@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-center">Histórico de Produtos</div>
                <div class="card-body">

                    <!-- Formulário de Filtro -->
                    <form action="{{ route('historico.index') }}" method="GET" class="form-inline mb-3">
                        <label for="date" class="mr-2">Filtrar por data:</label>
                        <input type="date" name="date" id="date" class="form-control mr-2" value="{{ request('date') }}">
                        <button type="submit" class="btn btn-primary">Filtrar</button>

                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    </form>

                    @if ($historicos->isEmpty())
                        <p>Nenhum histórico encontrado.</p>
                    @else
                        <form action="{{ route('historico.updateAll') }}" method="POST">
                            @csrf
                            @method('PUT')
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
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
