@extends('adminlte::page')

@section('title', 'Data Kelas Kosong')

@section('content_header')
<h1 class="m-0 text-dark">Data Kelas Kosong</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <table class="table table-hover table-bordered table-stripped" id="example2">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>ID Kelas</th>
                            <th>Nama Kelas</th>
                            <!-- <th>Keterangan</th> -->
                            <th>Siswa Terdata</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if($kelass->isEmpty()) <!-- Mengganti variable dengan yang sesuai -->
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada kelas yang ditemukan</td>
                            </tr>
                        @else
                            @foreach($kelass as $key => $kelas)
                                <tr>
                                    <td class="align-middle text-center">{{ $key + 1 }}</td>
                                    <td class="align-middle">{{ $kelas->id }}</td>
                                    <td class="align-middle font-weight-bold">{{ $kelas->nama_kelas }}</td>
                                    <!-- <td class="align-middle font-weight-bold">{{ $kelas->nama_kelas }}</td> -->
                                    <td class="align-middle">{{ $kelas->nama_siswa ?? 'Belum ada siswa' }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
@stop

@push('js')
<form action="" id="delete-form" method="post">
    @method('delete')
    @csrf
</form>
<script>
    $('#example2').DataTable({
        "responsive": true,
    });

    function notificationBeforeDelete(event, el) {
        event.preventDefault();
        if (confirm('Apakah anda yakin akan menghapus data ? ')) {
            $("#delete-form").attr('action', $(el).attr('href'));
            $("#delete-form").submit();
        }
    }
</script>
@endpush
