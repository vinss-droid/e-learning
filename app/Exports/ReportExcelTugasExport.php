<?php

namespace App\Exports;

use Exception;
use App\Models\Grade;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Tugas;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class ReportExcelTugasExport implements FromView
{

    public function __construct($grade, $mapel, $week, $kelas)
    {
        $this->Mapel = str_replace('-', ' ', $mapel);

        $this->Kelas = str_replace('-', ' ', $kelas);

        $this->Grade = Grade::where('grade', $grade)->get();

        $this->week = $week;

    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {

        $cekKelas = Kelas::where('kelas', $this->Kelas)->get();

        foreach($this->Grade as $g) {
            $id_grade = $g->id;
            $grade = $g->grade;
        }

        foreach ($cekKelas as $c) {
            $id_kelas = $c->id;
        }

        // dd($cekKelas);

        $cek = Mapel::where(['id_grade' => $id_grade, 'mapel' => $this->Mapel])->get();

        try {
            foreach ($cek as $c) {
                $id_mapel = $c->id;
            }
    
            $cekTugas = Tugas::where(['week' => $this->week, 'id_mapel' => $id_mapel])->get();
    
            foreach ($cekTugas as $t) {
                $id_tugas = $t->id;
            }

            // $kelas  = DB::table('users')
            //                 ->rightJoin('pengumpulan_tugas', 'users.id', '=', 'pengumpulan_tugas.id_siswa')
            //                 ->rightJoin('tugas', 'pengumpulan_tugas.id_tugas', '=', 'tugas.id')
            //                 ->rightJoin('mapels', 'tugas.id_mapel', '=', 'mapels.id')
            //                 ->rightJoin('kelas', 'users.id_kelas', '=', 'kelas.id')
            //                 ->where(['pengumpulan_tugas.id_tugas' => $id_tugas, 'kelas.id' => $id_kelas])
            //                 ->select('pengumpulan_tugas.*', 'tugas.week', 'users.name', 'mapels.mapel')
            //                 ->get();

            $siswa = DB::table('users')
                            ->where(['users.level' => 'siswa', 'users.id_kelas' => $id_kelas])
                            ->orderBy('name', 'ASC')
                            ->select('name', 'id')
                            ->get();

            // dd($siswa);

            return view('Pages.Teachers.Mapel.Tugas.Excel.ReportExcel', compact('siswa', 'id_mapel', 'id_tugas', 'id_kelas'));
                            
        } catch (Exception $e) {
            abort(404);
        }
    }
}
