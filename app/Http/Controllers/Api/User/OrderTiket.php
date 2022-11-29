<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Konser;
use App\Models\Pembelian;

class OrderTiket extends Controller
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
        $user = auth()->user();
        $konser = Konser::find($request->konsers_id);

        // return response()->json([
        //     'message' => 'Data konser berhasil ditampilkan',
        //     'data' => $konser
        // ], 200);

        if ($user->role == 'user') {
            // $request->validate([
            //     'konser_id' => 'required',
            //     'nama' => 'required',
            //     'email' => 'required',
            //     'no_hp' => 'required',
            //     'jumlah_tiket' => 'required',
            // ]);

            $order = Pembelian::create([
                "konser_id" => $request->konsers_id,
                "user_id" =>  $request->user()->id,
                "nama" => $request->nama,
                "email" => $request->email,
                "no_hp" => $request->no_hp,
                "jumlah_tiket" => $request->jumlah_tiket,
                "total_harga" => $request->jumlah_tiket * 100000,
                "status" => 'pending'
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil order',
                'data' => $order,
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda bukan user',
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
        $order = Pembelian::find($id);

        if ($order) {
            return response()->json([
                'message' => 'Bukti pembelian berhasil ditampilkan',
                'data' => $order,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Bukti pembelian tidak berhasil ditampilkan',
            ], 404);
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
