<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class Covid19MassExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            // '1' => new UsersExport,
            '1' => new ResourceExport,
        ];
    }
}
