@extends('layouts.main')

@section('content')

@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>

@elseif(session()->has('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary mb-3">Data Transaksi</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>ID Kunjungan</th>
                        <th>Nama Pasien</th>
                        <th>Tanggal Masuk</th>
                        <th>Status Kunjungan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kunjungans as $kunjungan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $kunjungan->id }}</td>
                        <td>{{ $kunjungan->nama_pasien }}</td>
                        <td>{{ $kunjungan->created_at }}</td>
                        <td>{{ $kunjungan->status }}</td>
                        <td>
                            @if ($kunjungan->status === 'pending')
                                <form action="/checkin" method="post">
                                    @csrf
                                    <input type="hidden" value="{{ $kunjungan->id }}" name="id">
                                    <button type="submit" class="btn btn-primary">Checkin</button>
                                </form>
                            @else
                                <a href="/payment-details/{{ $kunjungan->id }}" class="btn btn-info">Lihat Detail</a>
                            @endif
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