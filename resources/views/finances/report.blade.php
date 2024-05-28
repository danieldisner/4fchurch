<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Finanças</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 0.8rem;
            /* Tamanho da fonte geral */
        }

        h1 {
            font-size: 1.2rem;
            /* Tamanho da fonte do título */
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        table {
            border-collapse: collapse;
            margin-bottom: 10px;
            font-size: 0.7rem;
            /* Tamanho da fonte das tabelas */
            width: 100%;
            /* Definindo largura total para as tabelas */
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
        }

        .header img {
            max-height: 40px;
            /* Redução da altura da imagem */
        }

        .header .info {
            font-size: 0.8rem;
            text-align: right;
        }

        .container {
            margin: 1rem;
            text-align: center;
        }

        .table-container {
            width: 48%;
            /* Largura das tabelas */
            float: left;
            /* Adicionando float left */
            margin: 5px;
        }

        .saldo {
            text-align: center;
            background-color: #f2f2f2;
            font-size: 1.2rem;
            /* Tamanho da fonte do saldo */
            font-weight: bold;
            margin-top: 10px;
            /* Ajustando para ocupar o mesmo espaço das tabelas */
            width: calc(100% - 5px);
            /* Definindo largura total */
            box-sizing: border-box;
            /* Considerando padding e borda na largura */
            clear: both;
            /* Limpa o float */
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ $logoPath }}" alt="Logo do Sistema">
        <div class="info">
            <div>{{ Auth::user()->name }}</div>
            <div>{{ Auth::user()->email }}</div>
            <div>Data de Emissão: <?php echo date('d/m/Y'); ?></div>
        </div>
    </div>
    <h1>Relatório de Finanças</h1>
    <div class="container">
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
                    @foreach ($entries as $entry)
                        <tr class="">
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
                        <td class="total">{{ formatCurrencyBR($entries->sum('value')) }}</td>
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
                    @foreach ($withdrawals as $withdrawal)
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
                        <td class="total">{{ formatCurrencyBR($withdrawals->sum('value')) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="saldo">
            <div>Saldo em Caixa: R$ {{ formatCurrencyBR($caixa_total) }}</div>
            <div>Saldo em Banco: R$ {{ formatCurrencyBR($banco_total) }}</div>
            <div>Saldo Total: R$
                {{ formatCurrencyBR($entries->sum('value') - $withdrawals->sum('value')) }}</div>
        </div>
    </div>


</body>

</html>
