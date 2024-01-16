<?php

namespace App\Exports;

use App\Models\Shein;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SheinExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
      return Shein::where('sync', 'OK')->get();
    }

    public function headings():array {

      return [
          'pluggto_sku',
          'pluggto_parent_sku',
          'marketplace_sku',
          'marketplace_parent_sku'
        ];
    }

  public function map($line):array {

      return [
          $line->pluggto_sku,
          $line->pluggto_parent_sku,
          $line->marketplace_sku,
          $line->marketplace_parent_sku
      ];
  }
}
