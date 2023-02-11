@extends('layouts.index')
<title>Setting User</title>
@section('content')
@include('setting.modal-user')

<div class="container-sm m-1 flex table-responsive-sm">
    <div class="d-flex text-left fs-4 flex-column mt-1 ml-2">
        <span>Daftar Akun</span>
    </div>
    <div class="container-sm p-2 d-flex justify-content-start">
        <button type="button" data-bs-toggle="modal" data-bs-target="#AddUserModal" class="btn btn-primary pull-right"> 
          Tambah Akun
        </button>
      </div>
    <table class="table table-sm table-hover table-bordered text-dark">
        <thead>
            <div class="m-1">
            </div>
        </thead>
        <tbody class="">
            <tr class="bg-dark text-light">
                <td class="text-center" style="width: 50px">No</td>
                <td>Nama Akun</td>
                <td>Email</td>
                <td class="text-center" style="width: 150px">Aksi</td>
            </tr>
            @php $no=1;
            @endphp
            @foreach ($user as $row)
            <tr>
                <td class="text-center" style="width: 50px">{{ $no }}</td>
                <td>{{ $row->name }}</td>
                <td>{{ $row->email }}</td>
                <td style="width: 200px" class="d-flex justify-content-evenly">
                    <a href="{{ route('users.role', $row->id) }}" class="btn btn-success">
                      Role
                    </a> 
                    <a href="#edit{{$row->id}}" class="btn btn-warning" data-bs-toggle="modal">
                      <img src="https://img.icons8.com/external-becris-lineal-becris/64/000000/external-edit-mintab-for-ios-becris-lineal-becris.png"
                      style="width: 20px; height: 20px;"/>
                    </a> 
                    <a href="#delete{{$row->id}}" class="btn btn-danger" data-bs-toggle="modal">
                      <img src="https://img.icons8.com/external-becris-lineal-becris/64/null/external-trash-mintab-for-ios-becris-lineal-becris.png"
                      style="width: 20px; height: 20px"/>
                    </a>
                    @include('setting.action-user')
                  </td>
            </tr>
            @php
                $no++
            @endphp
            @endforeach

    </tbody>
</table>
</div>
@endsection