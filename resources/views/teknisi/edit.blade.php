@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Teknisi</h3>
    </div>
    <div class="card-body">
       @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form
         action="{{ route('teknisi.update', $teknisi->id_user) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="id_user">ID Teknisi</label>
                <input type="text" class="form-control" id="id_user" name="id_user" value="{{ $teknisi->id_user }}" readonly>
            </div>
            <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="{{ $teknisi->nama_lengkap }}" required>
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
                <label for="status_akun">Status Akun</label>
                <select class="form-control" id="status_akun" name="status_akun" required>
                    <option value="Aktif" {{ $teknisi->status_akun == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="Nonaktif" {{ $teknisi->status_akun == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection
