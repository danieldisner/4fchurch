<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Finance;
use Carbon\Carbon;
use App\Exports\FinanceExport;
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
    public function report(Request $request , $view = true)
    {
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

        $caixa_entries = $entries->where('source', 'Caixa')->sum('value');
        $caixa_withdrawals = $withdrawals->where('source', 'Caixa')->sum('value');
        $banco_entries = $entries->where('source', 'Banco')->sum('value');
        $banco_withdrawals = $withdrawals->where('source', 'Banco')->sum('value');
        $caixa_total = $caixa_entries - $caixa_withdrawals;
        $banco_total = $banco_entries - $banco_withdrawals;

        // By default, is view, the logo is stored in storage/company/default.png
        // If view is false, will use the public path of the logo to render in the PDF
        $logoPath = $view ? asset('storage\company\default.png') : public_path('storage\company\default.png');

        return view('finances.report', compact('caixa_total', 'banco_total', 'entries', 'withdrawals', 'month', 'year', 'logoPath'));
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
}
