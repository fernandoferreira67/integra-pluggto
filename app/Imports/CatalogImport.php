<?php

namespace App\Imports;

use App\Models\Catalog;
use App\Models\Supplier;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Expr\Cast\String_;

class CatalogImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $row)
    {
      //dd(strtoupper($row['tipo_produto']) == 'SIMPLES');
      //dd($row);
        $catalog = Catalog::where('erp_id', $row['id'])->get();

        if(count($catalog) ||($row['situacao']) == 'Inativo' ){
          Log::warning('ID já cadastro SKU ou Inativo:'. $row['id']);
        }else{

          $suppliers = Supplier::where('supplier_erp_id', $row['cod_do_fornecedor'])->get();

          if(isset($row['tipo_produto'])){
            $string = strtoupper($row['tipo_produto']);
            if ($string == 'KIT') {
              $type = 'K';
            }elseif($string == 'SIMPLES'){
              $type = 'S';
            }
          }

          if(isset($row['categoria'])){
            $categories = str_replace('/', ' >', $row['categoria']);
          }

          if(!isset($row['preco_de_custo'])){
            echo $row['preco_de_custo'];
            $price_cost = 0;
          }

          if(!isset($row['preco'])){
            echo $row['preco'];
            $price_sale = 0;
          }

          Log::notice('Produto importado:'. $row['id']);
          return new Catalog([
            //$var == 1 ? 'true' : ''
            'erp_id'                  => isset($row['id']) ? $row['id'] : '',
            'sku'                     => isset($row['codigo_sku']) ? $row['codigo_sku'] : '',
            'product_type'            => $type,  //isset($row['tipo_produto']) ? $row['tipo_produto'] : 'product_type',
            'product_name'            => isset($row['descricao']) ? $row['descricao'] : '',
            'description'             => isset($row['descricao_complementar_e_especificacao']) ? $row['descricao_complementar_e_especificacao'] : 'descricao_complementar_e_especificacao',
            'categories'              => $categories, //isset($row['categoria_do_pai']) ? $row['categoria_do_pai'] : 'categories',
            'warranty'                => isset($row['garantia']) ? $row['garantia'] : '',
            'product_availability'    => isset($row['dias_para_preparacao']) ? $row['dias_para_preparacao'] : '',
            'brand'                   => isset($row['marca']) ? $row['marca'] : '',
            'gtin_ean'                => isset($row['gtinean']) ? $row['gtinean'] : '',
            'unit'                    => isset($row['unidade']) ? $row['unidade'] : '',
            'ncm'                     => isset($row['ncm_classificacao_fiscal']) ? $row['ncm_classificacao_fiscal'] : '',
            'tax_origin'              => 0,  //isset($row['origem']) ? $row['origem'] : 'tax_origin',
            'price_cost'              => isset($row['preco_de_custo']) ? $row['preco_de_custo'] : $price_cost,
            'price_sale'              => isset($row['preco']) ? $row['preco'] : $price_sale,
            'active'                  => true,
            'seo_title'               => isset($row['titulo_seo']) ? $row['titulo_seo'] : '',
            'seo_description'         => isset($row['descricao_seo']) ? $row['descricao_seo'] : '',
            'seo_keywords'            => isset($row['palavra_chave_seo']) ? $row['palavra_chave_seo'] : '',
            'weight'                  => isset($row['peso_bruto_kg']) ? $row['peso_bruto_kg'] : '',
            'height'                  => isset($row['altura_embalagem']) ? ($row['altura_embalagem'] * 100) : '',
            'width'                   => isset($row['largura_embalagem']) ? ($row['largura_embalagem'] * 100) : '',
            'length'                  => isset($row['comprimento_embalagem']) ? ($row['comprimento_embalagem'] * 100) : '',
            'supplier_id'             => $suppliers[0]->id,
          ]);
        }
    }
}
