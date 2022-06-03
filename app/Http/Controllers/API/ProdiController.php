<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama' => 'required|min:5|max:20',
            'foto' => 'required|file|image|max:1000'
        ]);

        //mengambil file extension
        $ext = $request->foto->getClientOriginalExtension();
        $nama_file = "foto-" . time() . "," . $ext;
        $path = $request->foto->storeAs("public", $nama_file);
        
        $prodi = new Prodi();
        $prodi->nama = $validateData['nama'];
        $prodi->institusi_id = 0;
        $prodi->fakultas_id = 1;
        $prodi->foto = $nama_file;
        $prodi->save();

        return['status' => true, 'message' => 'Data berhasil disimpan'];
    }

    public function update(Request $request, Prodi $prodi){
        $validateData = $request -> validate([
            'nama' => 'required|min:5|max:20',
        ]);
        Prodi::where('id', $id)->update($validateData);


        return['status' => true, 'message' => 'Data berhasil diupdate'];
    }

    public function destroy($id)
    {
        $prodi = Prodi::find($id);
        if($prodi){
            $prodi->delete();
            return['status' => true, 'message' => 'Data prodi berhasil dihapus'];
        }
        else{
            return['status' => false, 'message' => 'Data prodi gagal dihapus'];
        }
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $prodi = Prodi::findOrFail($id);
        $prodi = Prodi::find($id);
        if($prodi){
            return $prodi;
        }
        else{
            return ['status' => false, 'message' => 'Prodi tidak ditemukan'];
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
}
