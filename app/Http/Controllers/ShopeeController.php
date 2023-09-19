<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Shopee;
use Illuminate\Http\Request;
use App\Imports\ShopeeImport;
use App\Exports\ShopeeExport;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ShopeeController extends Controller
{
    private $shopee;
    private $product;

    public function __construct(Shopee $shopee, Product $product)
    {
      $this->shopee = $shopee;
      $this->product = $product;
    }

    public function index()
    {
      $dataset = $this->shopee->all();
      $filter =  $this->shopee::where('sync','N')->get();
      return view('sheets.shopee.index', ['data' => $dataset, 'filter' => $filter]);
    }

    public function import(Request $request)
    {
      $arquivo = $request->file;

      if($arquivo) {

            Excel::import(new ShopeeImport, $arquivo);
            return redirect()->route('shopee.index');

        }
        Log::error('Erro ao adicionar dados na database!');
        return redirect()->back();
    }

    public function export()
    {
        if( count($this->shopee->all()) > 1) {
            return Excel::download(new ShopeeExport, 'shopeedepara.xlsx');
            return redirect()->route('shopee.index');
        }
        return redirect()->route('shopee.index');
    }


    public function interconnection()
    {
        $products =  $this->product->all();
        $shopee = $this->shopee->all();

        foreach ($shopee as $value) {

          $sku_sheets = $value->pluggto_sku;
          $sku =  $this->checkSku($value->pluggto_sku);


          if($sku->count()){

            $value->update(["pluggto_sku" => '*'. $sku[0]->sku_pluggto]);

            Log::notice('[ '.$sku_sheets .' ] SKU Correlacionado: '. $sku[0]->sku_pluggto);
            continue;

            }else{
              //Log::error('[ '.$value->pluggto_sku.'] SKU Não encontrado');
                 // $value->update(["sync" => 'N', "pluggto_sku" => $value->pluggto_sku.'/N.E' ]);
              Log::error($value->pluggto_sku);
              $value->update(["sync" => 'N']);
              continue;
            }
        }
        return redirect()->route('shopee.index');
    }

      /*
      Comparar correlação do sku da magalu com pluggto
      return: sku da pluggto
      */
    public function checkSku($sku)
    {
      $result = DB::table('products')->where('sku_gvm', '=', Str::replace('*', '', $sku))->get();

      return $result;
    }


    public function newDatabase() {

      if( count($this->shopee->all()) > 1) {
          $this->shopee->query()->delete();
          return redirect()->route('shopee.index');
      }

      return redirect()->route('shopee.index');
  }

}
