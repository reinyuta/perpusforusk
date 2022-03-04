<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;


class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Kategori::latest()->paginate(10);
        return view('kategori.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $simpan = Kategori::create($request->all());
        if($simpan){
            return redirect('kategori/index')->with(['success' => 'Data berhasil di simpan, anda sudah dinyatakan berbasis']);
        }else{
            return redirect('kategori/index')->with(['error' => 'Data tidak berhasil di simpan, anda tidak dinyatakan berbasis']);
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
        //

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
        $ubah = Kategori::find($id);
        return view('kategori.edit', compact(['ubah']));
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
        $upd = Kategori::find($id);
        $upd->update($request->all());
        if($upd){
            return redirect('kategori/index')->with(['success' => 'Data berhasil di ubah, anda sudah dinyatakan berbasis']);
        }else{
            return redirect('kategori/index')->with(['error' => 'Data tidak berhasil di simpan, anda tidak berbasi']);
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
        //
        $del = Kategori::find($id);
        $del->delete();
        return redirect('kategori/index');
    }

    public function cari(Request $request)
    {
        $keyword = $request->search;
        $data = Kategori::where('nama_kategori', 'like', "%" . $keyword . "%")
        ->orWhere('id_kategori', 'like', "%" . $keyword . "%")
        ->paginate(5);

        return view('kategori.index', compact('data'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
