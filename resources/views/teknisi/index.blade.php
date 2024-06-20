@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">List of Teknisi</h3>
        <div class="card-tools">
            <a href="{{ route('teknisi.create') }}" class="btn btn-primary">Add New</a>
        </div>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table class="table table-bordered" id="table-teknisi">
            <thead>
                <tr>
                    <th>ID Teknisi</th>
                    <th>Nama Lengkap</th>
                    <th>Divisi</th>
                    <th>Status Akun</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($teknisis as $teknisi)
                    <tr>
                        <td>{{ $teknisi->id_user }}</td>
                        <td>{{ $teknisi->nama_lengkap }}</td>
                        <td>{{ $teknisi->divisi->nama_divisi }}</td>
                        <td>{{ $teknisi->status_akun }}</td>
                        <td>
                            <a href="{{ route('teknisi.show', $teknisi->id_user) }}" class="btn {{ $teknisi->status_akun=='Aktif' ? 'btn-danger' : 'btn-success' }} btn-sm">{{ $teknisi->status_akun=='Aktif' ? 'Nonaktif' : 'Aktif' }}</a>
                            <a href="{{ route('teknisi.edit', $teknisi->id_user) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('teknisi.destroy', $teknisi->id_user) }}" method="post" style="display: inline-block">
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
    $(document).ready(function() {
        $('#table-teknisi').DataTable();
    });
</script>
@endpush
