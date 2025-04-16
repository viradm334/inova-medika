@extends('layouts.main')

@section('content')

@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary mb-3">Bayar Kunjungan</h6>
    </div>
    <div class="card-body">
        <h1 class="m-2">Detail Kunjungan</h1>
        <p>Nama Pasien: {{ $kunjungan->nama_pasien }}</p>
        <p>Umur: {{ $kunjungan->nama_pasien }}</p>
        <p>Alamat: {{ $kunjungan->alamat }}</p>
        <p>Kota: {{ $kunjungan->kota->name }}</p>
        <p>Provinsi: {{ $kunjungan->provinsi->name }}</p>
        <p>Nama Dokter: {{ $kunjungan->user->name }}</p>
        <p>Jenis Kunjungan: {{ $kunjungan->jeniskunjungans->nama }}</p>
        <p>Status Kunjungan: {{ $kunjungan->status }}</p>
        <p>Status Pembayaran: {{ $kunjungan->payment_status }}</p>
        <h4>Komponen Biaya</h4>
        <hr>
        <h4>Biaya Administrasi: {{ $biaya_admin }}</h4>
        <h4>Biaya Konsultasi: {{ $biaya_kunjungan }}</h4>
        <h4>Tindakan</h4>
        <div class="col">
            @foreach ($kunjungan->tindakans as $tindakan)
            <div class="row">
                <div class="col">{{ $loop->iteration }}</div>
                <div class="col">{{ $tindakan->nama }}</div>
                <div class="col">{{ $tindakan->harga }}</div>
            </div>
            @endforeach
        </div>
        <hr>
        <h4>Obat</h4>
        <div class="col">
            @foreach ($kunjungan->obats as $obat)
            <div class="row">
                <div class="col">{{ $loop->iteration }}</div>
                <div class="col">{{ $obat->name }}</div>
                <div class="col">{{ $obat->pivot->jumlah }}x</div>
                <div class="col">{{ $obat->harga }}</div>
                <div class="col">{{ $obat->harga * $obat->pivot->jumlah }}</div>
            </div>
            @endforeach
        </div>
        <hr>
        <div class="col">
            <div class="row">
                <div class="col">Total</div>
                <div class="col">{{ $total }}</div>
            </div>
        </div>
        <hr>
        {{-- <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Tindakan</th>
                        <th>Tanggal Masuk</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kunjungans as $kunjungan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $kunjungan->id }}</td>
                        <td>{{ $kunjungan->created_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div> --}}
        <h1>Pembayaran</h1>
        <form method="POST" action="/pay">
            @csrf
            <div class="col">
                <div class="row">
                    <input type="hidden" value="{{ $kunjungan->id }}" name="id">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Jumlah Uang yang Dibayarkan</label>
                        <input type="number" class="form-control @error('jumlah_bayar') is-invalid @enderror" name="jumlah_bayar" required>
                          @error('jumlah_bayar')
                              <div class="invalid-feedback">
                                  <span class="text-red-500">{{ $message }}</span>
                              </div>
                          @enderror
                      </div>
                </div>
                <div class="row">
                    <button type="submit" class="btn btn-primary">Bayar</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection