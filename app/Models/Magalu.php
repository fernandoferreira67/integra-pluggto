<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magalu extends Model
{
    use HasFactory;
    protected $table = "magalu";
    protected $primaryKey = "id";
    protected $fillable = ['pluggto_sku','pluggto_parent_sku','external_code','external_sku','external_parent_sku','sync'];
}
