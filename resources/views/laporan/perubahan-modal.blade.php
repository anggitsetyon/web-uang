@extends('layouts.index')
<title>{{ $title }}</title>
<link rel = "stylesheet" type = "text/css" media = "print" href = "{{ asset('css/css.css') }}">
@section('content')
<div class="container-sm m-1 flex table-responsive">
    <div class="d-flex text-center fs-4 flex-column mt-1">
        <span>Laporan Perubahan Modal</span>
        <span>{{ Carbon\Carbon::parse($periode)->endOfMonth()->translatedFormat('d F Y') }}</span>
    </div>
    <table class="table table-sm table-hover table-bordered text-dark">
        <thead>
            <div class="m-1">
                <div class="d-flex d-flex bd-highlight">
                    <form action="/perubahanmodal" class="bd-highlight">
                        <div class="d-flex">
                            <div class=" d-flex flex-row align-items-center">
                                <select name="m" required data-column="1" class="form-select form-select-sm m-1" aria-label=".form-select-sm example">
                                    <option value="">Pilih Bulan</option>
                                @foreach ($Bulan as $row)    
                                <option required value="{{ $row->m }}">{{ Carbon\Carbon::parse($row->bulan)->translatedFormat('F') }}</option>
                                @endforeach
                                </select>
                                <select name="y" required data-column="1" class="form-select form-select-sm m-1" aria-label=".form-select-sm example">
                                    <option value="">Pilih Tahun</option>
                                @foreach ($Tahun as $row)    
                                <option required value="{{ $row->y }}">{{ $row->y }}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="m-1">
                                <button type="submit" class="btn btn-success">Filter</button>
                                    <a href="/perubahanmodal" class="p-2 bg-warning m-1 rounded-3 link-light text-decoration-none">Reset</a>
                            </div>
                        </div>
                    </form>
                    <button class="btn btn-secondary bd-highlight ml-auto" onclick="window.print();">Print
                        <i class="fas fa-print"></i>
                    </button>
                </div>
            </div>
        </thead>
        <tbody class="">
            <tr>
                <td>Modal</td>
                <td class="text-right">Rp {{ number_format($ModalPertambahan,0,'','.') }}</td>
            </tr>
            <tr>
                <td>Ditambah: Laba Bersih</td>
                <td class="text-right" >Rp {{ number_format($lababersih,0,'','.') }}</td>
            </tr>
            <tr>
                <td></td>
                <td class="text-right" style="text-decoration: underline">Rp {{ number_format($SubTotal,0,'','.') }}</td>
            </tr>
            <tr>
                <td>Dikurangi: Prive</td>
                <td class="text-right">(Rp {{ number_format($ModalPengurangan,0,'','.') }})</td>
            </tr>
            <tr>
                <th>Total Modal</th>
                <th class="text-right" style="text-decoration: underline">Rp {{ number_format($TotalModal,0,'','.') }}</th>
            </tr>
    </tbody>
</table>
</div>
@endsection