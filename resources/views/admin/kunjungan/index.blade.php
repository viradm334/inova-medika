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
        <h6 class="m-0 font-weight-bold text-primary mb-3">Daftar Kunjungan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Jenis Kunjungan</th>
                        <th>Dokter</th>
                        <th>Status</th>
                        <th>Status Pembayaran</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kunjungans as $kunjungan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $kunjungan->nama_pasien }}</td>
                        <td>{{ $kunjungan->jeniskunjungans->nama }}</td>
                        <td>{{ $kunjungan->user->name }}</td>
                        <td>{{ $kunjungan->status }}</td>
                        <td>{{ $kunjungan->payment_status }}</td>
                        <td>
                            <a href="/detail-pendaftaran/{{ $kunjungan->id }}" class="btn btn-info">Lihat Detail</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end">
            {{ $kunjungans->links() }}
        </div>
    </div>
</div>
@endsection