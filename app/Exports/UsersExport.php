<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Spatie\Permission\Contracts\Role;

class UsersExport implements FromCollection ,WithMapping , WithTitle, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::select('name','email','state','district','created_at')->get();
    }

    public function map($users) : array {
        // $role = Role::findByName($users->role);
        return [
            $users->name,
            $users->email,
            $users->state,
            $users->created_at->format('d/m/Y'),
        ];
    }
    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'State',
            'Joined At'
        ];
    }


    public function title(): string
    {
        return 'Users';
    }

}
