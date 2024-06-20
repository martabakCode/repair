@extends('layouts.app')

@section('title', 'Edit Mesin')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('mesin.index') }}">Mesin</a></li>
    <li class="breadcrumb-item active">Edit Mesin</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Mesin</h3>
    </div>
    <div class="card-body">
       @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form
         method="POST" action="{{ route('mesin.update', $mesin->id_mesin) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="id_mesin">ID Mesin</label>
                <input type="text" id="id_mesin" name="id_mesin" class="form-control" value="{{ $mesin->id_mesin }}" readonly>
            </div>

            <div class="form-group">
                <label for="nama_mesin">Nama Mesin</label>
                <input type="text" id="nama_mesin" name="nama_mesin" class="form-control @error('nama_mesin') is-invalid @enderror" value="{{ old('nama_mesin', $mesin->nama_mesin) }}">
                @error('nama_mesin')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="merk_mesin">Merk Mesin</label>
                <input type="text" id="merk_mesin" name="merk_mesin" class="form-control @error('merk_mesin') is-invalid @enderror" value="{{ old('merk_mesin', $mesin->merk_mesin) }}">
                @error('merk_mesin')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="kapasitas">Kapasitas</label>
                <input type="text" id="kapasitas" name="kapasitas" class="form-control @error('kapasitas') is-invalid @enderror" value="{{ old('kapasitas', $mesin->kapasitas) }}">
                @error('kapasitas')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="id_divisi">Divisi</label>
                <select id="id_divisi" name="id_divisi" class="form-control @error('id_divisi') is-invalid @enderror">
                    @foreach($divisis as $divisi)
                        <option value="{{ $divisi->id_divisi }}" {{ $mesin->id_divisi == $divisi->id_divisi ? 'selected' : '' }}>{{ $divisi->nama_divisi }}</option>
                    @endforeach
                </select>
                @error('id_divisi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="tahun_pembuatan">Tahun Pembuatan</label>
                <input type="text" id="tahun_pembuatan" name="tahun_pembuatan" class="form-control @error('tahun_pembuatan') is-invalid @enderror" value="{{ old('tahun_pembuatan', $mesin->tahun_pembuatan) }}">
                @error('tahun_pembuatan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="periode_pakai">Periode Pakai</label>
                <input type="text" id="periode_pakai" name="periode_pakai" class="form-control @error('periode_pakai') is-invalid @enderror" value="{{ old('periode_pakai', $mesin->periode_pakai) }}">
                @error('periode_pakai')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('mesin.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
