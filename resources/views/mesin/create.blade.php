@extends('layouts.app')

@section('title', 'Create Mesin')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Mesin</a></li>
    <li class="breadcrumb-item active">Create</li>
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Create Mesin</h3>
    </div>
    <div class="card-body">
       @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form
         action="{{ route('mesin.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="id_mesin">ID Mesin</label>
                <input type="text" class="form-control" id="id_mesin" name="id_mesin" required>
            </div>
            <div class="form-group">
                <label for="nama_mesin">Nama Mesin</label>
                <input type="text" class="form-control" id="nama_mesin" name="nama_mesin" required>
            </div>
            <div class="form-group">
                <label for="merk_mesin">Merk Mesin</label>
                <input type="text" class="form-control" id="merk_mesin" name="merk_mesin" required>
            </div>
            <div class="form-group">
                <label for="kapasitas">Kapasitas</label>
                <input type="text" class="form-control" id="kapasitas" name="kapasitas" required>
            </div>
            <div class="form-group">
                <label for="id_divisi">Divisi</label>
                <select class="form-control" id="id_divisi" name="id_divisi" required>
                    @foreach($divisis as $divisi)
                        <option value="{{ $divisi->id_divisi }}">{{ $divisi->nama_divisi }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="tahun_pembuatan">Tahun Pembuatan</label>
                <input type="number" class="form-control" id="tahun_pembuatan" name="tahun_pembuatan" required>
            </div>
            <div class="form-group">
                <label for="periode_pakai">Periode Pakai</label>
                <input type="number" class="form-control" id="periode_pakai" name="periode_pakai" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection
