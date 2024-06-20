@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Add New Teknisi</h3>
    </div>
    <div class="card-body">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ route('teknisi.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="id_user">ID Teknisi</label>
                <input type="text" class="form-control" id="id_user" name="id_user" required>
            </div>
            <div class="form-group">
                <label for="nama_lengkap">Nama User</label>
                <input type="text" class="form-control" id="nama_user" name="nama_user" required>
            </div>
            <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="id_divisi">Divisi</label>
                <select class="form-control select2" id="id_divisi" name="id_divisi" required>
                    @foreach($divisis as $divisi)
                        <option value="{{ $divisi->id_divisi }}">{{ $divisi->nama_divisi }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection
