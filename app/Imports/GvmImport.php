<?php

namespace App\Imports;

use App\Models\Gvm;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;

class GvmImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Gvm ([
          'id_gvm'        => isset($row['id_gvm']) ? $row['id_gvm'] : 'id_gvm',
          'sku_gvm'       => isset($row['sku_gvm']) ? $row['sku_gvm'] : 'sku_gvm',
          'product_name'  => isset($row['product_name']) ? $row['product_name'] : 'product_name',
        ]);

    }
}
