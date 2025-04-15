@extends('layouts.main')

@section('content')
<form method="POST" action="/tindakan/{{ $tindakan->id }}">
    @method('put')
    @csrf
    <div class="form-group">
      <label for="exampleInputEmail1">Nama Tindakan</label>
      <input type="text" class="form-control @error('nama') is-invalid @enderror"  placeholder="Nama" name="nama" value="{{ old('nama', $tindakan->nama) }}">
        @error('nama')
            <div class="invalid-feedback">
                <span class="text-red-500">{{ $message }}</span>
            </div>
        @enderror
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Harga</label>
      <input type="number" class="form-control @error('harga') is-invalid @enderror" placeholder="0" name="harga" value="{{ old('harga', $tindakan->harga) }}">
      @error('harga')
        <div class="invalid-feedback">
            <span class="text-red-500">{{ $message }}</span>
        </div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection