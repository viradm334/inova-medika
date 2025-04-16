@extends('layouts.main')

@section('content')
<form method="POST" action="/pendaftaran-pasien">
    @csrf
    <div class="form-group">
      <label for="exampleInputEmail1">Nama Pasien</label>
      <input type="text" class="form-control @error('nama_pasien') is-invalid @enderror"  placeholder="Nama" name="nama_pasien">
        @error('nama_pasien')
            <div class="invalid-feedback">
                <span class="text-red-500">{{ $message }}</span>
            </div>
        @enderror
    </div>

    <div class="form-group">
      <label for="exampleInputPassword1">Tanggal Lahir</label>
      <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror" name="tgl_lahir">
      @error('tgl_lahir')
        <div class="invalid-feedback">
            <span class="text-red-500">{{ $message }}</span>
        </div>
        @enderror
    </div>

    <div class="form-group">
      <label for="exampleInputPassword1">Alamat</label>
      <input type="text" class="form-control @error('stok') is-invalid @enderror" placeholder="Alamat" name="alamat">
      @error('alamat')
        <div class="invalid-feedback">
            <span class="text-red-500">{{ $message }}</span>
        </div>
        @enderror
    </div>

    <div class="form-group search_select_box">
      <label for="exampleInputPassword1">Kota/Kabupaten</label>
      <select class="selectpicker form-control" data-live-search="true" data-style="form-control" name="kota_id">
        @foreach ($kotas as $kota)
          <option value="{{ $kota->id }}">{{ $kota->name }}</option>
        @endforeach
      </select>      
    </div>

    <div class="form-group search_select_box">
      <label for="exampleInputPassword1">Provinsi</label>
      <select class="selectpicker form-control" data-live-search="true" data-style="form-control" name="provinsi_id">
        @foreach ($provinces as $province)
          <option value="{{ $province->id }}">{{ $province->name }}</option>
        @endforeach
      </select>      
    </div>

    <div class="form-group">
      <label for="exampleInputPassword1">No. HP</label>
      <input type="text" class="form-control @error('no_hp') is-invalid @enderror" placeholder="081XXX" name="no_hp">
      @error('no_hp')
        <div class="invalid-feedback">
            <span class="text-red-500">{{ $message }}</span>
        </div>
        @enderror
    </div>

    <div class="form-group">
      <label for="exampleInputPassword1">Keluhan</label>
      <input type="text" class="form-control @error('no_hp') is-invalid @enderror" placeholder="Tulis keluhan disini" name="keluhan">
      @error('keluhan')
        <div class="invalid-feedback">
            <span class="text-red-500">{{ $message }}</span>
        </div>
        @enderror
    </div>

    <div class="form-group">
        <label for="exampleFormControlSelect1">Jenis Kunjungan</label>
        <select class="form-control" id="exampleFormControlSelect1" name="jenis_kunjungan_id">
          @foreach ($jeniskunjungans as $jeniskunjungan)
            <option value="{{ $jeniskunjungan->id }}">{{ $jeniskunjungan->nama }}</option>
          @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="exampleFormControlSelect1">Dokter yang Dikunjungi</label>
        <select class="form-control" id="exampleFormControlSelect1" name="dokter_id">
          @foreach ($dokters as $dokter)
            <option value="{{ $dokter->id }}">{{ $dokter->name }}</option>
          @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>

  <script>
    $(document).ready(function(){
      $('.search_select_box select').selectpicker();
    })
  </script>
@endsection