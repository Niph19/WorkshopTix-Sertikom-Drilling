<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    protected $fillable = [
        'judul',
        'deskripsi',
        'jadwal',
        'harga',
        'kuota'
    ];

    public function registration()
    {
        return $this->hasMany(Registration::class);
    }
}
