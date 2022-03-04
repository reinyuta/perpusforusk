<!DOCTYPE html>
<html lang="en">
<head>
  <title>PERPUSTAKAAN</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <style>
  .fakeimg {
    height: 200px;
    background: #aaa;
  }

  .topnav input[type=text] {
    float: right;
    padding: 5px;
    margin-bottom: 8px;
    margin-top: 8px;
    margin-right: 50px;
    margin-left: 50px;
    border: none;
    font-size: 17px;
}

.button-search{
    color: white;
    float: right;
    padding: px;
    margin-bottom: 10px;
    margin-top: 15px;
    margin-right: 50px;
    font-size: 17px;
}

.col-sm-4{
    display: flex;
}

.al{
    margin-right: 50px;
}

.pav{
    background-color: blue;
}
  </style>
</head>
<body>

<div class="pav">
    <div class="p-5 text-center">
        <img src="" alt="">
        <h1>PERPUSTAKAAN BUKU</h1>
        <p>Tempat dimana anda bisa mencari buku</p>
    </div>
</div>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="topnav">
      <form form class="form" method="get" action="{{ route('mencari')}}">
        <input type="text" name="mencari" class="form-control w-75 d-inline" id="mencari" placeholder="Masukkan nama buku">
     </div>
     <div class="button-search">
        <button type="submit" class="btn bg-primary mb-1">Search</button>
     </div>
</nav>

<div class="container mt-5">
  <div class="row">
    <div class="col-sm-4">
        @forelse ($data as $buku)
        <div class="al">
            <img src="{{ Storage::url('../gambar/').$buku->cover_buku }}" class="rounded" style="width: 150px">
            <div class="card-body">
                <b>{{$buku->judul}}</b><br>
                penulis: {{$buku->penulis}}<br>
                penerbit: {{$buku->penerbit}}<br>
                {{$buku->tahun_terbit}}
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
</div>
</div>
</body>
</html>
