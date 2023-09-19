<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Olist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Imports\OlistImport;
use App\Exports\OlistExport;
use Maatwebsite\Excel\Facades\Excel;

class OlistController extends Controller
{
    private $product;
    private $olist;

    public function __construct(Product $product, Olist $olist)
    {
      $this->product = $product;
      $this->olist = $olist;
    }

    public function index(Request $request)
    {
      $filter['no_sync'] = $this->olist::where('sync', null)->get();

      if($request->search){

        $products = $this->olist::where('sku_pluggto', null)
                            //Where('sku_erp', 'like', '*'.$request->search.'%')
                          ->orderBy('sku_erp', 'asc')
                          ->get();

        return view('sheets.olist.index', ['data' => $products, 'filter' => $filter]);
      }

      $products = $this->olist::orderBy('sku_erp', 'asc')->get();
      //$products = $this->olist::where('sync','OK')->get();
      return view('sheets.olist.index', ['data' => $products, 'filter' => $filter]);

    }

    public function import(Request $request)
    {
      $arquivo = $request->file;

      if($arquivo) {
          Excel::import(new OlistImport, $arquivo);
          return redirect()->route('olist.index');
      }

      return redirect()->back();
    }

    public function export()
    {
        if( count($this->olist::where('sync','OK')->get()) > 1) {
            return Excel::download(new OlistExport, 'olist.xlsx');

            return redirect()->route('olist.index');
        }

        return redirect()->route('olist.index');
    }

    public function newDatabase() {

      if( count($this->olist->all()) > 1) {
          $this->olist->query()->delete();
          return redirect()->route('olist.index');
      }

      return redirect()->route('olist.index');
    }

    /*
    * Gerar correlação dos skus com pluggto
    */
    public function interconnection()
    {
      $olist = $this->olist::where('sync', null)->get();

      foreach ($olist as $value) {

        $sku_sheets = $value->sku_erp;
        $sku =  $this->checkSku($value->sku_erp);

        if($sku->count()){

          $param = [
            "sku_pluggto" => '*'. $sku[0]->sku_pluggto,
            "sync"  => 'OK',
          ];

          $value->update($param);
          Log::notice('[ '.$sku_sheets .' ] SKU Correlacionado: '. $sku[0]->sku_pluggto);
          continue;

        }else{
          Log::error($value->sku_erp);
          $value->update(["sync" => 'NO SYNC']);
          continue;
        }
      }
      return redirect()->route('olist.index');
    }

    public function checkSku($sku)
    {
      $result = DB::table('products')->where('sku_gvm', '=', $sku)->get();
      return $result;
    }

}
