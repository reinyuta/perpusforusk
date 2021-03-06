@extends('adminlte::page')

@section('title', 'dashboard admin')

@section('content_header')
<center>
    <h1 class="m-0 text-dark">SELAMAT DATANG</h1>
</center>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="mb-0">

                        <div class="card-header">
                            <h2>DAFTAR BUKU<br>

                            </h2>
                            </div>
                            <form form class="form" method="get" action="{{ route('search')}}">
                                <div class="form-group w-50 mb-1">
                                    <input type="text" name="search" class="form-control w-75 d-inline" id="search" placeholder="Masukkan nama buku">
                                    <button type="submit" class="btn btn-primary mb-1">Cari</button>
                                </div>

                    <div class="container pt-3 text-center">

                        <div class="row row-cols-1 row-cols-md-3 g-4">
                            @forelse ($data as $buku)
                            <div class="col">
                                <div class="card" style="height: 22rem;">
                                    <div class="card-header text-muted">
                                       <img src="{{ Storage::url('../gambar/').$buku->cover_buku }}" class="rounded" style="width: 150px">

                                    </div>
                                    <div class="card-body">
                                        <p class="card-text"><b>{{$buku->judul}}</b> <br>
                                            penulis: {{$buku->penulis}}<br>
                                            penerbit: {{$buku->penerbit}}<br>
                                            {{$buku->tahun_terbit}}
                                        </p>
                                    </div>

                            </div>
                            @empty
                            <tr>
                            <td colspan="3">
                            Tidak ada data.
                            </td>
                            </tr>
                            @endforelse
                        </div>
                    </div>

                    </p>
                </div>
            </div>
        </div>
    </div>
@stop

@section('plugins.Sweetalert2', true)
@section('plugins.Pace', true)
@section('js')
@if (session('success'))
    <script type="text/javascript">
        Swal.fire(
            'Sukses!',
            '{{ session('success') }}',
            'success'
        )
    </script>
@endif

<script type="text/javascript">
    function hapus(id){
        Swal.fire({
            title: 'Konfirmasi',
            text: "Yakin menghapus data ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#dd3333',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
         }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: "/buku/"+id,
                    type: 'DELETE',
                    data: {
                    '_token': $('meta[name=csrf-token]').attr("content"),
                },
                    success: function(result) {
                        Swal.fire(
                            'Sukses!',
                            'Berhasil Hapus',
                            'success'
                        );
                        location.reload();
                    }
                });
            }
         })
    }
</script>
@stop
