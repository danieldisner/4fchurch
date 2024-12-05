<?php

namespace App\Exports;

use App\Models\Finance;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Carbon\Carbon;

class FinanceExport implements FromView
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function view(): View
    {
        $entries = Finance::whereBetween('date_transfer', [$this->startDate, $this->endDate])
            ->where('transaction_type', 'Entrada')
            ->orderBy('date_transfer')
            ->get()
            ->groupBy(function($date) {
                return Carbon::parse($date->date_transfer)->format('m-Y');
            });

        $withdrawals = Finance::whereBetween('date_transfer', [$this->startDate, $this->endDate])
            ->where('transaction_type', 'Saída')
            ->orderBy('date_transfer')
            ->get()
            ->groupBy(function($date) {
                return Carbon::parse($date->date_transfer)->format('m-Y');
            });

        $caixa_entries = $entries->map(function ($month) {
            return $month->where('source', 'Caixa')->sum('value');
        });
        $caixa_withdrawals = $withdrawals->map(function ($month) {
            return $month->where('source', 'Caixa')->sum('value');
        });
        $banco_entries = $entries->map(function ($month) {
            return $month->where('source', 'Banco')->sum('value');
        });
        $banco_withdrawals = $withdrawals->map(function ($month) {
            return $month->where('source', 'Banco')->sum('value');
        });

        $caixa_total = $caixa_entries->sum() - $caixa_withdrawals->sum();
        $banco_total = $banco_entries->sum() - $banco_withdrawals->sum();

        return view('finances.export', [
            'entries' => $entries,
            'withdrawals' => $withdrawals,
            'caixa_entries' => $caixa_entries,
            'caixa_withdrawals' => $caixa_withdrawals,
            'banco_entries' => $banco_entries,
            'banco_withdrawals' => $banco_withdrawals,
            'caixa_total' => $caixa_total,
            'banco_total' => $banco_total,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate
        ]);
    }
}
