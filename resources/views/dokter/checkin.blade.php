@extends('layouts.main')

@section('content')
<form method="POST" action="/checkin">
    @csrf
    <div class="form-group">
      <label for="exampleInputEmail1">ID Kunjungan</label>
      <input type="number" class="form-control @error('id') is-invalid @enderror" name="id" required>
        @error('id')
            <div class="invalid-feedback">
                <span class="text-red-500">{{ $message }}</span>
            </div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection