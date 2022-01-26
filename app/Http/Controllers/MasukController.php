<?php

namespace App\Http\Controllers;

use App\masuk;
use App\barang;
use Illuminate\Http\Request;

class MasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $masuk = masuk::with('barang')->get();
        return view('masuk.index',compact('masuk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $masuk = masuk::all();
        $barang = barang::all();
        return view('masuk.create',compact('masuk','barang'));
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
            $stock = $barang->stock + (int) $request->jumlah;
            // $total = $Barang->total_stock + (int) $request->total_stock;
            $barang->update(['stock' => $stock]);
        }

        $masuk = new masuk;
        $barang = barang::where(['id' => $request['barang_id']])->first();
        $masuk->jenis = $request->jenis;
        $masuk->jumlah = $request->jumlah;
        $masuk->barang_id = $request->barang_id;
        $masuk->save();
        return redirect()->route('barangmasuk.index')->with('success', 'Data Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\masuk  $masuk
     * @return \Illuminate\Http\Response
     */
    public function show(masuk $masuk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\masuk  $masuk
     * @return \Illuminate\Http\Response
     */
    public function edit(masuk $masuk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\masuk  $masuk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, masuk $masuk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\masuk  $masuk
     * @return \Illuminate\Http\Response
     */
    public function destroy(masuk $masuk)
    {
        //
    }
}
