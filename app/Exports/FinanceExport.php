<?php

namespace App\Exports;

use App\Models\Finance;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class FinanceExport implements FromView
{
    protected $date;

    public function __construct($date)
    {
        $this->date = $date;
    }

    public function view(): View
    {
        $month = date('m', strtotime($this->date));
        $year = date('Y', strtotime($this->date));

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

        return view('finances.export', [
            'caixa_total' => $caixa_total,
            'banco_total' => $banco_total,
            'entries' => $entries,
            'withdrawals' => $withdrawals,
            'month' => $month,
            'year' => $year
        ]);
    }
}
