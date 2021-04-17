<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class OrderExport implements FromView, ShouldAutoSize
{
    public function __construct(Collection $orders)
    {
        $this->orders=$orders;
    }
    public function view(): View
    {
        return view('exports.orders', [
            'orders' => $this->orders
        ]);
    }
}
