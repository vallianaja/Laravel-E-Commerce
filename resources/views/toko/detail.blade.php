@extends('layouts.template')

@section('page-title')
Detail {{$data -> nama_toko}}
@endsection

{{-- Area Detail Pemilik Toko --}}

@section('content')

@if($errors -> any())
<div class="alert alert-danger alert-dismissible p-4">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-ban"></i> Sorry, The Requirements Didn't Match!</h5>
    <ul>
        @foreach($errors->all() as $item)
            <li>{{$item}}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="row">
    <div class="col-md-12 col-sm-12">
        {{-- Show Card --}}
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    Detail Toko
                </div>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <tr>
                            <th>Nama Toko</th>
                            <td width="5%"> : </td>
                            <td width="50%">{{$data -> nama_toko}}</td>
                            <td rowspan="7">
                                <img src="{{asset('storage/image/toko/'.$data-> icon_toko)}}" alt="Icon Toko">
                            </td>
                        </tr>
                        <tr>
                            <th>Nama Pemilik</th>
                            <td width="5%"> : </td>
                            <td width="50%">{{$data-> user-> name}}</td>
                        </tr>
                        <tr>
                            <th>Deskripsi</th>
                            <td width="5%"> : </td>
                            <td width="50%">{!! $data-> desc_toko !!}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td width="5%"> : </td>
                            <td width="50%">
                                @if ($data-> aktif == TRUE)
                                <span class="badge badge-success">Aktif</span>
                                @else
                                <span class="badge badge-danger">Non-Aktif</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Kategori</th>
                            <td width="5%"> : </td>
                            <td width="50%">{{$data-> kategori_toko}}</td>
                        </tr>
                        <tr>
                            <th>Hari Buka</th>
                            <td width="5%"> : </td>
                            <td width="50%">{{$data-> hari_buka}}</td>
                        </tr>
                        <tr>
                            <th>Jam Operasi</th>
                            <td width="5%"> : </td>
                            <td width="50%">{{$data-> jam_buka}}  -  {{$data-> jam_tutup}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        {{-- Edit Card --}}
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Toko</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form action="{{route('toko.update', $data-> id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Nama Toko :</label>
                        <input type="text" name="nama_toko" class="form-control" value="{{$data-> nama_toko}}" required>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi Toko :</label>
                        <textarea id="summernote" name="desc_toko"> 
                            {{$data-> desc_toko}}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label>Kategori :</label>
                        <select name="kategori_toko" class="form-control" required>
                            <option value="elektronik" {{$data-> kategori_toko == 'elektronik' ? 'selected' : ''}}
                                >Elektronik</option>
                            <option value="otomotif" {{$data-> kategori_toko == 'otomotif' ? 'selected' : ''}}
                                >Otomotif</option>
                            <option value="sembako" {{$data-> kategori_toko == 'sembako' ? 'selected' : ''}}
                                >Sembako</option>
                            <option value="fashion" {{$data-> kategori_toko == 'fashion' ? 'selected' : ''}}
                                >Fashion</option>
                            <option value="makanan" {{$data-> kategori_toko == 'makanan' ? 'selected' : ''}}
                                >Makanan</option>
                            <option value="obat" {{$data-> kategori_toko == 'obat' ? 'selected' : ''}}
                                >Obat</option>
                            <option value="aksesoris" {{$data-> kategori_toko == 'aksesoris' ? 'selected' : ''}}
                                >Aksesoris</option>
                            <option value="perabotan" {{$data-> kategori_toko == 'perabotan' ? 'selected' : ''}}
                                >Perabotan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        @php
                        $hariBuka = $data-> hari_buka ? explode(',', $data-> hari_buka) : []
                        @endphp
                        <label>Hari Buka :</label>
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="senin" name="hari_buka[]" value="senin" checked
                            {{in_array('senin', $hariBuka) ? 'checked' : ''}}>
                            <label for="senin" class="custom-control-label">Senin</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="selasa" name="hari_buka[]" value="selasa"
                            {{in_array('selasa', $hariBuka) ? 'checked' : ''}}>
                            <label for="selasa" class="custom-control-label">Selasa</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="rabu" name="hari_buka[]" value="rabu"
                            {{in_array('rabu', $hariBuka) ? 'checked' : ''}}>
                            <label for="rabu" class="custom-control-label">Rabu</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="kamis" name="hari_buka[]" value="kamis"
                            {{in_array('kamis', $hariBuka) ? 'checked' : ''}}>
                            <label for="kamis" class="custom-control-label">Kamis</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="jumat" name="hari_buka[]" value="jumat"
                            {{in_array('jumat', $hariBuka) ? 'checked' : ''}}>
                            <label for="jumat" class="custom-control-label">Jumat</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="sabtu" name="hari_buka[]" value="sabtu"
                            {{in_array('sabtu', $hariBuka) ? 'checked' : ''}}>
                            <label for="sabtu" class="custom-control-label">Sabtu</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="minggu" name="hari_buka[]" value="minggu"
                            {{in_array('minggu', $hariBuka) ? 'checked' : ''}}>
                            <label for="minggu" class="custom-control-label">Minggu</label>
                        </div>
                    </div>

                    <div class="row justify-content-around">
                        <div class="form-group col-md-6">
                            <label>Waktu Buka :</label>
                            <input type="time" class="form-control" name="jam_buka" value="{{$data-> jam_buka}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Waktu Tutup :</label>
                            <input type="time" class="form-control" name="jam_tutup" value="{{$data-> jam_tutup}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Status :</label>
                        <select name="aktif" class="form-control" required>
                            <option value="0" {{$data-> aktif == '0' ? 'selected' : ''}}>Non-Active</option>
                            <option value="1" {{$data-> aktif == '1' ? 'selected' : ''}}>Active</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Icon Toko :</label>
                        <input type="file" name="icon_toko" class="form-control">
                    </div>

                    <div class="form-group modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        <a type="button" href="{{route('toko.index')}}" class="btn btn-default border border-primary text-primary">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
