@extends('layouts.main')

@section('content')
<form method="POST" action="/obat">
    @csrf
    <div class="form-group">
      <label for="exampleInputEmail1">Nama Obat</label>
      <input type="text" class="form-control @error('name') is-invalid @enderror"  placeholder="Nama" name="name">
        @error('name')
            <div class="invalid-feedback">
                <span class="text-red-500">{{ $message }}</span>
            </div>
        @enderror
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Harga</label>
      <input type="number" class="form-control @error('harga') is-invalid @enderror" placeholder="0" name="harga">
      @error('harga')
        <div class="invalid-feedback">
            <span class="text-red-500">{{ $message }}</span>
        </div>
        @enderror
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Stok</label>
      <input type="number" class="form-control @error('stok') is-invalid @enderror" placeholder="0" name="stok">
      @error('stok')
        <div class="invalid-feedback">
            <span class="text-red-500">{{ $message }}</span>
        </div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection