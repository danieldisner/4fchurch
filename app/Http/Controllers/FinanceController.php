<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Finance;

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
        $date = $request->input('date');
        $month = date('m', strtotime($date));
        $year = date('Y', strtotime($date));

        $entradas = Finance::whereYear('date_transfer', $year)
            ->whereMonth('date_transfer', $month)
            ->where('transaction_type', 'Entrada')
            ->get();

        $saidas = Finance::whereYear('date_transfer', $year)
            ->whereMonth('date_transfer', $month)
            ->where('transaction_type', 'Saída')
            ->get();

        return response()->json([
            'entradas' => $entradas,
            'saidas' => $saidas,
        ]);
    }
}
