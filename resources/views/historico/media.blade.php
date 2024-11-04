@extends('layouts.app')

@section('content')
<nav class="navbar navbar-expand-lg navbar-light fixed-top" data-spy="affix" data-offset-top="0">
    <div class="container">
        <a class="navbar-brand" href="#"><img src="assets/imgs/logo-removebg-preview.png" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('produtos.index') }}">
                        <img src="{{ asset('images/Logo-rog.png') }}" alt="Rogimar" height="30" style="margin-right: 10px;">
                        Lista de Produtos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('historico.index') }}">Histórico de Vendas</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('produtos.create') }}">Registrar Produto</a> 
                </li> --}}
                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('relatorio.vendas') }}">Relatório de Vendas</a> 
                </li> --}}
            </ul>
        </div>
    </div>          
</nav>

<div class="container mt-5 pt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header text-center">Média de Vendas de Bolos no Mês</div>
                <div class="card-body">
                    <form method="GET" action="{{ route('media.mensal') }}" class="mb-2">
                        <div class="row justify-content-start">
                            <div class="col-md-3">
                                <select name="month" class="form-control custom-select mb-1">
                                    <option value="">Selecione o Mês</option>
                                    @foreach (range(1, 12) as $m)
                                        <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                                            {{ ucfirst(strtolower(\Carbon\Carbon::create()->month($m)->locale('pt_BR')->translatedFormat('F'))) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="year" class="form-control custom-select mb-2">
                                    <option value="">Selecione o Ano</option>
                                    @for ($y = date('Y'); $y >= date('Y') - 5; $y--)
                                        <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                                            {{ $y }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary btn-block">Filtrar</button>
                            </div>
                        </div>
                    </form>

                    @if (isset($message) && $message)
                        <div class="alert alert-warning">{{ $message }}</div>
                    @endif
                    <button onclick="window.print()" class="btn btn-primary">Imprimir Relatório</button>
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>Produto</th>
                                <th>Quantidade Produzida</th>
                                <th>Vendas</th>
                                <th>Média de Vendas Diárias</th>
                                <th>Dias de Venda</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($produtosCalculados) > 0)
                                @foreach ($produtosCalculados as $nome => $produto)
                                    <tr>
                                        <td>{{ $nome }}</td>
                                        <td>{{ $produto['quantidade'] }}</td>
                                        <td>{{ $produto['vendas'] }}</td>
                                        <td>{{ number_format($produto['media'], 2) }}</td>
                                        <td>{{ count($produto['dias']) }} dias</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center">Nenhum dado disponível para o mês selecionado.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
