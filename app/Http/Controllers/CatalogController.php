<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Catalog;
use App\Models\Supplier;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Imports\CatalogImport;
use App\Exports\CatalogExport;
use App\Exports\CatalogAllExport;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Arr;
use Illuminate\Support\Env;
use Illuminate\Support\Str;



class CatalogController extends Controller
{
  private $catalog;
  private $supplier;


  public function __construct(Catalog $catalog, Supplier $supplier)
  {
    $this->catalog = $catalog;
    $this->supplier = $supplier;
  }

  public function index()
  {

    $data = $this->catalog::with('supplier')->get();
    //dd($data);

    return view('products_catalog.index', ['data' => $data]);
  }

  public function import(Request $request)
  {
    $arquivo = $request->file;

    if($arquivo) {

          Log::info('Robo: ***** Importando Produto ******');
          Excel::import(new CatalogImport, $arquivo);

          return redirect()->route('products_catalog.index');
      }
    //flash('Erro ao importar planilha, tente novamente!')->error();
    return redirect()->route('products.index');
  }

  public function export(Request $request)
  {
      //dd($request->all());

      if($request->input('product_list')) {
        $product_list = $request->input('product_list');
        return Excel::download(new CatalogExport($product_list), 'catalog_export_sync'.now().'.xlsx');
      }

      dd('não caiu no if');

      return redirect()->route('products_catalog.index');
  }

  public function exportAll()
  {
      if( count($this->catalog->all()) > 0) {
          return Excel::download(new CatalogAllExport, 'catalog_all_export_'.now().'.xlsx');
          return redirect()->route('products_catalog.index');
      }
      return redirect()->route('products_catalog.index');
  }

  public function show($id)
  {
    $product = $this->catalog::with('supplier')->where('id',$id )->firstOrFail();
    return view('products_catalog.edit', ['data' => $product]);

    echo "<h1>Produto</h1>";
    echo $product['0']->product_name;
    echo "<br>"; echo "<br>";
    echo "SKU:". $product['0']->sku . "<br>";

  }

}
