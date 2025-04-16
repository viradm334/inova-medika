@extends('layouts.main')

@section('content')
<form method="POST" action="/pendaftaran-pasien">
    @csrf
    <div class="form-group">
      <label for="exampleInputEmail1">Nama Pasien</label>
      <input type="text" class="form-control" name="nama_pasien" value="{{ $kunjungan->nama_pasien }}" disabled>
    </div>

    <div class="form-group">
      <label for="exampleInputPassword1">Tanggal Lahir</label>
      <input type="date" class="form-control" name="tgl_lahir" value="{{ $kunjungan->tgl_lahir }}" disabled>
    </div>

    <div class="form-group">
      <label for="exampleInputPassword1">Alamat</label>
      <input type="text" class="form-control" name="alamat" value="{{ $kunjungan->alamat }}" disabled>
    </div>

    <div class="form-group search_select_box">
      <label for="exampleInputPassword1">Kota/Kabupaten</label>
      <select class="selectpicker form-control" data-live-search="true" data-style="form-control" name="kota_id" disabled>
        @foreach ($kotas as $kota)
        <option value="{{ $kota->id }}" @if ($kunjungan->kota_id == $kota->id) selected @endif >{{ $kota->name }}</option>
        @endforeach
      </select>      
    </div>

    <div class="form-group search_select_box">
      <label for="exampleInputPassword1">Provinsi</label>
      <select class="selectpicker form-control" data-live-search="true" data-style="form-control" name="provinsi_id" disabled>
        @foreach ($provinces as $province)
          <option value="{{ $province->id }}" @if ($kunjungan->provinsi_id == $province->id) selected @endif >{{ $province->name }}</option>
        @endforeach
      </select>      
    </div>

    <div class="form-group">
      <label for="exampleInputPassword1">No. HP</label>
      <input type="text" class="form-control" name="no_hp" value="{{ $kunjungan->no_hp }}" disabled>
    </div>

    <div class="form-group">
      <label for="exampleInputPassword1">Keluhan</label>
      <input type="text" class="form-control" name="keluhan" value="{{ $kunjungan->keluhan }}" disabled>
    </div>

    <div class="form-group">
        <label for="exampleFormControlSelect1">Jenis Kunjungan</label>
        <select class="form-control" id="exampleFormControlSelect1" name="jenis_kunjungan_id" disabled>
          @foreach ($jeniskunjungans as $jeniskunjungan)
            <option value="{{ $jeniskunjungan->id }}" @if($kunjungan->jenis_kunjungan_id == $jeniskunjungan->id) selected @endif>{{ $jeniskunjungan->nama }}</option>
          @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="exampleFormControlSelect1">Dokter yang Dikunjungi</label>
        <select class="form-control" id="exampleFormControlSelect1" name="dokter_id" disabled>
            @foreach ($dokters as $dokter)
                <option value="{{ $dokter->id }}" @if($kunjungan->dokter_id == $dokter->id) selected @endif>{{ $dokter->name }}</option>
            @endforeach
        </select>
    </div>

    <a href="/pendaftaran" class="btn btn-primary">Kembali</a>
  </form>

  <script>
    $(document).ready(function(){
      $('.search_select_box select').selectpicker();
    })
  </script>
@endsection