@extends('layouts.main')

@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Detail Kunjungan</h6>
    </div>
    <div class="card-body">
        <h4 class="mb-3 text-center">Detail Kunjungan</h4>
        <p>Tanggal: {{ $kunjungan->created_at->format('Y-m-d') }}</p>
        <p>Nama Pasien: {{ $kunjungan->nama_pasien }}</p>
        <p>Alamat: {{ $kunjungan->alamat }}</p>
        @canany(['admin', 'petugas_pendaftaran'])
            <p>Kota: {{ $kunjungan->kota->name}}</p>
            <p>Provinsi: {{ $kunjungan->provinsi->name }}</p>
        @endcanany
        <p>Nama Dokter: {{ $kunjungan->user->name }}</p>
        <p>Jenis Kunjungan: {{ $kunjungan->jeniskunjungans->nama }}</p>
        <p>Keluhan: {{ $kunjungan->keluhan }}</p>
        <p>Status Kunjungan: {{ $kunjungan->status }}</p>
        <p>Status Pembayaran: {{ $kunjungan->payment_status }}</p>
        @if ($kunjungan->payment_status === 'paid')
            <p>Waktu Pembayaran: {{ $kunjungan->waktu_bayar }}</p>
        @endif
        @canany(['admin', 'dokter'])
            <p>Diagnosis: {{ $kunjungan->diagnosis }}</p>
        @endcanany
    </div>
</div>
@endsection