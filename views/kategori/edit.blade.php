@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="mb-0">EDIT KATEGORI</p>
                    <div class="card-body">
                        <form class="form-horizontal" action="/kategori/{{$ubah->id}}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="id_kategori" class="col-sm-2 control-label">Id Kategori</label>
                                <div class="col-sm-10">
                                    <input type="text" name="id_kategori" class="form-control" value="{{$ubah->id_kategori}}" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nama_kategori" class="col-sm-2 control-label">Nama Kategori</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nama_kategori" class="form-control" value="{{$ubah->nama_kategori}}" >
                                </div>
                            </div>
                            <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" class="btn btn-success btn-md" name="simpan" value="Simpan">
                            <a href="/kategori/index" class="btn btn-primary" role="button">Batal</a>
                            </div>
                            </div>
                        </form>
                        </div>

                </div>
            </div>
        </div>
    </div>
@stop
