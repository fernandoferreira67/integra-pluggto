<?php

namespace App\Imports;

use App\Models\Olist;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class OlistImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        Log::info('SKU:'. $row['sku_erp']);

        return new Olist([
          'product_name'          => $row['product_name'],
          'sku'                   => $row['sku'],
          'sku_erp'               => $row['sku_erp'],
          'sku_pluggto'           => null,
          'store'                 => 'OLIST MAYA 141',
          'sync'                  => null,
        ]);
    }
}
