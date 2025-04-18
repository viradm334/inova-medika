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
        <h6 class="m-0 font-weight-bold text-primary mb-3">Tindakan yang Tersedia</h6>
        <a href="/tindakan/create" class="btn btn-info">+ Tambah Tindakan</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tindakans as $tindakan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $tindakan->nama }}</td>
                        <td>Rp{{ number_format($tindakan->harga, 0, ',', '.') }}</td>
                        <td>
                            <a href="/tindakan/{{ $tindakan->id }}/edit" class="btn btn-primary">Edit</a>
                            <form action="/tindakan/{{ $tindakan->id }}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apa anda yakin untuk menghapus data tindakan?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end">
            {{ $tindakans->links() }}
        </div>
    </div>
</div>
@endsection