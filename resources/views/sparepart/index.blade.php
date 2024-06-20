@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">List of Spareparts</h3>
        <div class="card-tools">
            <a href="{{ route('sparepart.create') }}" class="btn btn-primary">Add New</a>
        </div>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Sparepart</th>
                    <th>Nama Sparepart</th>
                    <th>Merk Sparepart</th>
                    <th>Kapasitas</th>
                    <th>Divisi</th>
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
                        <td>
                            <a href="{{ route('sparepart.show', $sparepart->id_sparepart) }}" class="btn btn-info btn-sm">View</a>
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
