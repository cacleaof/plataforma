<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin;
use App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use DB;
use Excel;

class ExportExcelController extends Controller
{
   function index()
    {
     $consults_data = DB::table('consults')->get();
     return view('export_excel')->with('consults_data', $consults_data);
    }

    function excel()
    {
     $consults_data = DB::table('consults')->get()->toArray();
     $consults_array[] = array('Consulta', 'Data', 'Cidade', 'Solicitante', 'Paciente');
     foreach($consults_data as $consults)
     {
      $consults_array[] = array(
       'Consulta'  => $consults->consulta,
       'Data'   => $consults->created_at,
       'Cidade'    => $consults->municipio,
       'Solicitante'  => $consults->sol_name,
       'Paciente'   => $consults->paciente
      );
     }
     Excel::store(new ConsultExport(), 'dados.xlsx');
     //\Excel::create('Dados das Consultorias', function($excel) use ($consults_array){
     // $excel->setTitle('Dados das Consultorias');
     // $excel->sheet('Consultorias', function($sheet) use ($consults_array){
     // $sheet->fromArray($consults_array, null, 'A1', false, false);
     // });
     //})->download('xlsx');
         }// //
}
