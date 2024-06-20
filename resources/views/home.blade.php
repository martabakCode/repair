@extends('layouts.app')

@section('content')
<div class="container">
    @if(Auth::user()->level == 'user')
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    <div class="card-body">

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('Selamat datang di aplikasi!') }}
                    </div>
                </div>
            </div>
        </div>
    @else
    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List of Perbaikan</h3>
                <div class="card-tools">
                    <a href="{{ route('perbaikan.create') }}" class="btn btn-primary">Add New</a>
                </div>
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
                            <th>No Tiket</th>
                            <th>Tanggal</th>
                            <th>ID Pengguna</th>
                            <th>ID Teknisi</th>
                            <th>ID Mesin</th>
                            <th>Nama Mesin</th>
                            <th>Kronologi</th>
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
                                <td>{{ $perbaikan->id_teknisi }}</td>
                                <td>{{ $perbaikan->id_mesin }}</td>
                                <td>{{ $perbaikan->mesin->nama_mesin }}</td>
                                <td>{{ $perbaikan->judul }}</td>
                                <td>
                                    @if ($perbaikan->status == 'Open')
                                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#mulaiModal{{ $perbaikan->id_perbaikan }}">Mulai</button>
                                    @elseif ($perbaikan->status == 'Waiting')
                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#sedangKerjakanModal{{ $perbaikan->id_perbaikan }}">Sedang dikerjakan</button>
                                    @elseif ($perbaikan->status == 'Closed')
                                        <button class="btn btn-success btn-sm">Selesai</button>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-info btn-sm" data-toggle="modal" data-target="#keteranganModal{{ $perbaikan->id_perbaikan }}">Lihat</a>
                                </td>
                            </tr>
                            <!-- Mulai Modal -->
                            <div class="modal fade" id="mulaiModal{{ $perbaikan->id_perbaikan }}" tabindex="-1" role="dialog" aria-labelledby="mulaiModalLabel{{ $perbaikan->id_perbaikan }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="mulaiModalLabel{{ $perbaikan->id_perbaikan }}">Mulai Perbaikan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('perbaikan.updateStatus', $perbaikan->id_perbaikan) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <label for="id_teknisi">Teknisi</label>
                                                    <select class="form-control" id="id_teknisi" name="id_teknisi" required>
                                                        <option>Pilih Teknisi</option>
                                                        @foreach ($teknisis as $teknisi)
                                                            <option value="{{ $teknisi->id_user }}">{{ $teknisi->nama_lengkap }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Mulai Modal -->

                            <!-- Sedang Kerjakan Modal -->
                            <div class="modal fade" id="sedangKerjakanModal{{ $perbaikan->id_perbaikan }}" tabindex="-1" role="dialog" aria-labelledby="sedangKerjakanModalLabel{{ $perbaikan->id_perbaikan }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="sedangKerjakanModalLabel{{ $perbaikan->id_perbaikan }}">Sedang Dikerjakan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('perbaikan.updateStatus', $perbaikan->id_perbaikan) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <label for="id_sparepart">Sparepart</label>
                                                    <select class="form-control" id="id_sparepart" name="id_sparepart" required>
                                                        <option>Pilih Sparepart</option>
                                                        @foreach ($spareparts as $sparepart)
                                                            <option value="{{ $sparepart->id_sparepart }}">{{ $sparepart->nama_sparepart }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="keterangan">Keterangan</label>
                                                    <textarea class="form-control" id="keterangan" name="keterangan" rows="3" required></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Sedang Kerjakan Modal -->

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
                                            <h6>Kronologi:</h6>
                                            <p>{{ $perbaikan->judul }}</p>
                                            <h6>Keterangan:</h6>
                                            <p>{{ $perbaikan->keterangan }}</p>
                                            <h6>Sparepart:</h6>
                                            @if ($perbaikan->sparepart)
                                                <p>{{ $perbaikan->sparepart->nama_sparepart }}</p>
                                            @else
                                                <p>Belum ada Sparepart yang di pasang</p>
                                            @endif
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
    @endif
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#perbaikanTable').DataTable();
    });
</script>
@endpush
