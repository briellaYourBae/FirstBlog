@extends('adminlte::page')

@section('title', 'Daftar Siswa')

@section('content_header')
<div class="container-fluid bg-white shadow-sm py-4 px-4 mb-4 rounded">
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="m-0 text-secondary font-weight-bold">Daftar Siswa</h1>
        <a href="{{ route('siswas.create') }}" class="btn btn-success px-4">
            <i class="fas fa-user-plus mr-2"></i>
            Tambah Siswa
        </a>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover" id="siswaTable">
                        <thead class="bg-light">
                            <tr>
                                <th width="70">No</th>
                                <th>Nama Siswa</th>
                                <th>NIS</th>
                                <th>Tanggal Lahir</th>
                                <th>Kelas</th>
                                <th class="text-center" width="180">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($siswas as $key => $siswa)
                            <tr>
                                <td class="text-center">{{ $key + 1 }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="">
                                        <i class="fas fa-graduation-cap text-primary mr-2"></i>
                                        </div>
                                        <div>
                                            <span class="d-block">| {{ $siswa->nama }}</span>
                                            <small class="text-muted">|=> Siswa Aktif</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-light">{{ $siswa->nis }}</span>
                                </td>
                                <td>
                                    <i class="far fa-calendar-alt text-info mr-1"></i>
                                    {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d M Y') }}
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-graduation-cap text-success mr-2"></i>
                                        {{ $siswa->kelas->nama ?? 'Belum ada kelas' }}
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('siswas.show', $siswa->id) }}" 
                                           class="btn btn-sm mr-1"
                                           data-toggle="tooltip"
                                           title="Detail">
                                            <i class="fas fa-eye text-info"></i>
                                        </a>
                                        <a href="{{ route('siswas.edit', $siswa) }}" 
                                           class="btn btn-sm mr-1"
                                           data-toggle="tooltip"
                                           title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" 
   class="btn  btn-sm delete-btn"
   data-toggle="tooltip"
   title="Hapus"
   data-url="{{ route('siswas.destroy', $siswa) }}">
    <i class="fas fa-trash text-danger"></i>
</button>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus data siswa ini?</p>
                <p class="text-danger"><small>Tindakan ini tidak dapat dibatalkan</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Hapus</button>
            </div>
        </div>
    </div>
</div>

<!-- Form delete -->
<form id="delete-form" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>


<!-- Form delete -->
<form id="delete-form" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@stop

@push('css')
<style>
    .card {
        border-radius: 0.5rem;
    }
    
    .table thead th {
        border-top: none;
        border-bottom: 2px solid #e2e8f0;
        color: #4a5568;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.05em;
    }
    
    .table td {
        vertical-align: middle;
        padding: 1rem 0.75rem;
        border-bottom: 1px solid #e2e8f0;
    }
    
    .btn-sm {
        width: 32px;
        height: 32px;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 0.375rem;
    }
    
    .btn-success {
        background-color: #48bb78;
        border-color: #48bb78;
    }
    
    .avatar-circle {
        width: 40px;
        height: 40px;
        background-color: #4299e1;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .initials {
        color: white;
        font-weight: 600;
        font-size: 1.2rem;
    }
    
    .badge {
        padding: 0.5em 1em;
        font-weight: 500;
        border-radius: 0.375rem;
    }
    
    .badge-light {
        background-color: #edf2f7;
        color: #4a5568;
    }
    
    .shadow-sm {
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    }

    .btn-light {
        background-color: #f7fafc;
        border-color: #edf2f7;
    }

    .btn-light:hover {
        background-color: #edf2f7;
        border-color: #e2e8f0;
    }
</style>
@endpush

@push('js')
<script>

$(document).ready(function() {
    // Listener untuk tombol hapus
    $('.delete-btn').on('click', function() {
        let deleteUrl = $(this).data('url');  // Ambil URL dari tombol hapus
        $('#deleteModal').modal('show');  // Tampilkan modal konfirmasi

        // Set URL pada form delete dan submit ketika tombol konfirmasi diklik
        $('#confirmDelete').off('click').on('click', function() {
            $('#delete-form').attr('action', deleteUrl);  // Set URL ke form
            $('#delete-form').submit();  // Submit form
        });
    });
});

$(document).ready(function() {
    // Inisialisasi DataTable dengan konfigurasi
    $('#siswaTable').DataTable({
        responsive: true,
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
            infoFiltered: "(disaring dari _MAX_ total data)",
            paginate: {
                first: "Pertama",
                last: "Terakhir",
                next: "Selanjutnya",
                previous: "Sebelumnya"
            }
        },
        dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
             "<'row'<'col-sm-12'tr>>" +
             "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
    });

    // Inisialisasi tooltip
    $('[data-toggle="tooltip"]').tooltip();

    // Handle konfirmasi delete dengan modal
    let deleteUrl = '';
    
    $('.delete-btn').on('click', function(e) {
        e.preventDefault();
        deleteUrl = $(this).attr('href');
        $('#deleteModal').modal('show');
    });

    $('#confirmDelete').on('click', function() {
        $('#delete-form').attr('action', deleteUrl);
        $('#delete-form').submit();
    });
    

    // Animasi hover pada baris tabel
    $('.table tbody tr').hover(
        function() {
            $(this).addClass('bg-light');
        },
        function() {
            $(this).removeClass('bg-light');
        }
    );

    $('.delete-btn').on('click', function() {
    let deleteUrl = $(this).data('url');
    $('#deleteModal').modal('show');
    $('#confirmDelete').off('click').on('click', function() {
        $('#delete-form').attr('action', deleteUrl);
        $('#delete-form').submit();
    });

    
});

});
</script>
@endpush
