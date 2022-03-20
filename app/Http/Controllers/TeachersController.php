<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Tugas;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;

class TeachersController extends Controller
{
    public function index()
    {

        $mapel = Mapel::where('id_guru', Auth::user()->id)->count();

        return view('Pages.Teachers.Teachers', compact('mapel'));

    }

    public function mapel()
    {
        $mapel = DB::table('mapels')
                    ->join('grades', 'mapels.id_grade', '=', 'grades.id')
                    ->where('mapels.id_guru', Auth::user()->id)
                    ->select('mapels.*', 'grades.grade')
                    ->orderBy('mapels.mapel', 'ASC')
                    ->get();

        return view('Pages.Teachers.Mapel.TeachersMapel', compact('mapel'));
    }

    public function tugasMapel($grade, $mapel)
    {
        $Mapel = str_replace('-', ' ', $mapel);

        $grade = Grade::where('grade', $grade)->get();

        foreach($grade as $g) {
            $id_grade = $g->id;
            $grade = $g->grade;
        }

        $cek = Mapel::where(['id_grade' => $id_grade, 'mapel' => $Mapel])->get();

        // dd($grade);

        try {
            foreach ($cek as $c) {
                $id_mapel = $c->id;
            }
    
            $tugas = DB::table('tugas')
                        ->join('mapels', 'tugas.id_mapel', '=', 'mapels.id')
                        ->join('grades', 'mapels.id_grade', '=', 'grades.id')
                        ->where(['mapels.id_guru' => Auth::user()->id, 'mapels.id' => $id_mapel])
                        ->select('tugas.*', 'mapels.mapel', 'mapels.produktif', 'grades.grade')
                        ->orderBy('tugas.week')
                        ->get();
    
            return view('Pages.Teachers.Mapel.Tugas.TeachersTugas', compact('tugas','Mapel', 'grade'));
        } catch (Exception $e) {
            abort(404);
        }

    }

    public function addTugas($grade, $mapel)
    {
        $Mapel = str_replace('-', ' ', $mapel);

        return view('Pages.Teachers.Mapel.Tugas.AddTeachersTugas', compact('Mapel','grade'));
    }

    public function saveTugas(Request $request, $grade, $mapel)
    {

        $url = 'guru/mata-pelajaran/' . $grade . '/tugas-mata-pelajaran-' . $mapel;

        $Mapel = str_replace('-', ' ', $mapel);

        $grade = Grade::where('grade', $grade)->get();

        foreach($grade as $g) {
            $id_grade = $g->id;
            $grade = $g->grade;
        }

        $cek = Mapel::where(['id_grade' => $id_grade, 'mapel' => $Mapel])->get();

        // dd($cek);

        // try {
            foreach ($cek as $c) {
                $id_mapel = $c->id;
            }
    
            $request->validate([
                'week' => 'required',
                'deadline' => 'required',
                'judul' => 'required|unique:tugas,judul',
                'deskripsi' => 'required',
                'tugas' => 'required',
            ],
            [
                'week.required' => 'Week wajib di isi!',
                'deadline.required' => 'Deadline wajib di isi!',
                'judul.required' => 'Judul wajib di isi!',
                'deskripsi.required' => 'Deskripsi wajib di isi!',
                'tugas.required' => 'Tugas wajib di isi!'
            ]);
    
            $deadline = date('d-m-Y H:i', strtotime($request->deadline));
    
            if ($request->file == null) {
                $data = [
                    'id_mapel' => $id_mapel,
                    'week' => strtoupper($request->week),
                    'judul' => ucwords($request->judul),
                    'deskripsi' => $request->deskripsi,
                    'tugas' => $request->tugas,
                    'link' => $request->link,
                    'file' => $request->file,
                    'meet' => $request->meet,
                    'deadline' => $deadline
                ];
                
                // dd($data);
    
                Tugas::create($data);
    
                return Redirect::to($url)->with('berhasil', 'berhasil');
            } else {
                $rdm = Str::random(10);
                $file = $request->file;
                $fileName = $rdm . '_' . $mapel . '-' . $request->week . '.' . $file->extension();
                $file->move(public_path('/tugas/tugas'), $fileName);
                
    
                $data = [
                    'id_mapel' => $id_mapel,
                    'week' => strtoupper($request->week),
                    'judul' => ucwords($request->judul),
                    'deskripsi' => $request->deskripsi,
                    'tugas' => $request->tugas,
                    'link' => $request->link,
                    'file' => $fileName,
                    'meet' => $request->meet,
                    'deadline' => $deadline
                ];
                
                // dd($data);
    
                Tugas::create($data);
    
                return Redirect::to($url)->with('berhasil', 'berhasil');
            }
        // } catch (Exception $e) {
        //     abort(404);
        // }

    }

    public function lihatTugas($mapel, $week)
    {

        $Mapel = str_replace('-', ' ', $mapel);

        $cek = Mapel::where('mapel', $Mapel)->get();

        // dd($mapel);

        try {

            foreach ($cek as $c) {
                $id_mapel = $c->id;
            }

            $cekTugas = Tugas::where(['week' => $week, 'id_mapel' => $id_mapel])->get();

            foreach ($cekTugas as $t) {
                $id_tugas = $t->id;
            }
    
            $tugas = DB::table('tugas')
                        ->join('mapels', 'tugas.id_mapel', '=', 'mapels.id')
                        ->join('grades', 'mapels.id_grade', '=', 'grades.id')
                        ->where(['mapels.id_guru' => Auth::user()->id, 'mapels.id' => $id_mapel, 'tugas.id' => $id_tugas])
                        ->select('tugas.*', 'mapels.mapel', 'mapels.produktif', 'grades.grade')
                        ->orderBy('tugas.week')
                        ->get();
                    
            // dd($tugas);
    
            return view('Pages.Teachers.Mapel.Tugas.ViewTugas', compact('tugas', 'Mapel'));
        } catch (Exception $e) {
            return $e;
        }
    }

    public function downloadFileTugas($mapel, $week)
    {
        $Mapel = str_replace('-', ' ', $mapel);

        $cek = Mapel::where('mapel', $Mapel)->get();

        // dd($mapel);

        try {

            foreach ($cek as $c) {
                $id_mapel = $c->id;
            }

            $cekTugas = Tugas::where(['week' => $week, 'id_mapel' => $id_mapel])->get();

            foreach ($cekTugas as $t) {
                $id_tugas = $t->id;
            }
    
            $tugas = DB::table('tugas')
                        ->join('mapels', 'tugas.id_mapel', '=', 'mapels.id')
                        ->join('grades', 'mapels.id_grade', '=', 'grades.id')
                        ->where(['mapels.id_guru' => Auth::user()->id, 'mapels.id' => $id_mapel, 'tugas.id' => $id_tugas])
                        ->select('tugas.*', 'mapels.mapel', 'mapels.produktif', 'grades.grade')
                        ->orderBy('tugas.week')
                        ->get();
                    
            foreach ($tugas as $t) {
                $file = $t->file;
            }

            $fileTugas = public_path('tugas/tugas/' . $file);
    
            return response()->download($fileTugas);
        } catch (Exception $e) {
            abort(404);
        }
    }

    public function editTugas($mapel, $week)
    {
        $Mapel = str_replace('-', ' ', $mapel);

        $cek = Mapel::where('mapel', $Mapel)->get();

        try {
            foreach ($cek as $c) {
                $id_mapel = $c->id;
            }
    
            $cekTugas = Tugas::where(['week' => $week, 'id_mapel' => $id_mapel])->get();
    
            foreach ($cekTugas as $t) {
                $id_tugas = $t->id;
            }
    
            $tugas = Tugas::find($id_tugas);
    
            return view('Pages.Teachers.Mapel.Tugas.EditTugas', compact('tugas', 'Mapel'));
        } catch (Exception $e) {
            abort(404);
        }
    }

    public function updateTugas(Request $request, $mapel, $week)
    {
        $url = 'guru/mata-pelajaran/lihat/tugas-mata-pelajaran-' . $mapel . '/' .  $week ;

        $Mapel = str_replace('-', ' ', $mapel);

        $cek = Mapel::where('mapel', $Mapel)->get();

        try {
            foreach ($cek as $c) {
                $id_mapel = $c->id;
            }

            $cekTugas = Tugas::where(['week' => $week, 'id_mapel' => $id_mapel])->get();

            foreach ($cekTugas as $t) {
                $id_tugas = $t->id;
                $judul = $t->judul;
            }
    
            if ($request->judul == $judul) {
                $request->validate([
                    'week' => 'required',
                    'deadline' => 'required',
                    'judul' => 'required',
                    'deskripsi' => 'required',
                    'tugas' => 'required',
                ],
                [
                    'week.required' => 'Week wajib di isi!',
                    'deadline.required' => 'Deadline wajib di isi!',
                    'judul.required' => 'Judul wajib di isi!',
                    'deskripsi.required' => 'Deskripsi wajib di isi!',
                    'tugas.required' => 'Tugas wajib di isi!'
                ]);
        
                $deadline = date('d-m-Y H:i', strtotime($request->deadline));
        
                $data = [
                    'id_mapel' => $id_mapel,
                    'week' => strtoupper($request->week),
                    'judul' => ucwords($request->judul),
                    'deskripsi' => $request->deskripsi,
                    'tugas' => $request->tugas,
                    'link' => $request->link,
                    // 'file' => $request->file,
                    'meet' => $request->meet,
                    'deadline' => $deadline
                ];
                
                // dd($data);
    
                Tugas::find($id_tugas)->update($data);
    
                return Redirect::to($url)->with('edit', 'berhasil');
            } else {
                $request->validate([
                    'week' => 'required',
                    'deadline' => 'required',
                    'judul' => 'required|unique:tugas,judul',
                    'deskripsi' => 'required',
                    'tugas' => 'required',
                ],
                [
                    'week.required' => 'Week wajib di isi!',
                    'deadline.required' => 'Deadline wajib di isi!',
                    'judul.required' => 'Judul wajib di isi!',
                    'deskripsi.required' => 'Deskripsi wajib di isi!',
                    'tugas.required' => 'Tugas wajib di isi!'
                ]);
        
                $deadline = date('d-m-Y H:i', strtotime($request->deadline));
        
                $data = [
                    'id_mapel' => $id_mapel,
                    'week' => strtoupper($request->week),
                    'judul' => ucwords($request->judul),
                    'deskripsi' => $request->deskripsi,
                    'tugas' => $request->tugas,
                    'link' => $request->link,
                    // 'file' => $request->file,
                    'meet' => $request->meet,
                    'deadline' => $deadline
                ];
                
                // dd($data);
    
                Tugas::find($id_tugas)->update($data);
    
                return Redirect::to($url)->with('edit', 'berhasil');
            }
            
        } catch (Exception $e) {
            abort(404);
        }
    }

    public function hapusTugas($mapel, $week)
    {
        $url = 'guru/mata-pelajaran/tugas-mata-pelajaran-' . $mapel;

        $Mapel = str_replace('-', ' ', $mapel);

        $cek = Mapel::where('mapel', $Mapel)->get();

        try {
            foreach ($cek as $c) {
                $id_mapel = $c->id;
            }
    
            $cekTugas = Tugas::where(['week' => $week, 'id_mapel' => $id_mapel])->get();
    
            foreach ($cekTugas as $t) {
                $id_tugas = $t->id;
            }

            Tugas::find($id_tugas)->delete();

            return Redirect::to($url)->with('hapus', 'hapus');

        } catch (Exception $e) {
            abort(404);
        }
    }
}
