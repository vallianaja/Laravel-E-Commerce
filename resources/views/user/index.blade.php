@extends('layouts.template')

@section('page-title')
User
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
                        <h3 class="card-title">Data User</h3>
                    </div>
                    <div class="col-md-4 text-right">
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-lg">
                            Tambah User
                        </button>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nama Penjual</th>
                            <th>Email</th>
                            <th>Level</th>
                            {{-- <th>Password</th> --}}
                            <th>Pilihan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $item)
                            @if($item-> level === 'penjual')
                            <tr>
                                <td>
                                    {{$item -> name}}
                                </td>
                                <td>
                                    {{$item -> email}}
                                </td>
                                <td>
                                    {{$item -> level}}
                                </td>
                                {{-- <td>
                                    {{str_repeat('*', strlen($item-> password))}}
                                </td> --}}
                                <td>
                                    <a class="btn btn-outline-info dropdown-toggle dropdown-icon"
                                        data-toggle="dropdown">Pilihan </a>
                                    <div class="dropdown-menu" role="menu">
                                        <a href="{{route('penjual.show', $item -> id)}}" class="dropdown-item">Detail</a>
                                        <form action="{{route('penjual.destroy', $item -> id)}}" method="post">
                                            @csrf
                                            {{method_field('DELETE')}}
                                            <button type="submit" class="dropdown-item" onclick="return confirm('Delete Data?')">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endif
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Nama Penjual</th>
                            <th>Email</th>
                            <th>Level</th>
                            {{-- <th>Password</th> --}}
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
                <h4 class="modal-title">Tambah Data Penjual</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('penjual.store')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Lengkap Penjual</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                        <input type="text" name="level" hidden value="penjual">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control"
                            placeholder="Minimum 8 Character, A-Z, a-z, and symbol" required>
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
