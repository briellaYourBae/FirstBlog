<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;


class JoinController extends Controller
{
    public function innerJoin()
{
    // join antara tabel siswas dan kelass
    $siswas = Siswa::join('kelass', 'siswas.id_kelas', '=', 'kelass.id')
            ->select('siswas.nama', 'kelass.nama as nama_kelas')
            ->get();

    return view('join.innerjoin', compact('siswas')); // pastiin nama view udah bener
}

public function leftJoin()
{
    // ambil data kelas kosong dengan left join dari tabel 'kelass' dan 'siswas'
    // $kelass = DB::table('kelass')
    //             ->leftJoin('siswas', 'kelass.id', '=', 'siswas.id_kelas')
    //             ->select('kelass.id', 'kelass.nama')
    //             ->whereNull('siswas.id')
    //             ->get();
    $kelass = DB::table('kelass')
                    ->leftJoin('siswas', 'kelass.id', '=', 'siswas.id_kelas')
                    ->select(
                        'kelass.id',
                        'kelass.nama as nama_kelas',
                        'siswas.nama as nama_siswa'
                    )
                    ->get();

    // Mengirimkan data kelas kosong ke view
    return view('join.leftjoin', compact('kelass'));
}



}
