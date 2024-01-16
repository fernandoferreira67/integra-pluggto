<?php

namespace App\Imports;

use App\Models\Shein;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;

class SheinImport implements  ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Shein([
            'pluggto_sku'             => $row['pluggto_sku'],
            'pluggto_parent_sku'      => $row['pluggto_parent_sku'],
            'marketplace_sku'         => $row['marketplace_sku'],
            'marketplace_parent_sku'  => $row['marketplace_parent_sku'],
            'channel_store'           => 'Shein',
        ]);
    }
}
