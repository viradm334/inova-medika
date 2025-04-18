@extends('layouts.main')

@section('content')
<form method="POST" action="/user">
    @csrf
    <div class="form-group">
      <label for="exampleInputEmail1">Nama Pegawai</label>
      <input type="text" class="form-control @error('name') is-invalid @enderror"  placeholder="Nama" name="name">
        @error('name')
            <div class="invalid-feedback">
                <span class="text-red-500">{{ $message }}</span>
            </div>
        @enderror
    </div>

    <div class="form-group">
      <label for="exampleFormControlSelect1">User Account Role</label>
      <select class="form-control" id="exampleFormControlSelect1" name="role">
        @foreach ($roles as $role)
          <option value="{{ $role }}">{{ $role }}</option>
        @endforeach
      </select>
    </div>

    <div class="form-group">
      <label for="exampleInputPassword1">Email</label>
      <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="0" name="email">
      @error('email')
        <div class="invalid-feedback">
            <span class="text-red-500">{{ $message }}</span>
        </div>
        @enderror
    </div>

    <div class="form-group">
      <label for="exampleInputPassword1">Password</label>
      <input type="password" class="form-control @error('password') is-invalid @enderror" name="password">
      @error('password')
        <div class="invalid-feedback">
            <span class="text-red-500">{{ $message }}</span>
        </div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection