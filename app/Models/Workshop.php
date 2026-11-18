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
        'kuota',
    ];

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    protected function casts(): array
    {
        return ['jadwal' => 'datetime'];
    }
}
