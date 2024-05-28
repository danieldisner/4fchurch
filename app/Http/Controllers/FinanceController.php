<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Finance;
use Carbon\Carbon;

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
}
