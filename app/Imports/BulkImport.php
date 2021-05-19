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
            'id'  => $row[0],
            'category'   => $row[1],
            'title'   => $row[2],
            'body'    => $row[3],
            'phone'  => $row[4],
            'url'   => $row[5],
            'author_id'    => $row[6],
            'verified'  => $row[7],
            'verified_by'   => $row[8],
            
        ]);
    }
}
