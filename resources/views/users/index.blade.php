<!-- resources/views/users/index.blade.php -->

@extends('layouts.app')

@section('title', 'Users')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">List of Users</h3>
        <div class="card-tools">
            <a href="{{ route('users.create') }}" class="btn btn-primary">Add New</a>
        </div>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table class="table table-bordered" id="table-users">
            <thead>
                <tr>
                    <th>ID User</th>
                    <th>Nama User</th>
                    <th>Divisi</th>
                    <th>Level</th>
                    <th>Status Akun</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id_user }}</td>
                        <td>{{ $user->nama_user }}</td>
                        <td>{{ $user->divisi->nama_divisi }}</td>
                        <td>{{ $user->level }}</td>
                        <td>{{ $user->status_akun }}</td>
                        <td>
                            <a href="{{ route('users.show', $user->id_user) }}" class="btn {{ $user->status_akun=='Aktif' ? 'btn-danger' : 'btn-success' }} btn-sm">{{ $user->status_akun=='Aktif' ? 'Nonaktif' : 'Aktif' }}</a>
                            <a href="{{ route('users.edit', $user->id_user) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('users.destroy', $user->id_user) }}" method="post" style="display: inline-block">
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
        $('#table-users').DataTable();
    });
</script>
@endpush
