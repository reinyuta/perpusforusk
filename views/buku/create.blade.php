@extends('adminlte::page')

@section('title', 'dashboard admin')

@section('content_header')
    <h1 class="m-0 text-dark">DASHBOARD ADMIN</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="mb-0">
                        <h2><font color="blue">INPUT BUKU</font></h2>
                        <div class="card-body">
                            <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="id_buku" class="col-sm-2 control-label">Id Buku</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="id_buku" class="form-control" value="" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="id_kategori" class="col-sm-2 control-label">Id Kategori</label>
                                    <div class="col-sm-3">
                                        <select name="id_kategori" class="form-control">
                                            @foreach ($idkat as $datakat )
                                            <option value="{{$datakat->id_kategori}}">
                                                {{$datakat->id_kategori}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="judul" class="col-sm-2 control-label">Judul Buku</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="judul" class="form-control" value="" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="penulis" class="col-sm-2 control-label">Penulis</label>
                                    <div class="col-sm-5">
                                        <input type="text" name="penulis" class="form-control" value="" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="penerbit" class="col-sm-2 control-label">Penerbit</label>
                                    <div class="col-sm-5">
                                        <input type="text" name="penerbit" class="form-control" value="" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tahun_terbit" class="col-sm-2 control-label">Tahun Terbit</label>
                                    <div class="col-sm-2">
                                        <input type="text" name="tahun_terbit" class="form-control" value="" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="cover_buku" class="col-sm-4 control-label">Gambar Cover Buku</label>
                                    <div class="col-sm-10">
                                        <input type="file" name="cover" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                <input type="submit" class="btn btn-success btn-md" name="simpan" value="Simpan">
                                <a href="/buku/index" class="btn btn-primary" role="button">Batal</a>
                                </div>
                                </div>
                            </form>
                            </div>

                    </p>
                </div>
            </div>
        </div>
    </div>
@stop
