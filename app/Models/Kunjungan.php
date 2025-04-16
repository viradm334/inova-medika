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

    public function jeniskunjungans(){
        return $this->belongsTo(JenisKunjungan::class, 'jenis_kunjungan_id');
    }

    public function kota(){
        return $this->belongsTo(Regency::class, 'kota_id');
    }

    public function provinsi(){
        return $this->belongsTo(Province::class, 'provinsi_id');
    }
}
