<?php

namespace App\Imports;

use App\Models\Magalu;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class MagaluImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
      Log::info('SKU:'. $row['external_sku']);
        return new Magalu([
            'pluggto_sku'          => $row['pluggto_sku'],
            'pluggto_parent_sku'   => $row['pluggto_parent_sku'],
            'external_code'        => $row['external_code'],
            'external_sku'         => $row['external_sku'],
            'external_parent_sku'  => $row['external_parent_sku']
        ]);
    }
}
