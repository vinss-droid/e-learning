<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MapelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $Produktif = DB::table('jadwals')
                            ->join('mapels', 'jadwals.id_mapel', '=', 'mapels.id')
                            ->join('grades', 'jadwals.id_grade', '=', 'grades.id')
                            ->where(['jadwals.id_kelas' => Auth::user()->id_kelas, 'mapels.produktif' => '1'])
                            ->select('jadwals.*', 'mapels.mapel', 'mapels.produktif', 'mapels.img', 'grades.grade')
                            ->get();

        $CProduktif =  DB::table('jadwals')
                            ->join('mapels', 'jadwals.id_mapel', '=', 'mapels.id')
                            ->join('grades', 'jadwals.id_grade', '=', 'grades.id')
                            ->where(['jadwals.id_kelas' => Auth::user()->id_kelas, 'mapels.produktif' => '1'])
                            ->select('jadwals.*', 'mapels.mapel', 'mapels.produktif', 'mapels.img' , 'grades.grade')
                            ->count();

        $NonProduktif =  DB::table('jadwals')
                            ->join('mapels', 'jadwals.id_mapel', '=', 'mapels.id')
                            ->join('grades', 'jadwals.id_grade', '=', 'grades.id')
                            ->where(['jadwals.id_kelas' => Auth::user()->id_kelas, 'mapels.produktif' => '0'])
                            ->select('jadwals.*', 'mapels.mapel', 'mapels.produktif', 'mapels.img' , 'grades.grade')
                            ->get();

        $CNonProduktif =  DB::table('jadwals')
                            ->join('mapels', 'jadwals.id_mapel', '=', 'mapels.id')
                            ->join('grades', 'jadwals.id_grade', '=', 'grades.id')
                            ->where(['jadwals.id_kelas' => Auth::user()->id_kelas, 'mapels.produktif' => '0'])
                            ->select('jadwals.*', 'mapels.mapel', 'mapels.produktif', 'mapels.img' , 'grades.grade')
                            ->count();

        // dd($NonProduktif);

        return view('Pages.Students.Mapel', compact('Produktif','NonProduktif', 'CProduktif', 'CNonProduktif'));
    }
}
