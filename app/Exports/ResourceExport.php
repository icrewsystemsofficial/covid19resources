<?php

namespace App\Exports;

use App\Models\Resource;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class ResourceExport implements FromCollection ,WithMapping, WithTitle,WithHeadings
{
    
    public function collection()
    {
        return Resource::select('title','category','phone','city','district','state','created_at')
                        ->where('verified','=','1')->get();
    }

    public function map($resources) : array {
        return [
            $resources->title,
            $resources->phone,
            $resources->category_data->name,
            $resources->city,
            $resources->district,
            $resources->state,
            $resources->created_at->format('d/m/Y'),
        ];
    }

    public function headings(): array
    {
        return [
            'Title',
            'Phone',
            'Category',
            'City',
            'District',
            'State',
            'Created At'
        ];
    }

    public function title(): string
    {
        return 'Resources';
    }



}
