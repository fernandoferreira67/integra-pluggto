<?php

namespace App\Exports;

use App\Models\Olist;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


class OlistExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

      return Olist::where('sync','OK')->get();

    }

    public function headings():array {

      return [
          'Sku PluggTo',
          'Parent Sku PluggTo',
          'Sku Marketplace',
        ];
    }

    public function map($line):array {

        return [
            $line->sku_pluggto,
            $line->sku_pluggto,
            '*'.$line->sku,
        ];
    }
}
