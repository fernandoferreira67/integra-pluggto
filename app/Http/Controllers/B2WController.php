<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\B2W;
use App\Imports\B2WImport;
use App\Exports\B2WExport;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;


class B2WController extends Controller
{
  private $b2w;
  private $product;

  public function __construct(B2W $b2w, Product $product)
  {
    $this->b2w = $b2w;
    $this->product = $product;
  }

  public function index(Request $request)
  {

    $filter['not_search'] =  count($this->b2w::where('sync','N')->get());
    $filter['sync'] =  count($this->b2w::where('sync','OK')->get());
    $filter['waiting'] = count($this->b2w::whereNull('sync')->orWhere('sync', '')->get());
    $filter['all'] =  count($this->b2w::all());

    if($request->search){
      $dataset =  $this->b2w::where('sync','N')
                               ->orWhere('sku', 'like', '*'.$request->search.'%')
                               ->orderBy('sku', 'asc')
                               ->get();

      return view('sheets.b2w.index', ['data' => $dataset, 'filter' => $filter]);
    }

    $dataset = $this->b2w->all();
    return view('sheets.b2w.index', ['data' => $dataset, 'filter' => $filter]);
  }

  public function import(Request $request)
  {
    $arquivo = $request->file;

    if($arquivo) {
          Excel::import(new B2WImport, $arquivo);
          return redirect()->route('b2w.index');

      }
      Log::error('Erro ao adicionar dados na database!');
      return redirect()->back();
  }

  public function export(Request $request)
  {

      if((count($this->b2w->all()) > 1) && $request->option == 'SYNC')  {

          return Excel::download(new B2WExport($request->option), 'B2W-depara.xlsx');
          return redirect()->route('b2w.index');

      }elseif(count($this->b2w->all()) && $request->option == 'INACTIVE'){

          return Excel::download(new B2WExport($request->option), 'B2WInativos.xlsx');
          return redirect()->route('b2w.index');
      }

      return redirect()->route('b2w.index');
  }

  public function interconnection(Request $request)
    {
        if($request->force){
          $b2w = $this->b2w::where('sync', 'N')->get();
        }else{
          $b2w = $this->b2w->all();
        }

        foreach ($b2w as $value) {

          $sku_sheets = $value->sku;
          $sku =  $this->checkSku($value->sku);


          if($sku->count()){

            $param = [
              "pluggto_sku" => '*'. $sku[0]->sku_pluggto,
              "sync"  => 'OK',
            ];

            $value->update($param);
            Log::info('SKU Correlacionado DE:'.$sku_sheets .'/ PARA:'. $sku[0]->sku_pluggto);
            continue;

            }else{
              Log::error($value->sku);
              $value->update(["sync" => 'N']);
              continue;
            }
        }
        return redirect()->route('b2w.index');
    }

      /*
      Comparar correlação do sku da b2w com pluggto
      return: sku da pluggto
      */
    public function checkSku($sku)
    {
      $result = DB::table('products')->where('sku_gvm', '=', Str::replace('*', '', $sku))->get();
      return $result;
    }


    public function newDatabase() {

      if( count($this->b2w->all()) > 1) {
          $this->b2w->query()->delete();
          return redirect()->route('b2w.index');
      }

      return redirect()->route('b2w.index');
  }

}
