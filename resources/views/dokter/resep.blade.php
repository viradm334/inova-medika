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

<form method="POST" action="/resep">
    @csrf
    <div class="form-group">
      <label for="exampleInputEmail1">Id Kunjungan</label>
      <input type="number" class="form-control @error('name') is-invalid @enderror" name="id" required>
        @error('id')
            <div class="invalid-feedback">
                <span class="text-red-500">{{ $message }}</span>
            </div>
        @enderror
    </div>

    <div class="form-group">
      <label for="exampleInputEmail1">Diagnosis</label>
      <input type="text" class="form-control @error('diagnosis') is-invalid @enderror" name="diagnosis" required>
        @error('diagnosis')
            <div class="invalid-feedback">
                <span class="text-red-500">{{ $message }}</span>
            </div>
        @enderror
    </div>

    <div class="form-group">
      <label for="exampleFormControlSelect1">Tindakan 1</label>
      <select class="form-control" id="exampleFormControlSelect1" name="tindakan[]">
        @foreach ($tindakans as $tindakan)
          <option value="{{ $tindakan->id }}">{{ $tindakan->nama }}</option>
        @endforeach
      </select>
    </div>

    <div class="form-group">
      <label for="exampleFormControlSelect1">Tindakan 2</label>
      <select class="form-control" id="exampleFormControlSelect1" name="tindakan[]">
        @foreach ($tindakans as $tindakan)
          <option value="{{ $tindakan->id }}">{{ $tindakan->nama }}</option>
        @endforeach
      </select>
    </div>

    <div class="form-group">
      <label for="exampleFormControlSelect1">Obat 1</label>
      <select class="form-control" id="exampleFormControlSelect1" name="obat[]">
        @foreach ($obats as $obat)
          <option value="{{ $obat->id }}">{{ $obat->name }}</option>
        @endforeach
      </select>
    </div>

    <div class="form-group">
      <label for="exampleFormControlSelect1">Jumlah Obat 1</label>
      <input type="number" class="form-control @error('jumlah') is-invalid @enderror" name="jumlah[]" required>
        @error('jumlah[]')
            <div class="invalid-feedback">
                <span class="text-red-500">{{ $message }}</span>
            </div>
        @enderror
    </div>

    <div class="form-group">
      <label for="exampleFormControlSelect1">Obat 2</label>
      <select class="form-control" id="exampleFormControlSelect1" name="obat[]">
        @foreach ($obats as $obat)
          <option value="{{ $obat->id }}">{{ $obat->name }}</option>
        @endforeach
      </select>
    </div>

    <div class="form-group">
        <label for="exampleFormControlSelect1">Jumlah Obat 2</label>
        <input type="number" class="form-control @error('jumlah') is-invalid @enderror" name="jumlah[]" required>
          @error('jumlah[]')
              <div class="invalid-feedback">
                  <span class="text-red-500">{{ $message }}</span>
              </div>
          @enderror
      </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection