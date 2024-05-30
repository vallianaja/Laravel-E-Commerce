@extends('layouts.template')

@section('page-title')
Toko
@endsection

@section('content')

{{-- Ketika Ada Error --}}
@if($errors -> any())
<div class="alert alert-danger alert-dismissible p-4">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-ban"></i> Maaf, Persyaratan Tidak Dipenuhi Dengan Benar!</h5>
    <ul>
        @foreach($errors->all() as $item)
        <li>{{$item}}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="row">
    <div class="col-md-12">

        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-title">Data Toko</h3>
                    </div>
                    <div class="col-md-4 text-right">
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-lg">
                            Tambah Data
                        </button>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nama Toko</th>
                            <th>Kategori</th>
                            <th>Pemilik</th>
                            <th>Status</th>
                            <th>Pilihan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($toko as $item)
                        <tr>
                            <td>{{$item -> nama_toko}}</td>
                            <td>{{$item -> kategori_toko}}</td>
                            <td>{{$item -> user-> name}}</td>
                            <td>
                                @if($item-> aktif == FALSE)
                                    <span class="badge badge-danger">Toko Non-Aktif</span>
                                @else
                                    <span class="badge badge-success">Toko Aktif</span>
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-outline-info dropdown-toggle dropdown-icon"
                                    data-toggle="dropdown">Pilihan </a>
                                <div class="dropdown-menu" role="menu">
                                    <a href="{{route('toko.show', $item -> id)}}" class="dropdown-item">Detail</a>
                                    <form action="{{route('toko.destroy', $item -> id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item" onclick="return confirm('Delete Data?')">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Nama Toko</th>
                            <th>Kategori</th>
                            <th>Pemilik</th>
                            <th>Status</th>
                            <th>Pilihan</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </div>
</div>

{{-- Modal --}}
<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Toko Baru</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('toko.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Toko :</label>
                        <input type="text" name="nama_toko" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Pemilik</label>
                        <select name="id_user" class="form-control">
                            <option>Pilih Pemilik</option>
                            @foreach($user as $item)
                                @if($item-> level == 'penjual')
                                    <option value="{{$item-> id}}">{{$item-> name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi Toko :</label>
                        <textarea id="summernote" name="desc_toko"> 

                        </textarea>
                    </div>
                    <div class="form-group">
                        <label>Kategori :</label>
                        <select name="kategori_toko" class="form-control" required>
                            <option value="elektronik">Elektronik</option>
                            <option value="otomotif">Otomotif</option>
                            <option value="sembako">Sembako</option>
                            <option value="fashion">Fashion</option>
                            <option value="makanan">Makanan</option>
                            <option value="obat">Obat</option>
                            <option value="aksesoris">Aksesoris</option>
                            <option value="perabotan">Perabotan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Hari Buka :</label>
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="senin" name="hari_buka[]" value="Senin" checked>
                            <label for="senin" class="custom-control-label">Senin</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="selasa" name="hari_buka[]" value="Selasa">
                            <label for="selasa" class="custom-control-label">Selasa</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="rabu" name="hari_buka[]" value="Rabu">
                            <label for="rabu" class="custom-control-label">Rabu</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="kamis" name="hari_buka[]" value="Kamis">
                            <label for="kamis" class="custom-control-label">Kamis</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="jumat" name="hari_buka[]" value="Jumat">
                            <label for="jumat" class="custom-control-label">Jumat</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="sabtu" name="hari_buka[]" value="Sabtu">
                            <label for="sabtu" class="custom-control-label">Sabtu</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="minggu" name="hari_buka[]" value="Minggu">
                            <label for="minggu" class="custom-control-label">Minggu</label>
                        </div>
                    </div>

                    <div class="row justify-content-around">
                        <div class="form-group col-md-6">
                            <label>Waktu Buka :</label>
                            <input type="time" class="form-control" name="jam_buka">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Waktu Tutup :</label>
                            <input type="time" class="form-control" name="jam_tutup">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Status :</label>
                        <select name="aktif" class="form-control" required>
                            <option value="0">Non-Active</option>
                            <option value="1">Active</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Icon Toko :</label>
                        <input type="file" name="icon_toko" class="form-control">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection
