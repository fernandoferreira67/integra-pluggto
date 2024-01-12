<?php

namespace App\Exports;

use App\Models\Catalog;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CatalogExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $product_list;

    function __construct($product_list) {
      $this->product_list = $product_list;
    }

    public function collection()
    {
      //return Catalog::all();
      //dd(Catalog::with('supplier')->limit(5)->get());
      //dd($this->product_list);
     return DB::table('catalogs')->join('suppliers', 'catalogs.supplier_id', '=', 'suppliers.id')->whereIn('catalogs.id', $this->product_list)->get();

      //return Shopee::where('sync', 'OK')->get();

    }

    public function headings():array {

      return [
          'ID',
          'Código (SKU)',
          'Descrição',
          'Unidade',
          'NCM (Classificação fiscal)',
          'Origem',
          'Preço',
          'Valor IPI fixo',
          'Observações',
          'Situação',
          'Estoque',
          'Preço de custo',
          'Cód do fornecedor',
          'Fornecedor',
          'Localização',
          'Estoque máximo',
          'Estoque mínimo',
          'Peso líquido (Kg)',
          'Peso bruto (Kg)',
          'GTIN/EAN',
          'GTIN/EAN tributável',
          'Descrição complementar',
          'CEST',
          'Código de Enquadramento IPI',
          'Formato embalagem',
          'Largura embalagem',
          'Altura Embalagem',
          'Comprimento embalagem',
          'Diâmetro embalagem',
          'Tipo do produto',
          'URL imagem 1',
          'URL imagem 2',
          'URL imagem 3',
          'URL imagem 4',
          'URL imagem 5',
          'URL imagem 6',
          'Categoria',
          'Código do pai',
          'Variações',
          'Marca',
          'Garantia',
          'Sob encomenda',
          'Preço promocional',
          'URL imagem externa 1',
          'URL imagem externa 2',
          'URL imagem externa 3',
          'URL imagem externa 4',
          'URL imagem externa 5',
          'URL imagem externa 6',
          'Link do vídeo',
          'Título SEO',
          'Descrição SEO',
          'Palavras chave SEO',
          'Slug',
          'Dias para preparação',
          'Controlar lotes',
          'Unidade por caixa',
          'URL imagem externa 7',
          'URL imagem externa 8',
          'URL imagem externa 9',
          'URL imagem externa 10',
          'Markup',
          'Permitir inclusão nas vendas',
          'EX TIPI',
        ];
    }

    public function map($line):array {

      //dd($line);

        return [
            $line->erp_id,
            $line->sku,
            $line->product_name,             //'Descrição',
            $line->unit,                     //'Unidade',
            $line->ncm,                      //'NCM (Classificação fiscal)',
            $line->tax_origin,               //'Origem',
            $line->price_sale,               //'Preço',
            '',                              //'Valor IPI fixo',
            '',                              //'Observações',
            'Ativo',                         //'Situação',
            '100',                           //'Estoque',
            $line->price_cost,               //'Preço de custo',
            $line->supplier_cod,   //'Cód do fornecedor',
            $line->name,           //'Fornecedor',
            '',                              //'Localização',
            '',                              //'Estoque máximo',
            '',                              //'Estoque mínimo',
            $line->weight,                   //'Peso líquido (Kg)',
            $line->weight,                   //'Peso bruto (Kg)',
            $line->gtin_ean,                 //'GTIN/EAN',
            '',                              //'GTIN/EAN tributável',
            $line->description,              //'Descrição complementar',
            '',                              //'CEST',
            '',                              //'Código de Enquadramento IPI',
            '',                              //'Formato embalagem',
            $line->width,                    //'Largura embalagem',
            $line->height,                   //'Altura Embalagem',
            $line->length,                   //'Comprimento embalagem',
            '',                              //'Diâmetro embalagem',
            $line->product_type,             //'Tipo do produto',
            '',                              //'URL imagem 1',
            '',                              //'URL imagem 2',
            '',                              //'URL imagem 3',
            '',                              //'URL imagem 4',
            '',                              //'URL imagem 5',
            '',                              //'URL imagem 6',
            $line->categories,               //str_replace('/', ' >', $line->categories),               //'Categoria',
            '',                              //'Código do pai',
            '',                              //'Variações',
            $line->brand,                    //'Marca',
            $line->warranty,                 //'Garantia',
            'Não',                           //'Sob encomenda',
            '',                              //'Preço promocional',
            '',                              //'URL imagem externa 1',
            '',                              //'URL imagem externa 2',
            '',                              //'URL imagem externa 3',
            '',                              //'URL imagem externa 4',
            '',                              //'URL imagem externa 5',
            '',                              //'URL imagem externa 6',
            '',                              //'Link do vídeo',
            $line->seo_title,                //'Título SEO',
            $line->seo_description,          //'Descrição SEO',
            $line->seo_keywords,             //'Palavras chave SEO',
            '',                              //'Slug',
            '',                              //'Dias para preparação',
            '',                              //'Controlar lotes',
            '',                              //'Unidade por caixa',
            '',                              //'URL imagem externa 7',
            '',                              //'URL imagem externa 8',
            '',                              //'URL imagem externa 9',
            '',                              //'URL imagem externa 10',
            '',                              //'Markup',
            'Sim',                           //'Permitir inclusão nas vendas',
            '',                              //'EX TIPI',
        ];
    }
}
