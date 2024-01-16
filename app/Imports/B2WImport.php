<?php

namespace App\Imports;

use App\Models\B2W;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class B2WImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
      Log::info('SKU:'. $row['b2w_sku']);

        return new B2W([
          'pluggto_sku'           => null,
          'sku'                   => $row['b2w_sku'],
          'channel_store'         => 'B2W_BORDA BORDADOS',
          'sync'                  => null,
          'status'                => null,
        ]);
    }
}
