<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\Buku;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Buku::latest()->paginate(10);
        return view('buku.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $idkat = Kategori::all();
        return view('buku.create',compact(['idkat']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [

            'id_buku'     => 'required',
            'id_kategori'   => 'required',
            'judul'   => 'required',
            'penulis'   => 'required',
            'penerbit'   => 'required',
            'tahun_terbit'   => 'required|integer',
            'cover.*' => 'mimes:jpg,jpeg,png,gif|max:2048'
         ]);

         //proses upload gambar
         if($request->hasFile('cover')) {
            $image = $request->file('cover');
            $image->move(public_path('gambar'),$image->getClientOriginalName());
        }else{
            $image=NULL;
        }

         $simpan = Buku::create([
             'id_buku'   => $request->id_buku,
             'id_kategori'   => $request->id_kategori,
             'judul'   => $request->judul,
             'penulis'   => $request->penulis,
             'penerbit'   => $request->penerbit,
             'tahun_terbit'   => $request->tahun_terbit,
             'cover_buku'   => $image->getClientOriginalName()

         ]);
         if($simpan){

            //redirect dengan pesan sukses
            return redirect('buku/index')->with(['success' => 'Data Berhasil Disimpan!']);

        }else{

            //redirect dengan pesan error
            return redirect('buku/index')->with(['error' => 'Data Gagal Disimpan!']);

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
        $dtkat=Kategori::all();
        $ubah=Buku::find($id);
        return view('buku.edit',compact(['ubah','dtkat']));
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
        $this->validate($request, [

            'id_buku'     => 'required',
            'id_kategori'   => 'required',
            'judul'   => 'required',
            'penulis'   => 'required',
            'penerbit'   => 'required',
            'tahun_terbit'   => 'required|integer',
            'cover.*' => 'mimes:jpg,jpeg,png,gif|max:2048'
         ]);
         $upd = Buku::find($id);
        if($request->file('cover') == "") {

            $upd->update([
                'id_buku'   => $request->id_buku,
                'id_kategori'   => $request->id_kategori,
                'judul'   => $request->judul,
                'penulis'   => $request->penulis,
                'penerbit'   => $request->penerbit,
                'tahun_terbit'   => $request->tahun_terbit
            ]);

        } else {

            //hapus old image
            Storage::disk('local')->delete('public/gambar/'.$upd->cover_buku);

            //proses upload gambar baru
            if($request->hasFile('cover')) {
                $image = $request->file('cover');
                $image->move(public_path('gambar'),$image->getClientOriginalName());
            }else{
                $image=NULL;
            }

            $upd ->update([
                'id_buku'   => $request->id_buku,
                'id_kategori'   => $request->id_kategori,
                'judul'   => $request->judul,
                'penulis'   => $request->penulis,
                'penerbit'   => $request->penerbit,
                'tahun_terbit'   => $request->tahun_terbit,
                'cover_buku'   => $image->getClientOriginalName()

            ]);
        }

         if($upd){

            //redirect dengan pesan sukses
            return redirect('buku/index')->with(['success' => 'Data Berhasil Disimpan!']);

        }else{

            //redirect dengan pesan error
            return redirect('buku/index')->with(['error' => 'Data Gagal Disimpan!']);

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
        $del=Buku::find($id);
        $del->delete(); //perintah untuk hapus
        if($del){
            return redirect('buku/index')->with(['success' => 'Data Berhasil Dihapus!']);

        }else{
            return redirect('buku/index')->with(['error' => 'Data Gagal Dihapus!']);

        }
    }

    public function search(Request $request)
    {
        $keyword = $request->search;
        $data = Buku::where('judul', 'like', "%" . $keyword . "%")
        ->orWhere('penulis', 'like', "%" . $keyword . "%")
        ->orWhere('penerbit', 'like', "%" . $keyword . "%")
        ->orWhere('tahun_terbit', 'like', "%" . $keyword . "%")
        ->paginate(5);
        return view('buku.index', compact('data'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
