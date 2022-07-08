<?php

namespace App\Exports;

use App\Models\Company;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportCompany implements FromCollection,WithHeadings
{
    public function headings(): array
    {
        return [
            '#',
            'company_name',
            'company_name_kana',
            'register_name',
            'register_name_kana',
            'city',
            'district',
            'room',
            'building',
            'zip_code',
            'hp_url',
            'email',
            'contact_name',
            'career',
            'phone',
            'status',
            'area_intends_to_recuit',
            'note',
            'created_at',
            'updated_at',

        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Company::all();
    }
}
