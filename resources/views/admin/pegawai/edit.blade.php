@extends('layouts.main')

@section('content')
<form method="POST" action="/user/{{ $user->id }}">
    @method('put')
    @csrf
    <div class="form-group">
      <label for="exampleInputEmail1">Nama Pegawai</label>
      <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}">
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
          {{-- <option value="{{ $role }}">{{ $role }}</option> --}}
            @if(old('role', $user->role) == $role)
                <option value="{{ $role }}" selected>{{ $role }}</option>
            @else
                <option value="{{ $role }}">{{ $role }}</option>
            @endif
        @endforeach
      </select>
    </div>

    <div class="form-group">
      <label for="exampleInputPassword1">Email</label>
      <input type="email" class="form-control @error('harga') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}">
      @error('harga')
        <div class="invalid-feedback">
            <span class="text-red-500">{{ $message }}</span>
        </div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection