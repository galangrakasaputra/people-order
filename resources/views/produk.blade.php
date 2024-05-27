@extends('main')
@section('content')
@if($alert = Session::get('alert'))
<div class="alert alert-danger alert-block">
  <button type="button" class="close" data-dismiss="alert">×</button> 
  <h5 class="alert-heading">{{ $alert }}</h5>
</div>
@endif
@if($sukses = Session::get('sukses'))
<div class="alert alert-success alert-block">
  <button type="button" class="close" data-dismiss="alert">×</button> 
  <h5 class="alert-heading">{{ $sukses }}</h5>
</div>
@endif
<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#tambahProduk" style="float:right">
    Tambah Produk
</button>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Produk</h1>
</div>
<div class="modal fade" id="tambahProduk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form method="post" action="/tambah-produk" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
          </div>
          <div class="modal-body">
            @csrf
         <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Barang</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="exampleInputUsername2" placeholder="Barang" name="barang" required>
                      </div>
                    </div>
          
        <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Jenis Barang</label>
                      <div class="col-sm-9">
                        <select name="jenis_barang" id="exampleInputJenis">
                            <option value="Barang Setengah Jadi">Barang Setengah Jadi</option>
                            <option value="Barang Jadi">Barang Jadi</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Harga</label>
                        <div class="col-sm-9">
                          <input type="number" class="form-control" id="hargaBarang" placeholder="Rp. " name="harga" required>
                        </div>
                      </div>
                    <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Stock Barang</label>
                        <div class="col-sm-9">
                          <input type="number" class="form-control" id="jumlahBarang" name="jumlah" required>
                        </div>
                      </div>
                    <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Tampilan</label>
                      <div class="col-sm-9">
                        <input type="file" class="form-control-file" name="gambar" required>
                      </div>
                    </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Tambah</button>
          </div>
        </div>
      </form>
    </div>
  </div>
<div class="table-produk">
    <table class="table table-striped table-bordered" id="tableProduk">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Barang</th>
                <th scope="col">Jenis</th>
                <th scope="col">Harga</th>
                <th scope="col" style="width:1%">Tampilan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $produk)
            <tr>
                <td>{{ $produk->id }}</td>
                <td>{{ $produk->barang }}</td>
                <td>{{ $produk->jenis }}</td>
                <td>{{ $produk->harga }}</td>
                <td><img src="{{ $produk->gambar }}"></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
    
@endsection