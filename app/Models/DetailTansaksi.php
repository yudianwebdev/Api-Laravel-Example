<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTansaksi extends Model
{
    use HasFactory;
    protected $fillable = ["IdTransaksi", "Barcode", "NamaBarang", "QTY", "Harga"];
}
