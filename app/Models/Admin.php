<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admins'; // Pastikan tabelnya sesuai
    protected $guarded = [];     // Biar semua kolom bisa diisi
}
