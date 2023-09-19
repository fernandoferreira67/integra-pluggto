<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Gvm;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;


class ProductImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $product = Product::where('id_gvm', $row['id_gvm'])->get();

        if(count($product)){
          Log::warning('ID já cadastro SKU:'. $row['sku_gvm']);

          //dd('caiu no if');
        }else{
          //dd('caiu no else');
          Log::notice('Produto importado:'. $row['sku_gvm']);
          return new Product([

            'id_gvm'        => isset($row['id_gvm']) ? $row['id_gvm'] : 'id_gvm',
            'sku_gvm'       => isset($row['sku_gvm']) ? $row['sku_gvm'] : 'sku_gvm',
            'sku_pluggto'   => isset($row['sku_pluggto']) ? $row['sku_pluggto'] : 'SYNC',
            'product_name'  => isset($row['product_name']) ? $row['product_name'] : 'product_name',
          ]);
        }
    }
}
