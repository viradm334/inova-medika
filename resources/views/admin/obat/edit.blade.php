@extends('layouts.main')

@section('content')
<form method="POST" action="/obat/{{ $obat->id }}">
    @method('put')
    @csrf
    <div class="form-group">
      <label for="exampleInputEmail1">Nama Obat</label>
      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nama" name="name" value="{{ old('name', $obat->name) }}">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Harga</label>
      <input type="number" class="form-control" id="exampleInputPassword1" placeholder="0" name="harga" value="{{ old('harga', $obat->harga) }}">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Stok</label>
      <input type="number" class="form-control" id="exampleInputPassword1" placeholder="0" name="stok" value="{{ old('stok', $obat->stok) }}">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection