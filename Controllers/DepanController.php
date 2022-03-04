<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Depan;

use Illuminate\Http\Request;

class DepanController extends Controller
{
    public function index()
    {
        $data = Buku::all();
        return view('depan', compact('data'));
    }

    public function mencari(Request $request)
    {
        $keyword = $request->mencari;
        $data = Buku::where('judul', 'like', "%" . $keyword . "%")
        ->orWhere('penulis', 'like', "%" . $keyword . "%")
        ->orWhere('penerbit', 'like', "%" . $keyword . "%")
        ->orWhere('tahun_terbit', 'like', "%" . $keyword . "%")
        ->paginate(5);
        return view('depan', compact('data'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
