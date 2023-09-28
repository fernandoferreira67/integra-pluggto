<?php

namespace App\Exports;

use App\Models\Shopee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ShopeeExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
      return Shopee::where('sync', 'OK')->get();
    }

    public function headings():array {

      return [
          'pluggto_sku',
          'external_sku',
        ];
    }

  public function map($line):array {

      return [
          $line->pluggto_sku,
          $line->external_sku,
      ];
  }
}
