<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Olist extends Model
{
    use HasFactory;
    protected $table = "olist";
    protected $primaryKey = "id";
    protected $fillable = ['product_name','sku','sku_erp','sku_pluggto','store','sync'];

}
