@extends('layouts.index')
<title>{{ $title }}</title>
<link rel = "stylesheet" type = "text/css" media = "print" href = "{{ asset('css/css.css') }}">
@section('content')
<div class="container-sm m-1 flex table-responsive">
    <div class="d-flex text-center fs-4 flex-column mt-1">
        <h5 class="text-dark">Laporan Laba Rugi</h5>  
        <h5 class="text-dark">{{ Carbon\Carbon::parse($periode)->endOfMonth()->translatedFormat('d F Y') }}</h5>
    </div>
    <table class="border border-dark table table-sm table-hover table-bordered text-dark">
        <thead>
            <div class="m-1">
                <div class="d-flex d-flex bd-highlight">
                    <form action="/labarugi" class="bd-highlight">
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
                                    <a href="/labarugi" class="p-2 bg-warning m-1 rounded-3 link-light text-decoration-none">Reset</a>
                            </div>
                        </div>
                    </form>
                    <button class="btn btn-secondary bd-highlight ml-auto" onclick="window.print();">Print
                        <i class="fas fa-print"></i>
                    </button>
                </div>
            </div>
        </thead>
        <tbody class="border border-dark">
            @php
                $TotalPendapatan = 0;
                $TotalBeban = 0;
            @endphp
        <tr>
            <td>Pendapatan:</td>
            <td></td>
            <td></td>
        </tr>
        @foreach ($labarugi as $row)
        
        @if ($row->jenis_rekap == 'Pendapatan')
        <tr>
            <td>&nbsp&nbsp&nbsp
                    
                {{ $row->jenis_akun }}    
                
            </td>
            <td class="text-right">
                @if ($row->jenis_rekap == 'Pendapatan' && $row->jenis_saldo == 'Pengurangan')
                Rp {{number_format($row->nominal,0,'','.')}}
                @php
                $TotalPendapatan -= $row->nominal;
                @endphp
                @endif 
            </td>
            <td class="text-right">
                @if ($row->jenis_rekap == 'Pendapatan' && $row->jenis_saldo == 'Pertambahan')
                Rp {{number_format($row->nominal,0,'','.')}}
                @php
                $TotalPendapatan += $row->nominal;
                @endphp
                @endif 
            </td>
        </tr>
        @endif


        @endforeach
        <tr>
            <td class="border border-right">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                Total Pendapatan:</td>
            <td></td>
            <td class="text-right" style="text-decoration: underline">Rp {{number_format($TotalPendapatan,0,'','.')}}</td>
        </tr>
        <tr>
            <td> Beban Usaha: </td>
            <td></td>
            <td></td>
        </tr>
        @foreach ($labarugi as $row)
        @if ($row->jenis_rekap == 'Beban')
        <tr>
            <td>&nbsp&nbsp&nbsp 
                {{ $row->jenis_akun }}</td>
            <td class="text-right">
                Rp {{number_format($row->nominal,0,'','.')}}
                @php
                $TotalBeban += $row->nominal;
                @endphp
            </td>
            <td></td>
        </tr>
        @endif
        @endforeach
        <tr>
            <td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                Total Beban: </td>
            <td class="text-right">Rp {{number_format($TotalBeban,0,'','.')}}</td>
            <td></td>
        </tr>
        <tr>
            <th colspan="2" class="text-center">Laba Bersih</td>
            <th class="text-right" style="text-decoration: underline">Rp {{number_format($TotalPendapatan - $TotalBeban,0,'','.')}}</th> 
        </tr>
    </tbody>
</table>
</div>
@stop
