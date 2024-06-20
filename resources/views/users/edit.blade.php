<!-- resources/views/users/edit.blade.php -->

@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit User</h3>
    </div>
    <div class="card-body">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ route('users.update', $user->id_user) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="id_user">ID User</label>
                <input type="text" class="form-control" id="id_user" name="id_user" value="{{ $user->id_user }}" required readonly>
            </div>
            <div class="form-group">
                <label for="nama_user">Nama User</label>
                <input type="text" class="form-control" id="nama_user" name="nama_user" value="{{ $user->nama_user }}" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password">
                <small class="text-muted">Leave blank to keep current password.</small>
            </div>
            <div class="form-group">
                <label for="id_divisi">Divisi</label>
                <select class="form-control select2" id="id_divisi" name="id_divisi" required>
                    @foreach($divisis as $divisi)
                        <option value="{{ $divisi->id_divisi }}">{{ $divisi->nama_divisi }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="level">Level</label>
                <select class="form-control" id="level" name="level" required>
                    <option value="admin" {{ $user->level == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ $user->level == 'user' ? 'selected' : '' }}>User</option>
                    <option value="teknisi" {{ $user->level == 'teknisi' ? 'selected' : '' }}>Teknisi</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection
