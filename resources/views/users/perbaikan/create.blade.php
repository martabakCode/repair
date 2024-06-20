@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Add New Perbaikan</h3>
    </div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('user.perbaikan.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="id_perbaikan">No Tiket</label>
                <input type="text" class="form-control" id="id_perbaikan" name="id_perbaikan" value="{{ old('id_perbaikan', $newId) }}" readonly>
            </div>
            <div class="form-group">
                <label for="tgl_buat">Tanggal Perbaikan</label>
                <input type="date" class="form-control" id="tgl_buat" name="tgl_buat" value="{{ old('tgl_buat') }}" required>
            </div>
            <div class="form-group">
                <label for="id_mesin">ID Mesin</label>
                <select class="form-control" id="id_mesin" name="id_mesin" required>
                    <option value="">Pilih ID Mesin</option>
                    @foreach ($idMesins as $idMesin)
                        <option value="{{ $idMesin->id_mesin }}">{{ $idMesin->id_mesin }}-{{ $idMesin->nama_mesin }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="judul">Kronologi</label>
                <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul') }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection
