<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisKunjungan extends Model
{
    protected $guarded = ['id'];

    public function kunjungans(){
        return $this->hasMany(Kunjungan::class);
    }
}
