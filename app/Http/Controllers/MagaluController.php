<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Magalu;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Imports\MagaluImport;
use App\Exports\MagaluExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class MagaluController extends Controller
{
  private $magalu;
  private $product;

  public function __construct(Magalu $magalu, Product $product)
  {
    $this->magalu = $magalu;
    $this->product = $product;
  }

  public function index(Request $request)
  {

    $filter['not_search'] =  $this->magalu::where('sync','N')->get();
    $filter['sync'] =  $this->magalu::where('sync','OK')->get();
    $filter['not_sync'] =  $this->magalu::whereNull('sync')->orWhere('sync', '')->get();

    if($request->search){
      //dd($request->search);
      $dataset =  $this->magalu::where('sync','N')
                                 ->Where('external_sku', 'like', '*'.$request->search.'%')
                                 ->orderBy('external_sku', 'asc')
                                 ->get();

      return view('sheets.magalu.index', ['data' => $dataset, 'filter' => $filter]);
    }

    $dataset = $this->magalu->all();
    return view('sheets.magalu.index', ['data' => $dataset, 'filter' => $filter]);
  }

  public function import(Request $request)
  {
    $arquivo = $request->file;

    if($arquivo) {

        Excel::import(new MagaluImport, $arquivo);
        return redirect()->route('magalu.index');
    }

    return redirect()->back();
  }

  public function export()
  {
      if( count($this->magalu::where('sync','OK')->get()) > 1) {
          return Excel::download(new MagaluExport, 'magalu.xlsx');

          return redirect()->route('magalu.index');
      }

      return redirect()->route('magalu.index');
  }

  /*
  Gerar correlação dos skus com pluggto
  */
  public function interconnection()
  {
    $products =  $this->product->all();
    $magalu = $this->magalu->all();

    foreach ($magalu as $i => $value) {

      $sku_sheets = $value->external_sku;
      $sku =  $this->checkSku($value->external_sku);

        if($sku->count()){
          $param = [
            "pluggto_sku" => '*'. $sku[0]->sku_pluggto,
            "pluggto_parent_sku" => '*'. $sku[0]->sku_pluggto,
            "sync"  => 'OK',
          ];

          $value->update($param);
          Log::notice('[ '.$sku_sheets .' ] SKU Correlacionado: '. $sku[0]->sku_pluggto);
          continue;

        }else{
          Log::error($value->external_sku);
          $value->update(["sync" => 'N']);
          continue;
        }
    }
    return redirect()->route('magalu.index');
  }

  /*
  *Comparar correlação do sku da magalu com pluggto
  *return: sku da pluggto
  */
  public function checkSku($sku)
  {
    $result = DB::table('products')->where('sku_gvm', '=', Str::replace('*', '', $sku))->get();
    return $result;
  }

  public function newDatabase() {

    if( count($this->magalu->all()) > 1) {
        $this->magalu->query()->delete();
        return redirect()->route('magalu.index');
    }

    return redirect()->route('magalu.index');
  }

}
