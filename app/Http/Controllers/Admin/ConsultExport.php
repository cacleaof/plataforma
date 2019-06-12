<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class ConsultExport implements FromCollection
{
    
    public function collection()
    {
        return User::all();
    }
}
