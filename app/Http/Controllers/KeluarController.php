<?php

namespace App\Http\Controllers;

use App\keluar;
use App\barang;
use Illuminate\Http\Request;

class KeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keluar = keluar::with('barang')->get();
        return view('keluar.index',compact('keluar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $keluar = keluar::all();
        $barang = barang::all();
        return view('keluar.create',compact('keluar','barang'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required',
            'jumlah' => 'required',
            'barang_id' => 'required'
        ]);

        $barang = barang::where(['id' => $request['barang_id']])->first();
        if($barang){
            $stock = $barang->stock - (int) $request->jumlah;
            // $total = $Barang->total_stock - (int) $request->total_stock;
            $barang->update(['stock' => $stock]);
        }


        $keluar = new keluar;
        $barang = barang::where(['id' => $request['barang_id']])->first();
        $keluar->jenis = $request->jenis;
        $keluar->jumlah = $request->jumlah;
        $keluar->barang_id = $request->barang_id;
        $keluar->save();
        return redirect()->route('barangkeluar.index')->with('success', 'Data Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\keluar  $keluar
     * @return \Illuminate\Http\Response
     */
    public function show(keluar $keluar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\keluar  $keluar
     * @return \Illuminate\Http\Response
     */
    public function edit(keluar $keluar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\keluar  $keluar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, keluar $keluar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\keluar  $keluar
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barangkeluar = keluar::findOrFail($id);
        $barangkeluar->delete();
        return redirect()->route('barangkeluar.index');
    }
}
