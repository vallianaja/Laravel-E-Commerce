@extends('layouts.template')

@section('page-title')
Detail {{$user -> name}}
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
                    Detail User
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
                            <th>Nama Pemilik</th>
                            <td width="5%"> : </td>
                            <td width="70%">{{$user -> name}}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td width="5%"> : </td>
                            <td width="70%">{{$user -> email}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        {{-- Edit Card --}}
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit User</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{route('penjual.update', $user->id)}}" method="post">
                    @csrf
                    {{method_field('PUT')}}
                    <div class="form-group">
                        <label>Nama Pemilik</label>
                        <input type="text" name="name" class="form-control" value="{{$user -> name}}" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{$user -> email}}" required>
                        <input type="text" name="level" hidden value="penjual">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control"
                            placeholder="Minimum 8 Character, A-Z, a-z, and symbol">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
