<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\konser;

class KonserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $konser = Konser::all();

        return response()->json([
            'message' => 'Data konser berhasil ditampilkan',
            'data' => $konser,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        if ($user->role == 'admin') {
            $request->validate([
                "nama" => 'required',
                "tanggal" => 'required',
                "alamat" => 'required',
                "kuota_penonton" => 'required',
                "harga" => 'required',
                "deskripsi" => 'required',
                "poster" => 'required',
            ]);

            $konser = Konser::create([
                "nama" => $request->nama,
                "tanggal" => $request->tanggal,
                "alamat" => $request->alamat,
                "kuota_penonton" => $request->kuota_penonton,
                "harga" => $request->harga,
                "deskripsi" => $request->deskripsi,
                "poster" => $request->poster,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Konser berhasil ditambahkan',
                'data' => $konser,
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda tidak memiliki akses untuk menambahkan konser',
            ], 401);
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
        $konser = Konser::find($id);

        if ($konser) {
            return response()->json([
                'message' => 'Data konser berhasil ditampilkan',
                'data' => $konser,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Data konser tidak berhasil ditampilkan',
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = auth()->user();

        if($user->role == 'admin'){
          

            $konser = Konser::find($id);

            $konser -> update([
                'nama' =>$request->nama,
                'tanggal'=>$request->tanggal,
                'alamat'=>$request->alamat,
                'kuota_penonton' =>$request->kuota_penonton,
                'harga'=>$request->harga,
                'deskripsi'=>$request->deskripsi,
            ]);

            return response()->json([
                'status'=> 'success',
                'message'=>'Konser berhasil diupdate',
                'data'=> $konser,
            ], 200);

        } else {
            return response()->json([
                'status'=> 'error',
                'message'=>'Anda tidak memiliki akses untuk mengupdate konser',
            ],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = auth()->user();

        if ($user->role == 'admin') {
            $konser = Konser::find($id);

            $konser->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Konser berhasil dihapus',
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda tidak memiliki akses untuk menghapus konser',
            ], 401);
        }
    }
}
