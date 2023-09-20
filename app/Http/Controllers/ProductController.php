<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Gvm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


//use App\Exports\ProductsExport;
use App\Imports\ProductImport;
use App\Imports\GvmImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    private $product;
    private $gvm;
    /**
     * Display a listing of the resource.
     */

    public function __construct(Product $product, Gvm $gvm)
    {
      $this->product = $product;
      $this->gvm = $gvm;
    }

    public function index(Request $request)
    {

      $integration = $this->product::where('sync_api',null)->get();
      $gvm = $this->product::where('sku_gvm', null)->get();

      if($request->search){
        //$products = $this->product::where('sku_gvm', null)->get();
        $products = $this->product::where('sku_pluggto', 'SYNC')->get();
        return view('products.index', ['data' => $products, 'gvm' => $gvm, 'integration'=> $integration]);
      }

      $products = $this->product::where('sync_api','OK')->paginate(50);
      $integration = $this->product::where('sync_api',null)->get();
      $gvm = $this->product::where('sku_gvm', null)->get();

      return view('products.index', ['data' => $products, 'gvm' => $gvm, 'integration'=> $integration]);
    }


    public function import(Request $request)
    {
      $arquivo = $request->file;
      $type = $request->type;

      if($arquivo && $type==1) {

            Log::info('Robo: ***** Importando Produto ******');
            Excel::import(new ProductImport, $arquivo);

            return redirect()->route('products.index');
        }

      if($arquivo && $type==2) {
        Excel::import(new GvmImport, $arquivo);

        return redirect()->route('products.index');
        }

        //flash('Erro ao importar planilha, tente novamente!')->error();
        return redirect()->route('products.index');
    }


    public function readApi()
    {
      //$products = $this->product->all();
      $products = $this->product::where('sync_api', null)->limit(50)->get();

      Log::info('Robo: ***** Importando Produto da API ******');

      //dd($products);

      foreach($products as $value)
      {
        $this->searchSkuApi($value->id_gvm);
        dump($value->id_gvm);
      }

      return redirect()->route('products.index');
    }

    public function forceSync()
    {
      $products = $this->product::where('sku_pluggto', 'SYNC')->limit(50)->get();

      Log::info('Robo: ***** Forçando a importação de SKU com a API Plugg.to******');

      //dd($products);

      foreach($products as $value)
      {
        $this->searchSkuApi($value->id_gvm);
        dump($value->id_gvm);
      }

      return redirect()->route('products.index');
    }

    public function searchSkuApi($id_gvm)
    {
      $sku_pluggto = $id_gvm.'p';

      $response = Http::withToken('f295d810e9ba9a3a05fa80bb68b9a6d7468a07d2')->get('https://api.plugg.to/skus/'. $sku_pluggto);

      $data = json_decode( (string) $response->getBody(), true );

      //dd($data);

      if(!isset($data['error'])){

          $params = [
            'sku_pluggto' => $data['Product']['sku'],
            'sync_api'    =>  'OK',
            //'product_name' => $data['Product']['name'],
          ];

          //$recordSet = DB::table('products')->where('id_gvm', '=', $id_gvm)->get();
          $affected = DB::table('products')->where('id_gvm', '=', $id_gvm)->update($params);

          if($affected){
            Log::notice($data['Product']['sku'].' SKU importado');
            //dd('Sku importado lista');
            return;
          }else{
            Log::notice($data['Product']['sku'].' SKU já na lista.');
            //dd('Sku já na lista');
            return;
          }

        }else{
          DB::table('products')->where('id_gvm', '=', $id_gvm)->update(['sync_api' =>  'N']);
          Log::error($sku_pluggto .' SKU não encontrado na API.');
          return;
        }
    }

    public function productSync()
    {

      $products = $this->product::where('sku_gvm', null)->get();

      Log::info('Robo: ***** Correlacionando Skus da GVM ******');

      foreach ($products as $product){

        $value = DB::table('gvm')->where('id_gvm', '=', $product->id_gvm)->get();

        if($value->count()){

          $params = [
            'sku_gvm' => $value['0']->sku_gvm,
            'product_name' => $value['0']->product_name,
          ];

          $affected = DB::table('products')->where('id_gvm', '=', $product->id_gvm)->update($params);

          if($affected){
            Log::notice($value['0']->sku_gvm.' SKU importado');
            continue;
          }else{
            Log::notice($value['0']->sku_gvm.' SKU já na lista.');
            continue;
          }
        }
        Log::error('ID não encontrado.');
      }
      return redirect()->route('products.index');
    }

}
