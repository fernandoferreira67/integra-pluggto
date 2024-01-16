<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shein extends Model
{
    use HasFactory;

    protected $table = "shein";
    protected $primaryKey = "id";
    protected $fillable = ['pluggto_sku','pluggto_parent_sku','marketplace_sku','marketplace_parent_sku','channel_store','sync','status'];
}
