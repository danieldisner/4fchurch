<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Relatório de Finanças</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            font-size: 1.5rem;
            text-align: center;
        }

        h2 {
            font-size: 1.2rem;
            text-align: center;
        }

        .container {
            display: flex;
            justify-content: space-around;
            gap: 20px;
            margin-top: 20px;
        }

        .month-section {
            width: 45%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Relatório de Finanças - {{ formatDateBR($startDate) }} à {{ formatDateBR($endDate) }}</h1>

    <h2>Caixa Total: R$ {{ formatCurrencyBR($caixa_total) }}</h2>
    <h2>Banco Total: R$ {{ formatCurrencyBR($banco_total) }}</h2>
    <h2>Saldo Total: R$ {{ formatCurrencyBR($caixa_total + $banco_total) }}</h2>

    <div class="container">
        @foreach ($entries as $month => $entryData)
            <div class="month-section">
                <h3>Entradas - {{ $month }}</h3>
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
                        @foreach ($entryData as $entry)
                            <tr>
                                <td>{{ $entry->title }}</td>
                                <td>{{ date('d/m/Y', strtotime($entry->date_transfer)) }}</td>
                                <td>{{ $entry->source }}</td>
                                <td>{{ number_format($entry->value, 2, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" style="text-align: right;">Total:</td>
                            <td>{{ formatCurrencyBR($caixa_entries[$month]) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="month-section">
                <h3>Saídas - {{ $month }}</h3>
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
                        @foreach ($withdrawals[$month] as $withdrawal)
                            <tr>
                                <td>{{ $withdrawal->title }}</td>
                                <td>{{ date('d/m/Y', strtotime($withdrawal->date_transfer)) }}</td>
                                <td>{{ $withdrawal->source }}</td>
                                <td>{{ number_format($withdrawal->value, 2, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" style="text-align: right;">Total:</td>
                            <td>{{ formatCurrencyBR($caixa_withdrawals[$month]) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        @endforeach
    </div>
</body>

</html>
