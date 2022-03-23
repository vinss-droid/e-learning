<table>
    <thead>
  
      <tr>
  
        <th width="15" height="30" valign="center" align="center" style="background-color: #4400fe; color: white;  border: 1px solid black;">No</th>
  
        <th width="80" height="80" valign="center" align="center" style="background-color: #4400fe; color: white;  border: 1px solid black;">Nama Siswa</th>
  
        <th  width="30" height="30" valign="center" align="center" style="background-color: #4400fe; color: white;  border: 1px solid black;">Status Mengerjakan</th>
  
      </tr>
  
    </thead>
  
    <tbody>

        @php
            $no = 1;
        @endphp
        
        @foreach ($siswa as $s)

            @php
                $cek = DB::table('users')
                            ->join('pengumpulan_tugas', 'users.id', '=', 'pengumpulan_tugas.id_siswa')
                            ->join('tugas', 'pengumpulan_tugas.id_tugas', '=', 'tugas.id')
                            ->join('mapels', 'tugas.id_mapel', '=', 'mapels.id')
                            ->join('kelas', 'users.id_kelas', '=', 'kelas.id')
                            ->where(['pengumpulan_tugas.id_tugas' => $id_tugas, 'kelas.id' => $id_kelas, 'pengumpulan_tugas.id_siswa' => $s->id])
                            ->select('pengumpulan_tugas.*', 'tugas.week', 'users.name', 'mapels.mapel')
                            ->count();
            @endphp

            <tr>

                <td valign="center" align="center" style="border: 1px solid black; height: 20px;">{{ $no++ }}</td>
        
                <td valign="center" align="center" style="border: 1px solid black; height: 20px;">{{ $s->name }}</td>
            
                <td  valign="center" align="center" style="border: 1px solid black height: 20px;;">
                    @if ($cek > 0)
                        {{ 'YA' }}
                    @else
                        {{ 'Tidak' }}
                    @endif
                </td>
            
                </tr>
        @endforeach
        
    </tbody>
  </table>