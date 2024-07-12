<?php

namespace App\Exports;

use App\Models\Mountain;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;


class MountainExport implements FromView
{
    public function view(): View
    {
        return view('exports.mountain', [
            'mountains' => Mountain::all()
        ]);
    }
}