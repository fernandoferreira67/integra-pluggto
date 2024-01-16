<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Shein;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Imports\SheinImport;
use App\Exports\SheinExport;
use Maatwebsite\Excel\Facades\Excel;


class SheinController extends Controller
{

    private $product;
    private $shein;

    public function __construct(Product $product, Shein $shein)
    {
      $this->product = $product;
      $this->shein = $shein;
    }

    public function index(Request $request)
    {
      $filter['no_sync'] = $this->shein::where('sync', null)->get();

      if($request->search){

        $products = $this->shein::where('pluggto_sku', null)
                            //Where('sku_erp', 'like', '*'.$request->search.'%')
                          //->orderBy('pluggto_sku', 'asc')
                          ->get();

        return view('sheets.shein.index', ['data' => $products, 'filter' => $filter]);
      }

      $products = $this->shein::orderBy('pluggto_sku', 'asc')->get();
      //$products = $this->shein::where('sync','OK')->get();
      return view('sheets.shein.index', ['data' => $products, 'filter' => $filter]);

    }

    public function import(Request $request)
    {
      $arquivo = $request->file;

      if($arquivo) {
          Excel::import(new SheinImport, $arquivo);
          return redirect()->route('shein.index');
      }

      return redirect()->back();
    }

    public function export()
    {
        if( count($this->shein::where('sync','OK')->get()) > 1) {
            return Excel::download(new SheinExport, 'shein_export_'.now().'.xlsx');

            return redirect()->route('shein.index');
        }

        return redirect()->route('shein.index');
    }

    public function newDatabase() {

      if( count($this->shein->all()) > 1) {
          $this->shein->query()->delete();
          return redirect()->route('shein.index');
      }

      return redirect()->route('shein.index');
    }

    /*
    * Gerar correlação dos skus com pluggto
    */
    public function interconnection()
    {
      $shein = $this->shein::where('sync', null)->get();

      foreach ($shein as $value) {

        $sku_sheets = $value->pluggto_sku;
        $sku = $this->checkSku($value->pluggto_sku);

        if($sku->count()){

          $param = [
            "pluggto_sku" => '*'. $sku[0]->sku_pluggto,
            "sync"  => 'OK',
          ];

          $value->update($param);
          Log::notice('[ '.$sku_sheets .' ] SKU Correlacionado: '. $sku[0]->sku_pluggto);
          continue;

        }else{
          Log::error($value->pluggto_sku);
          $value->update(["sync" => 'NO SYNC']);
          continue;
        }
      }
      return redirect()->route('shein.index');
    }

    public function checkSku($sku)
    {
      $result = DB::table('products')->where('sku_gvm', '=', Str::replace('*', '', $sku))->get();
      return $result;
    }

}
