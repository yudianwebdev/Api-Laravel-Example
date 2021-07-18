<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class newList extends Model
{
    use HasFactory;
    protected $fillable = ["BarCode", "NamaBarang", "Harga"];
}
