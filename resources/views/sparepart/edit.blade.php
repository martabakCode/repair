@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Sparepart</h3>
    </div>
    <div class="card-body">
       @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form
         action="{{ route('sparepart.update', $sparepart->id_sparepart) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="id_sparepart">ID Sparepart</label>
                <input type="text" class="form-control" id="id_sparepart" name="id_sparepart" value="{{ $sparepart->id_sparepart }}" readonly>
            </div>
            <div class="form-group">
                <label for="nama_sparepart">Nama Sparepart</label>
                <input type="text" class="form-control" id="nama_sparepart" name="nama_sparepart" value="{{ $sparepart->nama_sparepart }}" required>
            </div>
            <div class="form-group">
                <label for="merk_sparepart">Merk Sparepart</label>
                <input type="text" class="form-control" id="merk_sparepart" name="merk_sparepart" value="{{ $sparepart->merk_sparepart }}" required>
            </div>
            <div class="form-group">
                <label for="kapasitas">Kapasitas</label>
                <input type="text" class="form-control" id="kapasitas" name="kapasitas" value="{{ $sparepart->kapasitas }}">
            </div>
            <div class="form-group">
                <label for="tahun_pembuatan">Tahun Pembuatan</label>
                <input type="number" class="form-control" id="tahun_pembuatan" name="tahun_pembuatan" value="{{ $sparepart->kapasitas }}" required>
            </div>
            <div class="form-group">
                <label for="id_divisi">Divisi</label>
                <select class="form-control" id="id_divisi" name="id_divisi" required>
                    @foreach($divisis as $divisi)
                        <option value="{{ $divisi->id_divisi }}" {{ $sparepart->id_divisi == $divisi->id_divisi ? 'selected' : '' }}>{{ $divisi->nama_divisi }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection
