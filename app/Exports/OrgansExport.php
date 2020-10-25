<?php

namespace App\Exports;

use App\Organ;
use Maatwebsite\Excel\Concerns\FromCollection;

class OrgansExport implements FromCollection
{
    public function collection()
    {
        return Organ::all();
    }
}
