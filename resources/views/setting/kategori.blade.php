@extends('layouts.index')
<title>{{ $title }}</title>
@section('content')
@include('setting.modal-kategori')
<div class="container-sm m-1 flex table-responsive-sm">
    <div class="d-flex text-left fs-4 flex-column mt-1 ml-2">
        <span>Kategori</span>
    </div>
    @can('create kategori')
    <div class="container-sm p-2 d-flex justify-content-start">
        <button type="button" data-bs-toggle="modal" data-bs-target="#AddKategoriModal" class="btn btn-primary pull-right"> 
          Tambah Kategori
        </button>
      </div>
      @endcan
    <table class="table table-sm table-hover table-bordered text-dark">
        <thead>
            <div class="m-1">
            </div>
        </thead>
        <tbody class="">
            <tr class="bg-dark text-light">
                <td class="text-center" style="width: 50px">No</td>
                <td>Jenis Akuntansi</td>
                <td>Jenis Rekap</td>
                @can('edit kategori','delete kategori')
                <td class="text-center" style="width: 150px">Aksi</td>
                @endcan
            </tr>
            @php $no=1;
            @endphp
            @foreach ($kategori as $row)
            <tr>
                <td class="text-center" style="width: 50px">{{ $no }}</td>
                <td>{{ $row->jenis_akun }}</td>
                <td>{{ $row->jenisRekap->jenis_rekap }}</td>
                @can('edit kategori','delete kategori')
                <td style="width: 150px" class="d-flex justify-content-evenly">
                    <a href="#edit{{$row->id}}" data-bs-toggle="modal" class="btn btn-warning">
                      <img src="https://img.icons8.com/external-becris-lineal-becris/64/000000/external-edit-mintab-for-ios-becris-lineal-becris.png"
                      style="width: 20px; height: 20px;"/>
                    </a> 
                    <a href="#delete{{$row->id}}" data-bs-toggle="modal" class="btn btn-danger">
                      <img src="https://img.icons8.com/external-becris-lineal-becris/64/null/external-trash-mintab-for-ios-becris-lineal-becris.png"
                      style="width: 20px; height: 20px"/>
                    </a>
                    @include('setting.action-kategori')
                  </td>
                @endcan
            </tr>
            @php
                $no++
            @endphp
            @endforeach

    </tbody>
</table>
</div>
@endsection