<?php

namespace App\Exports;

use App\Models\Consult;
use Maatwebsite\Excel\Concerns\FromCollection;

class ConsultExport implements FromCollection
{
    
    public function collection()
    {
    	//dd(Consult::all());
        return Consult::all();
    }
}
