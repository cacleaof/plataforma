<?php

namespace App\Exports;

use App\Models\Consult;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ConsultExport implements FromCollection, WithHeadings
{
    
    public function collection()
    {
    	//dd(Consult::all());
        return Consult::all();
    }
    public function headings(): array
    {
        return [
            'DATA CRIAÇÃO',
            'DATA UPDATE',
            'ID',
            'USER ID',
            'SERVIÇO',
            'CONSULTA',
            'CONSULTA REPLICA',
            'CONSULTA TREPLICA',
            'CONVENIO',
            'MUNICIPIO',
            'IBGE',
            'UF',
            'STATUS',
            'NOME DO SOLICITANTE',
            'NOME DO REGULADOR',
            'ID DO REGULADOR',
            'NOME DO CONSULTOR',
            'ID DO CONSULTOR',
            'TEMPO',
            'SOLICITAÇÃO',
            'ATIVO',
            'PACIENTE',
            'IDADE',
            'QUEIXA',
            'INSTITUIÇÃO',
            'MUNICIPIO DO SOLICITANTE',
            'AREA',
            'IBGE DO SOLICITANTE',
            'ANEXOS',
            'DEVOLUTIVA',
            'DEVOLUTIVA CONSULTOR',
            'DEVOLUTIVA REGULADOR',
            'RESPOSTA',
            'REPLICA',
            'TREPLICA',
            'L RECOMENDA',
            'CIAP',
            'DEC1',
            'DEC2',
            'DEC3',
            'AVALIAÇÃO DUVIDA',
            'AVALICAÇÃO',
            'AVALIAÇÃO COMENTARIO',
        ];
    }
}
