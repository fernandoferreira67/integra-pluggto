<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class B2W extends Model
{
    use HasFactory;
    protected $primaryKey = "id";
    protected $table = "b2w";
    protected $fillable = ['pluggto_sku','sku','channel_store','sync','status'];
}
