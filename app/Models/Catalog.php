<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    use HasFactory;
    protected $table = "catalogs";
    protected $primaryKey = "id";
    protected $fillable = [
    'erp_id','sku','product_type','product_name','description','categories','warranty','product_availability',
    'brand','gtin_ean','unit','ncm','tax_origin','price_cost','price_sale','active','seo_title','seo_description','seo_keywords',
    'weight','height', 'width','length','supplier_id'
    ];


    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
