<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Relatório de Finanças</title>
</head>

<body>
    <h1>Relatório de Finanças - {{ $month }}/{{ $year }}</h1>
    <h2>Caixa Total: R$ {{ formatCurrencyBR($caixa_total) }}</h2>
    <h2>Banco Total: R$ {{ formatCurrencyBR($banco_total) }}</h2>
    <h2>Saldo Total: R$ {{ formatCurrencyBR($banco_total + $caixa_total) }}</h2>
    <h3>Entradas</h3>
    <table>
        <thead>
            <tr>
                <th>Título</th>
                <th>Data</th>
                <th>Fonte</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($entries as $entry)
                <tr>
                    <td>{{ $entry->title }}</td>
                    <td>{{ date('d/m/Y', strtotime($entry->date_transfer)) }}</td>
                    <td>{{ $entry->source }}</td>
                    <td>{{ number_format($entry->value, 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Saídas</h3>
    <table>
        <thead>
            <tr>
                <th>Título</th>
                <th>Data</th>
                <th>Fonte</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($withdrawals as $withdrawal)
                <tr>
                    <td>{{ $withdrawal->title }}</td>
                    <td>{{ date('d/m/Y', strtotime($withdrawal->date_transfer)) }}</td>
                    <td>{{ $withdrawal->source }}</td>
                    <td>{{ number_format($withdrawal->value, 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
