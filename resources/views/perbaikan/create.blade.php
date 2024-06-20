@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Add New Perbaikan</h3>
    </div>
    <div class="card-body">
       @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form
         action="{{ route('perbaikan.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="tgl_buat">Tanggal</label>
                <input type="date" class="form-control" id="tgl_buat" name="tgl_buat" required>
            </div>
            <div class="form-group">
                <label for="id_mesin">ID Mesin</label>
                <input type="text" class="form-control" id="id_mesin" name="id_mesin" required>
            </div>
            <div class="form-group">
                <label for="id_user">ID User</label>
                <input type="text" class="form-control" id="id_user" name="id_user" required>
            </div>
            <div class="form-group">
                <label for="judul">Judul</label>
                <input type="text" class="form-control" id="judul" name="judul" required>
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea class="form-control" id="keterangan" name="keterangan" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="id_teknisi">ID Teknisi</label>
                <input type="text" class="form-control" id="id_teknisi" name="id_teknisi" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <input type="text" class="form-control" id="status" name="status" required>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection
