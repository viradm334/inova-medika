@extends('layouts.main')

@section('content')
<form>
    @csrf
    <div class="form-group">
      <label for="exampleInputEmail1">Nama Pegawai</label>
      <input type="text" class="form-control" name="name" value="{{ $user->name }}" disabled>
    </div>

    <div class="form-group">
      <label for="exampleFormControlSelect1">User Account Role</label>
      <select class="form-control" id="exampleFormControlSelect1" name="role" disabled>
        @foreach ($roles as $role)
          <option value="{{ $role }}" @if ($user->role == $role) selected @endif >{{ $role }}</option>
        @endforeach
      </select>
    </div>

    <div class="form-group">
      <label for="exampleInputPassword1">Email</label>
      <input type="email" class="form-control" placeholder="0" name="email" value="{{ $user->email }}" disabled>
    </div>

    <div class="text-center mt-3">
        <a href="/user/{{ $user->id }}/edit" class="btn btn-primary">Edit</a>
    </div>
  </form>
@endsection