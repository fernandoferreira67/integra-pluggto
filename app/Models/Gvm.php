<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gvm extends Model
{
    use HasFactory;
    protected $primaryKey = "id";
    protected $table = "gvm";
    protected $fillable = ['id_gvm','sku_gvm','product_name'];
}
