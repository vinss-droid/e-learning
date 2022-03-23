<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Grade;
use App\Models\Mapel;
use App\Models\Tugas;
use App\Models\PTugas;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class StudentsController extends Controller
{

    public function lihatMapel($mapel)
    {
        $Mapel = str_replace('-', ' ', $mapel);

        $cek = Mapel::where(['id_grade' => Auth::user()->id_grade, 'mapel' => $Mapel])->get();

        try {
            foreach ($cek as $c) {
                $id_mapel = $c->id;
            }
    
            $tugas = DB::table('tugas')
                        ->join('mapels', 'tugas.id_mapel', '=', 'mapels.id')
                        ->join('grades', 'mapels.id_grade', '=', 'grades.id')
                        ->where(['mapels.id' => $id_mapel])
                        ->select('tugas.*', 'mapels.mapel', 'mapels.produktif', 'grades.grade')
                        ->orderBy('tugas.week', 'ASC')
                        ->get();

            // dd($tugas);

            return view('Pages.Students.SiswaTugas', compact('tugas', 'Mapel'));

        } catch (Exception $e) {
            abort(404);
        }
    }

    public function lihatTugas($mapel, $week)
    {
        $Mapel = str_replace('-', ' ', $mapel);

        $cek = Mapel::where(['id_grade' => Auth::user()->id_grade, 'mapel' => $Mapel])->get();

        try {
            foreach ($cek as $c) {
                $id_mapel = $c->id;
            }

            $cekTugas = Tugas::where(['week' => $week, 'id_mapel' => $id_mapel])->get();

            foreach ($cekTugas as $t) {
                $id_tugas = $t->id;
            }
    
            // dd($id_tugas);

            $tugas = DB::table('tugas')
                        ->join('mapels', 'tugas.id_mapel', '=', 'mapels.id')
                        ->join('grades', 'mapels.id_grade', '=', 'grades.id')
                        ->where(['mapels.id' => $id_mapel, 'tugas.id' => $id_tugas])
                        ->select('tugas.*', 'mapels.mapel', 'mapels.produktif', 'grades.grade')
                        ->get();

            // dd($tugas);

            return view('Pages.Students.LihatTugas', compact('tugas', 'Mapel', 'week'));

        } catch (Exception $e) {
            abort(404);
        }

    }

    public function downloadFileTugas($mapel, $week)
    {
        $Mapel = str_replace('-', ' ', $mapel);

        $cek = Mapel::where(['id_grade' => Auth::user()->id_grade, 'mapel' => $Mapel])->get();

        try {
            foreach ($cek as $c) {
                $id_mapel = $c->id;
            }

            $cekTugas = Tugas::where(['week' => $week, 'id_mapel' => $id_mapel])->get();

            foreach ($cekTugas as $t) {
                $id_tugas = $t->id;
            }
    
            // dd($id_tugas);

            $tugas = DB::table('tugas')
                        ->join('mapels', 'tugas.id_mapel', '=', 'mapels.id')
                        ->join('grades', 'mapels.id_grade', '=', 'grades.id')
                        ->where(['mapels.id' => $id_mapel, 'tugas.id' => $id_tugas])
                        ->select('tugas.*', 'mapels.mapel', 'mapels.produktif', 'grades.grade')
                        ->get();

            // dd($tugas);

            foreach ($tugas as $t) {
                $file = $t->file;
            }

            $fileTugas = public_path('tugas/tugas/' . $file);
    
            return response()->download($fileTugas);
        } catch (Exception $e) {
            abort(404);
        }
    }

    public function pengumpulanTugas($mapel, $week)
    {
        $Mapel = str_replace('-', ' ', $mapel);
        
        $cek = Mapel::where(['id_grade' => Auth::user()->id_grade, 'mapel' => $Mapel])->get();

        try {
            foreach ($cek as $c) {
                $id_mapel = $c->id;
            }

            $cekTugas = Tugas::where(['week' => $week, 'id_mapel' => $id_mapel])->get();

            foreach ($cekTugas as $t) {
                $id_tugas = $t->id;
            }
    
            // dd($id_tugas);

            $cekP = DB::table('pengumpulan_tugas')
                        ->where(['id_tugas' => $id_tugas, 'id_siswa' => Auth::user()->id])
                        ->count();

            $Ptugas = DB::table('pengumpulan_tugas')
                        ->where(['id_tugas' => $id_tugas, 'id_siswa' => Auth::user()->id])
                        ->get();

            $tugas = DB::table('tugas')
                        ->join('mapels', 'tugas.id_mapel', '=', 'mapels.id')
                        ->join('grades', 'mapels.id_grade', '=', 'grades.id')
                        ->where(['mapels.id' => $id_mapel, 'tugas.id' => $id_tugas])
                        ->select('tugas.*', 'mapels.mapel', 'mapels.produktif', 'grades.grade')
                        ->get();

            $dateNow = date('d-m-Y H:i');

            return view('Pages.Students.PengumpulanTugas', compact('Mapel', 'week', 'cekP', 'Ptugas', 'tugas', 'dateNow'));            
        } catch (Exception $e) {
           abort(404);
        }
    }

    public function savePengumpulanTugas(Request $request, $mapel, $week)
    {

        $request->validate([
            'file' => 'required|max:10124',
        ],
        [
            'file.required' => 'File Tugas Wajib diisi !',
            'file.max' => 'File Tugas Tidak Boleh Lebih dari 10MB',
        ]);

        $Mapel = str_replace('-', ' ', $mapel);

        $url = "/siswa/pengumpulan-tugas/tugas-mata-pelajaran-" . $mapel . "/" . $week;

        $cek = Mapel::where(['id_grade' => Auth::user()->id_grade, 'mapel' => $Mapel])->get();

        try {

            foreach ($cek as $c) {
                $id_mapel = $c->id;
            }

            $cekTugas = Tugas::where(['week' => $week, 'id_mapel' => $id_mapel])->get();

            foreach ($cekTugas as $t) {
                $id_tugas = $t->id;
            }

            $rdm = Str::random(10);
            $file = $request->file;
            $fileName = $rdm . '_' . Auth::user()->name . '.' . $file->extension();
            $file->move(public_path('tugas/pengumpulan_tugas/'), $fileName);

            $data = [
                'id_tugas' => $id_tugas,
                'id_siswa' => Auth::user()->id,
                'file_tugas' => $fileName,
            ];

            PTugas::create($data);

            return Redirect::to($url);

        } catch (Exception $e) {
            abort(404);
        }
    }
}
