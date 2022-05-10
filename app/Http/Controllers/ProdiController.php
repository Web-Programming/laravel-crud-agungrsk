<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prodi;
use Illuminate\Support\Facades\DB;

class ProdiController extends Controller
{

    public function index(){
        /*$data = [
            'prodi' => ['Manajemen Informatika', 'Sistem Informasi', 'Informatika']
        ];
    
        //atau menggunakan compact
        $prodi = ['Manajemen Informatika', 'Sistem Informasi', 'Informatika'];
        $kampus = "Universitas Multi Data Palembang";
    
        return view("prodi.index", compact('prodi', 'kampus'));*/

        $kampus = "Universitas Multi Data Palembang";
        $prodi = Prodi::all();

        /*$prodi = DB::select("SELECT prodi.*, fakultas.nama as namaf FROM prodi INNER JOIN fakultas ON prodi.fakultas_id = fakultas.id");*/
        
        return view("prodi.index")->with('prodi', $prodi);
    }

    public function show(Prodi $prodi){
        return view('prodi.show', ['prodi' => $prodi]);
    }

    public function edit(Prodi $prodi){
        return view('prodi.edit', ['prodi' => $prodi]);
    }

    function detail($id = null){
        echo $id;
    }

    public function create(){
        return view ('prodi.create');
    }

    public function update(Request $request, Prodi $prodi){
        // dump($request)
        //echo $request -> nama;
        $validateData = $request -> validate([
            'nama' => 'required|min:5|max:20',
        ]);

        Prodi::where('id', $prodi->id)->update($validateData);
        $request -> session() -> flash('info', "Data Prodi $prodi -> nama berhasil diubah");
        return redirect() -> route('prodi.index');
    }

    public function destroy(Prodi $prodi){
        $prodi->delete();
        return redirect()->route('prodi.index')
            ->with("info", "Prodi $prodi->nama berhasil dihapus");
    }


    public function store(Request $request){
        // dump($request)
        //echo $request -> nama;
        
        $validateData = $request -> validate([
            'nama' => 'required|min:5|max:20',
        ]);
        // dump($validateData);
        // echo $validateData['nama'];

        $prodi = new Prodi(); //buat object prodi
        $prodi -> nama = $validateData['nama'];//simpan nilai input ($validateData['nama']) ke dalam property nama prodi ($prodi -> nama)
        $prodi -> save(); //simpan ke dalam tabel prodis

        // return "Data prodi $prodi -> nama berhasil disimpan ke database"; //tampilkan pesan berhasil
        $request -> session() -> flash('info', "Data Prodi $prodi -> nama berhasil disimpan ke database");
        return redirect() -> route('prodi.create');
    }
}
