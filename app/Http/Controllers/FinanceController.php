<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Finance;
use Carbon\Carbon;
use App\Exports\FinanceExport;
use Illuminate\Support\Facades\DB;

class FinanceController extends Controller
{
    public function index()
    {
        return view('finances.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'transaction_type' => 'required|string',
            'title' => 'required|string',
            'source' => 'required|string',
            'date_transfer' => 'required|date',
            'value' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        Finance::create($request->all());

        return response()->json(['success' => 'Transaction added successfully']);
    }

    public function fetchData(Request $request)
    {
        $user = Auth::user();

        $editPermission = $user->hasAnyPermission(['edit']);
        $deletePermission = $user->hasAnyPermission(['delete']);

        $date = $request->input('date');
        $month = date('m', strtotime($date));
        $year = date('Y', strtotime($date));

        $entries = Finance::whereYear('date_transfer', $year)
            ->whereMonth('date_transfer', $month)
            ->where('transaction_type', 'Entrada')
            ->get();

        $withdrawals = Finance::whereYear('date_transfer', $year)
            ->whereMonth('date_transfer', $month)
            ->where('transaction_type', 'Saída')
            ->get();

        return response()->json([
            'entradas' => $entries,
            'saidas' => $withdrawals,
            'permissions' => [
                'edit' => $editPermission,
                'delete' => $deletePermission,
            ],
        ]);
    }

    public function update(Request $request, $id)
    {
        $dateTransfer = $request->date_transfer;
        if (preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $dateTransfer)) {
            try {
                $dateTransfer = Carbon::createFromFormat('d/m/Y', $dateTransfer)->format('Y-m-d');
            } catch (\Exception $e) {
                return response()->json(['error' => 'Formato de data inválido. O formato correto é DD/MM/YYYY ou YYYY-MM-DD.'], 422);
            }
        }
        $finance = Finance::find($id);
        $finance->date_transfer = $dateTransfer;
        $finance->update($request->only([
            'transaction_type',
            'title',
            'source',
            'value',
            'description',
        ]));
        return response()->json(['success' => 'Transaction updated successfully']);
    }

    public function destroy($id)
    {
        $finance = Finance::findOrFail($id);
        $finance->delete();

        return response()->json(['success' => 'Registro removido com sucesso']);
    }
    public function report(Request $request, $view = true)
    {
        $date = $request->input('date');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if ($date) {
            $startDate = date('Y-m-01', strtotime($date));
            $endDate = date('Y-m-t', strtotime($date));
        }

        $entries = Finance::whereBetween('date_transfer', [$startDate, $endDate])
            ->where('transaction_type', 'Entrada')
            ->get();

        $withdrawals = Finance::whereBetween('date_transfer', [$startDate, $endDate])
            ->where('transaction_type', 'Saída')
            ->get();

        $caixa_entries = $entries->where('source', 'Caixa')->sum('value');
        $caixa_withdrawals = $withdrawals->where('source', 'Caixa')->sum('value');
        $banco_entries = $entries->where('source', 'Banco')->sum('value');
        $banco_withdrawals = $withdrawals->where('source', 'Banco')->sum('value');
        $caixa_total = $caixa_entries - $caixa_withdrawals;
        $banco_total = $banco_entries - $banco_withdrawals;

        $logoPath = $view ? asset('storage\company\default.png') : public_path('storage\company\default.png');

        return view('finances.report', compact('caixa_total', 'banco_total', 'entries', 'withdrawals','startDate', 'endDate',  'logoPath'));
    }


    public function exportPdf(Request $request)
    {
        $view = $this->report($request, false)->render();
        $pdf = PDF::loadHTML($view);
        return $pdf->download('relatorio_financeiro_' . date('m_Y', strtotime($request->input('date'))) . '.pdf');
    }

    public function exportCsv(Request $request)
    {
        $date = $request->input('date');
        return Excel::download(new FinanceExport($date), 'relatorio_financeiro_' . date('m_Y', strtotime($date)) . '.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    public function exportExcel(Request $request)
    {
        $date = $request->input('date');
        return Excel::download(new FinanceExport($date), 'relatorio_financeiro_' . date('m_Y', strtotime($date)) . '.xlsx');
    }

    public function printReport(Request $request)
    {
        return $this->report($request);
    }

    public function dashboard(Request $request)
    {
        $startDate = $request->input('start_date') ?: now()->startOfYear()->format('Y-m-d');
        $endDate = $request->input('end_date') ?: now()->endOfYear()->format('Y-m-d');

        $titlesData = Finance::whereBetween('date_transfer', [$startDate, $endDate])
                            ->whereIn('transaction_type', ['Entrada', 'Saída'])
                            ->groupBy('title', 'transaction_type')
                            ->selectRaw('title, transaction_type, SUM(value) as total')
                            ->get();

        $entriesData = $this->normalizeAndGroupEntries($titlesData);
        $expensesData = $this->normalizeAndGroupExpenses($titlesData);

        $groupedEntriesData = $this->groupTopFour($entriesData);
        $groupedExpensesData = $this->groupTopFour($expensesData);

        $saldoData = Finance::whereBetween('date_transfer', [$startDate, $endDate])
                            ->whereIn('source', ['Banco', 'Caixa'])
                            ->selectRaw('source, SUM(CASE WHEN transaction_type = "Entrada" THEN value ELSE -value END) as saldo')
                            ->groupBy('source')
                            ->pluck('saldo', 'source');

        return view('finances.dashboard', [
            'entriesData' => $groupedEntriesData,
            'expensesData' => $groupedExpensesData,
            'saldoBanco' => $saldoData['Banco'] ?? 0,
            'saldoCaixa' => $saldoData['Caixa'] ?? 0,
            'startDate' => $startDate,
            'endDate' => $endDate
        ]);
    }

    private function normalizeAndGroupEntries($data)
    {
        $groupedData = [];

        foreach ($data as $item) {
            if ($item->transaction_type === 'Entrada') {
                $normalizedTitle = $this->normalizeString($item->title);

                if (!isset($groupedData[$normalizedTitle])) {
                    $groupedData[$normalizedTitle] = [
                        'title' => $item->title,
                        'total' => 0
                    ];
                }

                $groupedData[$normalizedTitle]['total'] += $item->total;
            }
        }

        return array_values($groupedData);
    }

    private function normalizeAndGroupExpenses($data)
    {
        $groupedData = [];

        foreach ($data as $item) {
            if ($item->transaction_type === 'Saída') {
                $normalizedTitle = $this->normalizeString($item->title);
                $categoryKey = $this->identifyPrefix($normalizedTitle);

                if (!isset($groupedData[$categoryKey])) {
                    $groupedData[$categoryKey] = [
                        'title' => ucfirst($categoryKey),
                        'total' => 0
                    ];
                }

                $groupedData[$categoryKey]['total'] += $item->total;
            }
        }

        return array_values($groupedData);
    }

    private function normalizeString($string)
    {
        $string = strtolower($string);
        $string = str_replace(
            ['á', 'é', 'í', 'ó', 'ú', 'ã', 'õ', 'ç', 'à', 'è', 'ì', 'ò', 'ù', 'ä', 'ë', 'ï', 'ö', 'ü'],
            ['a', 'e', 'i', 'o', 'u', 'a', 'o', 'c', 'a', 'e', 'i', 'o', 'u', 'a', 'e', 'i', 'o', 'u'],
            $string
        );
        return preg_replace('/[^a-z0-9 ]+/', '', $string);
    }

    private function identifyPrefix($string)
    {
        $prefixes = [
            'despesas' => ['despesa', 'despesas'],
            'pagamentos' => ['pagamento', 'pagamentos'],
            'entradas' => ['entrada', 'entradas'],
            'contas' => ['conta', 'contas'],
            'materiais' => ['material', 'materiais'],
            'outros' => ['outros']
        ];

        foreach ($prefixes as $key => $values) {
            foreach ($values as $value) {
                if (strpos($string, $value) === 0) {
                    return $key;
                }
            }
        }
        return 'outros';
    }

    private function groupTopFour($data)
    {
        usort($data, function ($a, $b) {
            return $b['total'] <=> $a['total'];
        });

        $topFour = array_slice($data, 0, 4);
        $others = array_slice($data, 4);

        $othersTotal = array_sum(array_column($others, 'total'));

        if ($others) {
            $topFour[] = [
                'title' => 'Outros',
                'total' => $othersTotal
            ];
        }
        return $topFour;
    }

}
