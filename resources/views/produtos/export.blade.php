<!DOCTYPE html>
<html>
<head>
    <title>Relatório de Produtos</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Relatório de Vendas - {{ \Carbon\Carbon::now()->format('d/m/Y') }}</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Quantidade</th>
                <th>Vendas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produtos as $produto)
                <tr>
                    <td>{{ $produto->id }}</td>
                    <td>{{ $produto->nome }}</td>
                    <td>{{ $produto->quantidade }}</td>
                    <td>{{ $produto->vendas }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
