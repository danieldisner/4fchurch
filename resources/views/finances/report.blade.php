<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Finanças - {{ formatDateBR($startDate) }} à {{ formatDateBR($endDate) }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 0.8rem;
        }

        h1 {
            font-size: 1.2rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
            margin-top: 0;
            text-align: center;
        }

        table {
            border-collapse: collapse;
            margin-bottom: 10px;
            font-size: 0.7rem;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 3px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        tfoot {
            font-weight: bold;
        }

        .total {
            text-align: center;
            background-color: #f2f2f2;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            padding: 10px;
            box-sizing: border-box;
        }

        .header img {
            max-height: 40px;
            margin-right: 10px;
        }

        .header .info {
            font-size: 0.8rem;
            text-align: right;
        }

        .container {
            margin: 1rem;
            text-align: center;
            page-break-inside: avoid;
        }

        .table-container {
            width: 48%;
            display: inline-block;
            vertical-align: top;
            margin-bottom: 10px;
        }

        .saldo {
            text-align: center;
            background-color: #f2f2f2;
            font-size: 1rem;
            font-weight: bold;
            margin-top: 10px;
            width: calc(100% - 10px);
            box-sizing: border-box;
            clear: both;
        }

        .resumo-container {
            clear: both;
            width: 100%;
            margin-top: 20px;
        }

        .resumo-container table {
            width: 100%;
            margin: auto;
        }

        .resumo-container th,
        .resumo-container td {
            border: 1px solid #ddd;
            padding: 5px;
            text-align: center;
        }

        .resumo-container th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="header">
        <img class="logo" src="{{ $logoPath }}" alt="Logo do Sistema">
        <div class="info">
            <div>{{ Auth::user()->name }}</div>
            <div>{{ Auth::user()->email }}</div>
            <div>Data de Emissão: {{ date('d/m/Y') }}</div>
        </div>
    </div>
    @foreach ($monthlyReports as $report)
        <div class="container">
            <h1 class="title">Relatório de Finanças - {{ translateMonthBR($report['month']) }}
            </h1>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th colspan="4">Entradas</th>
                        </tr>
                        <tr>
                            <th>Título</th>
                            <th>Data</th>
                            <th>Fonte</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($report['entries'] as $entry)
                            <tr>
                                <td>{{ $entry->title }}</td>
                                <td>{{ formatDateBR($entry->date_transfer) }}</td>
                                <td>{{ $entry->source }}</td>
                                <td>{{ formatCurrencyBR($entry->value) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="total">Total:</td>
                            <td class="total">{{ formatCurrencyBR($report['entries']->sum('value')) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th colspan="4">Saídas</th>
                        </tr>
                        <tr>
                            <th>Título</th>
                            <th>Data</th>
                            <th>Fonte</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($report['withdrawals'] as $withdrawal)
                            <tr>
                                <td>{{ $withdrawal->title }}</td>
                                <td>{{ formatDateBR($withdrawal->date_transfer) }}</td>
                                <td>{{ $withdrawal->source }}</td>
                                <td>{{ formatCurrencyBR($withdrawal->value) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="total">Total:</td>
                            <td class="total">{{ formatCurrencyBR($report['withdrawals']->sum('value')) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Saldo em Caixa</th>
                            <th>Saldo em Banco</th>
                            <th>Saldo Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>R$ {{ formatCurrencyBR($report['caixa_total']) }}</td>
                            <td>R$ {{ formatCurrencyBR($report['banco_total']) }}</td>
                            <td>R$
                                {{ formatCurrencyBR($report['entries']->sum('value') - $report['withdrawals']->sum('value')) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div style="page-break-after: always;"></div>
    @endforeach

    <div class="container">
        <h1 class="title">Resumo do Período de {{ formatDateBR($startDate) }} à {{ formatDateBR($endDate) }}</h1>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th colspan="3">Entradas</th>
                    </tr>
                    <tr>
                        <th>Caixa</th>
                        <th>Banco</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>R$ {{ formatCurrencyBR($totalEntradasCaixa) }}</td>
                        <td>R$ {{ formatCurrencyBR($totalEntradasBanco) }}</td>
                        <td>R$ {{ formatCurrencyBR($totalEntradas) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th colspan="3">Saídas</th>
                    </tr>
                    <tr>
                        <th>Caixa</th>
                        <th>Banco</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>R$ {{ formatCurrencyBR($totalSaidasCaixa) }}</td>
                        <td>R$ {{ formatCurrencyBR($totalSaidasBanco) }}</td>
                        <td>R$ {{ formatCurrencyBR($totalSaidas) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th colspan="3">Saldos</th>
                    </tr>
                    <tr>
                        <th>Caixa</th>
                        <th>Banco</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>R$ {{ formatCurrencyBR($totalEntradasCaixa - $totalSaidasCaixa) }}</td>
                        <td>R$ {{ formatCurrencyBR($totalEntradasBanco - $totalSaidasBanco) }}</td>
                        <td>R$ {{ formatCurrencyBR($saldoTotal) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
