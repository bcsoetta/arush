<?php

namespace App\Exports;

use App\Dokumen;
use Maatwebsite\Excel\Concerns\FromCollection;

class DokumenExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Dokumen::all();
    }
}
