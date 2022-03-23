<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Grade;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Jadwal;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = User::select('id')->count();
        $kelas = Kelas::select('id')->count();
        $guru = User::select('id')->where('level', 'guru')->count();
        $mapel = Mapel::select('id')->count();

        return view('Pages.Admin.Admin', compact('user','kelas','guru','mapel'));
    }

    public function guru()
    {
        $guru = User::orderBy('name', 'ASC')->where('level', 'guru')->get();

        return view('Pages.Admin.DaftarGuru', compact('guru'));
    }

    public function addGuru()
    {
        $kelas = Kelas::orderBy('kelas', 'ASC')->get();
        $grade = Grade::orderBy('grade', 'ASC')->get();

        return view('Pages.Admin.AddGuru', compact('kelas','grade'));
    }

    public function saveGuru(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'grade' => 'required',
            'kelas' => 'required',
        ],
        [
            'name.required' => 'Nama wajib di isi',
            'email.required' => 'Email wajib di isi',
            'email.unique' => 'Email sudah di gunakan',
            'password.required' => 'Password wajib di isi',
            'password.min' => 'Minimal password 6 digit',
            'password.confirmed' => 'Konfirmasi password salah',
        ]);
        
        $data = [
            'id_kelas' => $request->kelas,
            'name' => $request->name,
            'email' => $request->email,
            'id_grade' => $request->grade,
            'level' => 'guru',
            'password' => Hash::make($request->password)
        ];

        User::create($data);

        return redirect()->route('guru')->with('berhasil', 'Sucsess');

    }

    public function editGuru(Request $request, $id)
    {
        if (!$id) {
            abort(404);
        }

        $guru = User::findOrFail($id);

        // dd($guru);

        return view('Pages.Admin.EditGuru', compact('guru'));

    }

    public function updateGuru(Request $request, $id)
    {
        if (!$id) {
            abort(404);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ],
        [
            'name.required' => 'Nama wajib di isi',
            'email.required' => 'Email wajib di isi',
            'email.unique' => 'Email sudah di gunakan',
            'password.required' => 'Password wajib di isi',
            'password.min' => 'Minimal password 6 digit',
            'password.confirmed' => 'Konfirmasi password salah',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        User::findOrFail($id)->update($data);

        return redirect()->route('guru')->with('edit', 'Edited');
    }

    public function deleteGuru(Request $request, $id)
    {
        User::find($id)->delete();

        return redirect()->route('guru')->with('hapus', 'Deleted');
    }

    public function user()
    {

        $user = DB::table('kelas')
                    ->join('users', 'users.id_kelas', '=', 'kelas.id')
                    ->join('grades', 'users.id_grade', '=', 'grades.id')
                    ->select('users.id', 'kelas.kelas', 'users.id_kelas', 'users.name', 'users.email', 'users.id_grade', 'users.level', 'grades.grade')
                    ->orderBy('users.name', 'ASC')
                    ->get();

        // dd($user);

        return view('Pages.Admin.DaftarUser', compact('user'));
    }

    public function addUser()
    {

        $kelas = Kelas::orderBy('kelas', 'ASC')->get();
        $grade = Grade::orderBy('grade', 'ASC')->get();

        return view('Pages.Admin.AddUser', compact('kelas','grade'));
    }

    public function saveUser(Request $request)
    {

        // dd($request->all());

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'grade' => 'required',
            'level' => 'required',
            // 'kelas', 'required',
        ], [
            'name.required' => 'Nama wajib di isi',
            'email.required' => 'Email wajib di isi',
            'email.unique' => 'Email sudah di gunakan',
            'grade.required' => 'Tingkatan wajib di pilih',
            'grade.required' => 'Grade wajib ',
            'level.required' => 'Level wajib di pilih',
            'kelas.required' => 'Kelas wajib di pilih',
            'password.required' => 'Password wajib di isi',
            'password.min' => 'Minimal password 6 digit',
            'password.confirmed' => 'Konfirmasi password salah',
        ]);

        $data = [
            'id_kelas' => $request->kelas,
            'name' => $request->name,
            'email' => $request->email,
            'id_grade' => $request->grade,
            'level' => $request->level,
            'password' => Hash::make($request->password),
        ];

        // dd($data);

        User::create($data);

        return redirect()->route('user')->with('berhasil', 'Pengguna berhasil di tambahkan');
    }

    public function editUser(Request $request, $id)
    {
        if (!$id) {
            abort(404);
        }

        $user = DB::table('kelas')
                    ->join('users', 'users.id_kelas', '=', 'kelas.id')
                    ->join('grades', 'users.id_grade', '=', 'grades.id')
                    ->select('users.id', 'kelas.kelas', 'users.id_kelas', 'users.name', 'users.email', 'users.id_grade', 'users.level', 'grades.grade')
                    ->where('users.id', $id)
                    ->orderBy('users.name', 'ASC')
                    ->get();
        
        // dd($user);

        $kelas = Kelas::orderBy('kelas', 'ASC')->get();
        $grade = Grade::orderBy('grade', 'ASC')->get();

        // dd($user);

        return view('Pages.Admin.EditUser', compact('user','kelas','grade'));
    }

    public function updateUser(Request $request,  $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            // 'grade' => 'required',
            'level' => 'required',
            'kelas' => 'required',
        ], [
            'name.required' => 'Nama wajib di isi',
            'email.required' => 'Email wajib di isi',
            'email.unique' => 'Email sudah di gunakan',
            'grade.required' => 'Grade wajib di pilih',
            // 'grade.required' => 'Grade wajib ',
            'level.required' => 'Level wajib di pilih',
            'kelas.required' => 'Kelas wajib di pilih',
            'password.required' => 'Password wajib di isi',
            'password.min' => 'Minimal password 6 digit',
            'password.confirmed' => 'Konfirmasi password salah',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_grade' => $request->grade,
            'level' => $request->level,
            'id_kelas' => $request->kelas,
        ];

        User::find($id)->update($data);

        return redirect()->route('user')->with('edit', 'Data pengguna berhasil di edit');
    }

    public function deleteUser(Request $request, $id)
    {
        User::find($id)->delete($id);

        return redirect()->route('user')->with('hapus', 'Pengguna berhasil di hapus');
    }

    public function kelas()
    {
        $kelas = DB::table('kelas')
                    ->join('users', 'kelas.id_walas', '=', 'users.id')
                    ->orderBy('kelas', 'ASC')
                    ->select('kelas.*', 'users.name')
                    ->get();

        return view('Pages.Admin.DaftarKelas', compact('kelas'));
    }

    public function addKelas()
    {
        $walas = User::orderBy('name', 'ASC')->where('level', 'guru')->get();

        $grade = Grade::orderBy('grade', 'ASC')->get();

        return view('Pages.Admin.AddKelas', compact('walas','grade'));
    }

    public function saveKelas(Request $request)
    {
        $request->validate([
            'kelas' => 'required|unique:kelas,kelas',
            'walas' => 'required',
            'grade' => 'required',
        ],
        [
            'kelas.required' => 'Kelas wajib di isi !',
            'kelas.unique' => 'Kelas sudah ada.',
            'walas.required' => 'Wali Kelas wajib di pilih !',
            'grade.required' => 'Tingkatan Kelas wajib di pilih !'
        ]);

        $data = [
            'kelas' => strtoupper($request->kelas),
            'id_walas' => $request->walas,
            'id_grade' => $request->grade,
        ];

        Kelas::create($data);

        return redirect()->route('kelas')->with('berhasil', 'Sukses');

    }

    public function editKelas(Request $request, $id)
    {
        if (!$id) {
            abort(404);
        }

        $kelas = DB::table('kelas')
                    ->join('users', 'kelas.id_walas', '=', 'users.id')
                    ->where('kelas.id', $id)
                    ->select('kelas.*', 'users.name')
                    ->get();

        $walas = User::orderBy('name', 'ASC')->where('level', 'guru')->get();

        // dd($walas);

        return view('Pages.Admin.EditKelas', compact('kelas','walas'));
    }

    public function updateKelas(Request $request, $id)
    {
        $request->validate([
            'kelas' => 'required',
            'walas' => 'required',
        ],
        [
            'kelas.required' => 'Kelas wajib di isi !',
            'walas.required' => 'Wali Kelas wajib di pilih !'
        ]);

        $data = [
            'kelas' => strtoupper($request->kelas),
            'id_walas' => $request->walas,
        ];

        Kelas::findOrFail($id)->update($data);

        return redirect()->route('kelas')->with('edit', 'Edited');
    }

    public function deleteKelas(Request $request, $id)
    {
        if (!$id) {
            abort(404);
        }

        Kelas::findOrFail($id)->delete();

        return redirect()->route('kelas')->with('hapus', 'Deleted');

    }

    public function mapel()
    {
        $mapel = DB::table('mapels')
                    ->join('users', 'mapels.id_guru', '=', 'users.id')
                    ->join('grades', 'mapels.id_grade', '=', 'grades.id')
                    ->select('mapels.id', 'mapels.mapel', 'mapels.produktif', 'mapels.img', 'users.name', 'grades.grade')
                    ->get();

        return view('Pages.Admin.DaftarMapel', compact('mapel'));
    }

    public function addMapel()
    {
        $guru = User::orderBy('name','ASC')->where('level','guru')->get();
        $grade = Grade::orderBy('grade','ASC')->get();

        return view('Pages.Admin.AddMapel', compact('guru','grade'));
    }

    public function saveMapel(Request $request)
    {
        $request->validate([
            'guru' => 'required',
            'mapel' => 'required|string',
            'grade' => 'required',
            'produktif' => 'required',
            'img' => 'required|max:5120',
        ],
        [
            'guru.required' => 'Nama Guru Mata Pelajaran Wajib di pilih!',
            'mapel.required' => 'Mata Pelajaran Wajib di isi!',
            'mapel.string' => 'Mata Pelajaran Hanya di Perbolehkan Alphabet',
            'grade.required' => 'Tingkatan Wajib di pilih!',
            'produktif.required' => 'Jawaban Wajib di pilih?',
            'img.required' => 'Gambar Mata Pelajaran Wajib ada!',
            // 'img.mimes' => 'Gambar Mata Pelajaran Hanya di perbolehkan JPG,PNG,JPEG',
            'img.max' => 'Maksimum Ukuran Gambar Mata Pelajaran 5MB'
        ]);

        $rdm = Str::random(10);
        $file = $request->img;
        $fileName = $rdm . '_' . $request->mapel . '.' . $file->extension();
        $file->move(public_path('gambar_mapel'), $fileName);

        $data = [
            'id_guru' => $request->guru,
            'id_grade' => $request->grade,
            'mapel' => ucwords($request->mapel),
            'produktif' => $request->produktif,
            'img' => $fileName,
        ];

        // dd($data);

        Mapel::create($data);

        return redirect()->route('admin-mapel')->with('berhasil', 'Sucess');

    }

    public function editMapel(Request $request, $id)
    {
        if (!$id) {
            abort(404);
        }

        $mapel = Mapel::findOrFail($id);
        $guru = User::orderBy('name','ASC')->where('level', 'guru')->get();
        $grade = Grade::orderBy('grade', 'ASC')->get();

        return view('Pages.Admin.EditMapel', compact('mapel','guru','grade'));
    }

    public function updateMapel(Request $request, $id)
    {
        if (!$id) {
            abort(404);
        }

        if ($request->img == NULL) {
            $request->validate([
                'guru' => 'required',
                'mapel' => 'required|string',
                'grade' => 'required',
                'produktif' => 'required',
                // 'img' => 'required|max:5120',
            ],
            [
                'guru.required' => 'Nama Guru Mata Pelajaran Wajib di pilih!',
                'mapel.required' => 'Mata Pelajaran Wajib di isi!',
                'mapel.string' => 'Mata Pelajaran Hanya di Perbolehkan Alphabet',
                'grade.required' => 'Tingkatan Wajib di pilih!',
                'produktif.required' => 'Jawaban Wajib di pilih?',
                // 'img.required' => 'Gambar Mata Pelajaran Wajib ada!',
                // // 'img.mimes' => 'Gambar Mata Pelajaran Hanya di perbolehkan JPG,PNG,JPEG',
                // 'img.max' => 'Maksimum Ukuran Gambar Mata Pelajaran 5MB'
            ]);
    
            // $rdm = Str::random(10);
            // $file = $request->img;
            // $fileName = $rdm . $request->mapel . '.' . $file->extension();
            // $file->move(public_path('gambar_mapel'), $fileName);
    
            $data = [
                'id_guru' => $request->guru,
                'id_grade' => $request->grade,
                'mapel' => ucwords($request->mapel),
                'produktif' => $request->produktif,
                // 'img' => $fileName,
            ];
    
            // dd($data);
    
            Mapel::findOrFail($id)->update($data);

            return redirect()->route('admin-mapel')->with('edit', 'Edited');
        }else {
            $request->validate([
                'guru' => 'required',
                'mapel' => 'required|string',
                'grade' => 'required',
                'produktif' => 'required',
                'img' => 'max:5120',
            ],
            [
                'guru.required' => 'Nama Guru Mata Pelajaran Wajib di pilih!',
                'mapel.required' => 'Mata Pelajaran Wajib di isi!',
                'mapel.string' => 'Mata Pelajaran Hanya di Perbolehkan Alphabet',
                'grade.required' => 'Tingkatan Wajib di pilih!',
                'produktif.required' => 'Jawaban Wajib di pilih?',
                // 'img.required' => 'Gambar Mata Pelajaran Wajib ada!',
                // 'img.mimes' => 'Gambar Mata Pelajaran Hanya di perbolehkan JPG,PNG,JPEG',
                'img.max' => 'Maksimum Ukuran Gambar Mata Pelajaran 5MB'
            ]);
    
            $rdm = Str::random(10);
            $file = $request->img;
            $fileName = $rdm . '_' . $request->mapel . '.' . $file->extension();
            $file->move(public_path('gambar_mapel'), $fileName);
    
            $data = [
                'id_guru' => $request->guru,
                'id_grade' => $request->grade,
                'mapel' => $request->mapel,
                'produktif' => $request->produktif,
                'img' => $fileName,
            ];
    
            // dd($data);
    
            Mapel::findOrFail($id)->update($data);

            return redirect()->route('admin-mapel')->with('edit', 'Edited');
        }

    }

    public function deleteMapel(Request $request, $id)
    {
        if (!$id) {
            abort(404);
        }

        Mapel::where('id', $id)->delete();

        return redirect()->route('admin-mapel')->with('hapus', 'Deleted');
    }

    public function jadwal()
    {
        $kelas = Kelas::orderBy('kelas', 'ASC')->get();

        return view('Pages.Admin.DaftarJadwal', compact('kelas'));
    }

    public function detailJadwal($kelas)
    {

        $Kelas = str_replace('-', ' ', $kelas);

        $cek = Kelas::where('kelas', $Kelas)->select('id')->get();
        
        try {
            foreach ($cek as $c) {
                $id = $c->id;
            }
    
            // dd($id);
    
            $jadwal = DB::table('jadwals')
                        ->join('kelas', 'jadwals.id_kelas', '=', 'kelas.id')
                        ->join('grades', 'jadwals.id_grade', '=', 'grades.id')
                        ->join('mapels', 'jadwals.id_mapel', '=', 'mapels.id')
                        ->join('users', 'mapels.id_guru', '=', 'users.id')
                        ->where('jadwals.id_kelas', $id)
                        ->select('jadwals.*', 'grades.grade', 'kelas.kelas', 'mapels.id_guru', 'mapels.mapel', 'mapels.produktif', 'users.name')
                        ->get();
    
            // dd($jadwal);
    
            return view('Pages.Admin.DetailJadwal', compact('jadwal', 'Kelas'));
        } catch (Exception $e) {
            abort(404);
        }

    }

    public function addJadwalKelas($kelas)
    {
        $Kelas = str_replace('-', ' ', $kelas);

        $cek = Kelas::where('kelas', $Kelas)->select('id_grade')->get();

        try {
            foreach ($cek as $c) {
                $id_grade = $c->id_grade;
            }
    
            $grade = Grade::orderBy('grade', 'ASC')->get();
    
            $mapel = Mapel::orderBy('mapel', 'ASC')->where('id_grade', $id_grade)->get();
    
            // dd($id_grade);
    
            return view('Pages.Admin.AddJadwalKelas', compact('Kelas', 'grade', 'mapel'));
        } catch (Exception $e) {
            abort(404);
        }
    }

    public function saveJadwalKelas(Request $request, $kelas)
    {

        // dd($request->all());
        $request->validate([
            'mapel' => 'required'
        ],
        [
            'mapel.required' => 'Mata Pelajaran wajib di pilih!',
        ]);


        $Kelas = str_replace('-', ' ', $kelas);

        $url = "/admin/mapel-kelas/daftar-mapel-" . $kelas;

        $urlError = "admin/tambah-mapel-kelas-" . $kelas;

        $cek = Kelas::where('kelas', $Kelas)->get();

        try {
            foreach ($cek as $c) {
                $id_kelas = $c->id;
                $id_grade = $c->id_grade;
            }
    
            $data = [
                'id_kelas' => $id_kelas,
                'id_grade' => $id_grade,
                'id_mapel' => $request->mapel,
            ];
    
            // dd($data);
            
            $Vmapel = Jadwal::where(['id_kelas' => $id_kelas, 'id_mapel' => $request->mapel])->count();
    
            if ($Vmapel == 0) {
                Jadwal::create($data);
                return Redirect::to($url)->with('success', 'sukses');
            } else {
                return Redirect::to($urlError)->with('Verorr', 'error');
            }
        } catch (Exception $e) {
            abort(404);
        }
        
    }

    public function deleteJadwal($kelas, $id)
    {

        // dd($id);

        $url = "/admin/mapel-kelas/daftar-mapel-" . $kelas;

        Jadwal::find($id)->delete();

        return Redirect::to($url)->with('hapus', 'deleted');
    }

    public function grades()
    {
        $grade = Grade::orderBy('grade', 'ASC')->get();

        return view('Pages.Admin.DaftarGrades', compact('grade'));
    }

    public function addGrades()
    {
        return view('Pages.Admin.AddGrades');
    }

    public function saveGrades(Request $request)
    {
        $request->validate([
            'grades' => 'required|unique:grades,grade',
        ],
        [
            'grades.required' => 'Tingkatan wajib di isi!',
            'grades.unique' => 'Tingkatan sudah ada!'
        ]);

        $data = [
            'grade' => strtoupper($request->grades),
        ];

        // dd($request->all());

        Grade::create($data);

        return redirect()->route('grades')->with('berhasil', 'sukses');
    }

    public function editGrades($id)
    {

        $ID  = Crypt::decrypt($id);

        $grade = Grade::find($ID);

        return view('Pages.Admin.EditGrades', compact('grade'));
    }

    public function updateGrades(Request $request, $id)
    {

        $ID = Crypt::decrypt($id);

        $cek = Grade::find($ID);

        // dd($request->grades == $cek->grade);

        if ($request->grades == $cek->grade) {
            $request->validate([
                'grades' => 'required',
            ],
            [
                'grades.required' => 'Tingkatan wajib di isi!',
                // 'grades.unique' => 'Tingkatan sudah ada!'
            ]);
    
            $data = [
                'grade' => strtoupper($request->grades),
            ];
    
            // dd($request->all());
    
            Grade::find($ID)->update($data);
    
            return redirect()->route('grades')->with('edit', 'edit');
        } else {
            $request->validate([
                'grades' => 'required|unique:grades,grade',
            ],
            [
                'grades.required' => 'Tingkatan wajib di isi!',
                'grades.unique' => 'Tingkatan sudah ada!'
            ]);
    
            $data = [
                'grade' => strtoupper($request->grades),
            ];
    
            // dd($request->all());
    
            Grade::find($ID)->update($data);

            return redirect()->route('grades')->with('edit', 'edit');
        }
        
    }

    public function deleteGrades($id)
    {
        $ID = Crypt::decrypt($id);

        Grade::find($ID)->delete();

        return redirect()->route('grades')->with('hapus', 'deleted');
    }


}
