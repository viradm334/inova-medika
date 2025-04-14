<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    protected $guarded = ['id'];

    public function kunjungans(){
        return $this->belongsToMany(Kunjungan::class, 'kunjungan_obats');
    }
}
