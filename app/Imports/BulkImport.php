<?php

namespace App\Imports;

use App\Bulk;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Resource;

class BulkImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {


        return new Resource([
            'title'   => $row[0],
            'phone'   => $row[1],
            'category'    => $row[2],
            'city'  => $row[3],
            'district'   => $row[4],
            'state'    => $row[5],
            'body'  => $row[6],
        ]);
    }
}
