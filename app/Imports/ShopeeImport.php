<?php

namespace App\Imports;

use App\Models\Shopee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;

class ShopeeImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Shopee([
            'pluggto_sku'          => $row['pluggto_sku'],
            'external_sku'         => $row['external_sku'],
        ]);
    }
}
