@extends('layouts.main')

@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Detail Kunjungan</h6>
    </div>
    <div class="card-body">
        <h4 class="mb-3 text-center">Detail Pembayaran</h4>
        <p>Nama Pasien: {{ $kunjungan->nama_pasien }}</p>
        <p>Alamat: {{ $kunjungan->alamat }}</p>
        <p>Nama Dokter: {{ $kunjungan->user->name }}</p>
        <p>Jenis Kunjungan: {{ $kunjungan->jeniskunjungans->nama }}</p>
        <p>Status Kunjungan: {{ $kunjungan->status }}</p>
        <p>Status Pembayaran: {{ $kunjungan->payment_status }}</p>
        @if ($kunjungan->payment_status === 'paid')
            <p>Waktu Pembayaran: {{ $kunjungan->waktu_bayar }}</p>
        @endif
        <h4>Komponen Biaya</h4>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Biaya</th>
                        <th>Jumlah</th>
                        <th>Harga Satuan</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1.</td>
                        <td>Biaya Administrasi</td>
                        <td>1x</td>
                        <td>Rp{{ number_format($biaya_admin, 0, ',', '.') }}</td>
                        <td>Rp{{ number_format($biaya_admin, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <td>{{ $kunjungan->jeniskunjungans->nama }}</td>
                        <td>1x</td>
                        <td>Rp{{ number_format($biaya_kunjungan, 0, ',', '.') }}</td>
                        <td>Rp{{ number_format($biaya_kunjungan, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <h4>Tindakan</h4>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Tindakan</th>
                        <th>Jumlah</th>
                        <th>Harga Satuan</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kunjungan->tindakans as $tindakan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $tindakan->nama }}</td>
                        <td>1x</td>
                        <td>Rp{{ number_format($tindakan->harga, 0, ',', '.') }}</td>
                        <td>Rp{{ number_format($tindakan->harga, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <h4>Obat</h4>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Obat</th>
                        <th>Jumlah</th>
                        <th>Harga Satuan</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kunjungan->obats as $obat)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $obat->name }}</td>
                        <td>{{ $obat->pivot->jumlah }}x</td>
                        <td>Rp{{ number_format($obat->harga, 0, ',', '.') }}</td>
                        <td>Rp{{ number_format($obat->harga * $obat->pivot->jumlah, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col">
            <div class="row d-flex justify-content-between ml-1 mr-5">
                <div><h5>Total</h5></div>
                <div>Rp{{ number_format($total, 0, ',', '.') }}</div>
            </div>
            @if ($kunjungan->payment_status === 'paid')
            <div class="row d-flex justify-content-between ml-1 mr-5">
                <div><h5>Jumlah yang Dibayarkan</h5></div>
                <div>Rp{{ number_format($kunjungan->jumlah_bayar, 0, ',', '.') }}</div>
            </div>
            <div class="row d-flex justify-content-between ml-1 mr-5">
                <div><h5>Kembalian</h5></div>
                <div>Rp{{ number_format($kunjungan->kembalian, 0, ',', '.') }}</div>
            </div>
            @endif
        </div>
        @if ($kunjungan->payment_status === 'unpaid')
        <hr>
        <h5>Pembayaran</h5>
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
        @else
        <div class="text-center mt-3">
            <a href="/kasir" class="btn btn-primary">Kembali</a>
        </div>
        @endif
    </div>
</div>
@endsection