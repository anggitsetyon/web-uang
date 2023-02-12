@extends('layouts.index')

<title>{{ $title }}</title>

<!-- Button trigger modal -->
@include('modal-transaksi')

@section('content')
<div class="container-sm m-1 flex">
    <div class="container-sm p-2 d-flex justify-content-start">
      <button type="button" data-bs-toggle="modal" data-bs-target="#AddTransaksiModal" class="btn btn-primary pull-right"> 
        Tambah Transaksi
      </button>
    </div>
    <div class="table-responsive">
    <table id="transaksi" class="table table-sm table-hover table-striped">
      <thead class="">
        <div class=""> 
          <tr class="">
            <form action="/transaksi">
                <div class="d-flex">
                    <div class="d-flex flex-row align-items-center">
                        <div class="m-1">
                          <select data-column="0" name="akun" class="form-select form-select-sm" aria-label=".form-select-sm example">
                            <option class="" value="" selected>Jenis Akuntansi</option>
                            @foreach ($kategori as $row)
                                <option value="{{ $row->jenis_akun }}">{{ $row->jenis_akun }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="m-1">
                          <input type="date" name="d" class="form-control form-control-sm">
                          </select>    
                        </div>
                    </div>
                    <div class="m-1">
                        <button type="submit" class="btn btn-success">Filter</button>
                        <a href="/transaksi" class="p-2 bg-warning m-1 rounded-3 link-light text-decoration-none">Reset</a>
                    </div>
                      {{-- End Filter --}}
                </div>
              </form>
        </tr>
    </div>
    <div class="m-2">
        <tr class="bg-dark text-light">
            <th>Jenis Akuntansi</th>
            <th>Jenis Saldo</th>
            <th>Nominal</th>
            <th>Lokasi</th>
            <th>Keterangan</th>
            <th>Tanggal</th>
            @can('create user')                
            <th>User</th>
            @endcan
            <th class="text-center">Aksi</th>
        </tr>
    </div>
</thead>
<tbody class="">
  @foreach ($transaksi as $row)
  <tr>
      <td>{{ $row->kategori->jenis_akun }}</td>
      {{-- <td>{{ $row->kategori->jenis_rekap }}</td> --}}
      <td>{{ $row->jenisSaldo->jenis_saldo }}</td>
      <td>Rp {{ number_format($row->nominal,0,'','.') }}</td>
      <td>{{ $row->lokasi }}</td>
      <td class="w-0">{{ $row->keterangan }}</td>
      <td>{{ Carbon\Carbon::parse($row->tanggal)->translatedFormat('j F Y') }}</td>
      @can('create user')
      <td>{{ $row->user->name }}</td>
      @endcan
      {{-- <td>{{ $row->created_at->translatedformat('D MMMM') }}</td> --}}
      <td class="d-flex justify-content-evenly">
        <a href="#edit{{$row->id}}" data-bs-toggle="modal" class="btn btn-warning">
          <img src="https://img.icons8.com/external-becris-lineal-becris/64/000000/external-edit-mintab-for-ios-becris-lineal-becris.png"
          style="width: 20px; height: 20px;"/>
        </a> 
        <a href="#delete{{$row->id}}" data-bs-toggle="modal" class="btn btn-danger">
          <img src="https://img.icons8.com/external-becris-lineal-becris/64/null/external-trash-mintab-for-ios-becris-lineal-becris.png"
          style="width: 20px; height: 20px"/>
        </a>
        @include('action-transaksi')
      </td>
  </tr>
  @endforeach
</tbody>
    {{-- end tampil data --}}
</table>
</div>
<div class="d-flex flex-row justify-content-between">
  <div class="">
    Showing {{ $transaksi->count() }} entries
  </div>
  <div class="">
    {{ $transaksi->links() }}
  </div>
</div>
</div>
@endsection

