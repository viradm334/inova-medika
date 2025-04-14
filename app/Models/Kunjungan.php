<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class, 'dokter_id');
    }

    public function obats(){
        return $this->belongsToMany(Obat::class, 'kunjungan_obats');
    }

    public function tindakans(){
        return $this->belongsToMany(Tindakan::class, 'kunjungan_tindakans');
    }
}
