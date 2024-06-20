@extends('layouts.app')

@section('title', 'Mesin')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item">Mesin</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Mesin</h3>
        <div class="card-tools">
            <a href="{{ route('mesin.create') }}" class="btn btn-primary btn-sm">Add Mesin</a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="mesinTable">
            <thead>
                <tr>
                    <th>ID Mesin</th>
                    <th>Nama Mesin</th>
                    <th>Merk Mesin</th>
                    <th>Kapasitas</th>
                    <th>Divisi</th>
                    <th>Tahun Pembuatan</th>
                    <th>Periode Pakai</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mesins as $mesin)
                <tr>
                    <td>{{ $mesin->id_mesin }}</td>
                    <td>{{ $mesin->nama_mesin }}</td>
                    <td>{{ $mesin->merk_mesin }}</td>
                    <td>{{ $mesin->kapasitas }}</td>
                    <td>{{ $mesin->divisi->nama_divisi }}</td>
                    <td>{{ $mesin->tahun_pembuatan }}</td>
                    <td>{{ $mesin->periode_pakai }}</td>
                    <td>
                        <a href="{{ route('mesin.edit', $mesin->id_mesin) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('mesin.destroy', $mesin->id_mesin) }}" method="post" style="display: inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Sparepart</h3>
        <div class="card-tools">
            <a href="{{ route('sparepart.create') }}" class="btn btn-primary btn-sm">Add Sparepart</a>
        </div>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table class="table table-bordered" id="sparepartTable">
            <thead>
                <tr>
                    <th>ID Sparepart</th>
                    <th>Nama Sparepart</th>
                    <th>Merk Sparepart</th>
                    <th>Kapasitas</th>
                    <th>Divisi</th>
                    <th>Tahun Pembuatan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($spareparts as $sparepart)
                    <tr>
                        <td>{{ $sparepart->id_sparepart }}</td>
                        <td>{{ $sparepart->nama_sparepart }}</td>
                        <td>{{ $sparepart->merk_sparepart }}</td>
                        <td>{{ $sparepart->kapasitas }}</td>
                        <td>{{ $sparepart->divisi->nama_divisi }}</td>
                        <td>{{ $sparepart->tahun_pembuatan }}</td>
                        <td>
                            <a href="{{ route('sparepart.edit', $sparepart->id_sparepart) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('sparepart.destroy', $sparepart->id_sparepart) }}" method="post" style="display: inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function () {
    $('#mesinTable').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
    });
    $('#sparepartTable').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
    });
});
</script>
@endpush
