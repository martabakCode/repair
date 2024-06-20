@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">List of Perbaikan</h3>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table class="table table-bordered" id="perbaikanTable">
            <thead>
                <tr>
                    <th>ID Tiket</th>
                    <th>Tanggal</th>
                    <th>ID Pengguna</th>
                    <th>ID Mesin</th>
                    <th>Nama Mesin</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($perbaikans as $perbaikan)
                    <tr>
                        <td>{{ $perbaikan->id_perbaikan }}</td>
                        <td>{{ $perbaikan->tgl_buat }}</td>
                        <td>{{ $perbaikan->id_user }}</td>
                        <td>{{ $perbaikan->id_mesin }}</td>
                        <td>{{ $perbaikan->mesin->nama_mesin }}</td>
                        <td>
                            @if ($perbaikan->status == 'Open')
                                <button class="btn btn-info btn-sm">Menunggu Verifikasi</button>
                            @elseif ($perbaikan->status == 'Waiting')
                                <button class="btn btn-warning btn-sm">Sedang dikerjakan</button>
                            @elseif ($perbaikan->status == 'Closed')
                                <button class="btn btn-success btn-sm">Selesai</button>
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-info btn-sm" data-toggle="modal" data-target="#keteranganModal{{ $perbaikan->id_perbaikan }}">Keterangan</a>
                        </td>
                    </tr>
                    <!-- Keterangan Modal -->
                    <div class="modal fade" id="keteranganModal{{ $perbaikan->id_perbaikan }}" tabindex="-1" role="dialog" aria-labelledby="keteranganModalLabel{{ $perbaikan->id_perbaikan }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="keteranganModalLabel{{ $perbaikan->id_perbaikan }}">Detail Perbaikan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h6>ID Tiket: {{ $perbaikan->id_perbaikan }}</h6>
                                    <h6>Kronologi:</h6>
                                    <p>{{ $perbaikan->judul }}</p>
                                    <h6>Keterangan:</h6>
                                    <p>{{ $perbaikan->keterangan }}</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Keterangan Modal -->
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#perbaikanTable').DataTable();
    });
</script>
@endpush
