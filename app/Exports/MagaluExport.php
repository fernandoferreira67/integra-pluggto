<?php

namespace App\Exports;

use App\Models\Magalu;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


class MagaluExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
      return Magalu::where('sync','OK')->get();
    }

    public function headings():array {

      return [
          'pluggto_sku',
          'pluggto_parent_sku',
          'external_code',
          'external_sku',
          'external_parent_sku',
        ];
    }

  public function map($line):array {

      return [
          $line->pluggto_sku,
          $line->pluggto_parent_sku,
          $line->external_code,
          $line->external_sku,
          $line->external_parent_sku,
      ];
  }
}
