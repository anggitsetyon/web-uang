@extends('layouts.index')
<title>{{ $title }}</title>
<link rel = "stylesheet" type = "text/css" media = "print" href = "{{ asset('css/css.css') }}">
@section('content')
<div class="container-sm m-1 flex table-responsive">
    <div class="d-flex text-center fs-4 flex-column mt-1">
        <h5 class="text-dark">Neraca Saldo</h5>  
        <h5 class="text-dark">{{ Carbon\Carbon::parse($periode)->endOfMonth()->translatedFormat('d F Y') }}</h5>
    </div>
    <table class="table table-sm table-hover text-dark">
        <thead>
            <div class="m-1">
                <div class="d-flex d-flex bd-highlight">
                    <form action="/neraca" class="bd-highlight">
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
                                    <a href="/neraca" class="p-2 bg-warning m-1 rounded-3 link-light text-decoration-none">Reset</a>
                            </div>
                        </div>
                    </form>
                    <button class="btn btn-secondary bd-highlight ml-auto" onclick="window.print();">Print
                        <i class="fas fa-print"></i>
                    </button>
                </div>
            </div>
        </thead>
        <tbody class="border">
            @php
            $debet = 0;
            $kredit = 0;
        @endphp
            
        <tr class="bg-dark border text-light">
            <td rowspan="2" style="text-align: center; vertical-align: middle;" class="border">Nama Akuntansi</td>
            <td colspan="2" class="text-center">Saldo</td>
        </tr>
        <tr class="bg-secondary text-light">
            <td class="text-center">Debet</td>
            <td class="text-center">Kredit</td>
        </tr>
        <tr>
                
            <td>Kas</td>
            <td class="text-right border">Rp {{number_format($KasTotal,0,'','.')}}
                @php
                $debet += $KasTotal
                @endphp
            </td>
            <td></td>
        </tr>
        @foreach ($neraca as $row)
        <tr> @if ($row->jenis_akun != 'Kas' && $row->jenis_rekap == 'Aset')
            <td class="border border-right"> 
                @if ($row->jenis_akun != 'Kas' && $row->jenis_rekap == 'Aset')
                {{ $row->jenis_akun }}
                @endif
            </td>
            <td class="text-right border"> 
                @if ($row->jenis_rekap == 'Aset' && $row->jenis_akun != 'Kas' && $row->jenis_saldo == 'Pertambahan')
                Rp {{number_format($row->nominal,0,'','.')}}
                @php
                $debet += $row->nominal
                @endphp
                @elseif ($row->jenis_rekap == 'Beban')
                Rp {{number_format($row->nominal,0,'','.')}}
                @php
                $debet += $row->nominal
                @endphp
                @endif
            </td>
            <td class="text-right">
                @if ($row->jenis_rekap == 'Modal' && $row->jenis_saldo == 'Pertambahan')
                Rp {{number_format($row->nominal,0,'','.')}}
                @php
                $kredit += $row->nominal
                @endphp
                @elseif ($row->jenis_rekap == 'Aset' && $row->jenis_saldo == 'Pengurangan')
                Rp {{number_format($row->nominal,0,'','.')}}
                @php
                $kredit += $row->nominal
                @endphp
                @endif
            </td>
        </tr>
        @endif
        @endforeach
        @foreach ($neraca as $row)
        <tr> @if ($row->jenis_rekap == 'Modal')
            <td class="border border-right">
                @if ($row->jenis_rekap == 'Modal') 
                {{ $row->jenis_akun }}
                @endif
            </td>
            <td class="text-right border"> 
                @if ($row->jenis_rekap == 'Modal' && $row->jenis_saldo == 'Pengurangan')
                Rp {{number_format($row->nominal,0,'','.')}}
                @php
                $debet += $row->nominal
                @endphp
                @endif
            </td>
            <td class="text-right">
                @if ($row->jenis_rekap == 'Modal' && $row->jenis_saldo == 'Pertambahan')
                Rp {{number_format($row->nominal,0,'','.')}}
                @php
                $kredit += $row->nominal
                @endphp
                @endif
            </td>
        </tr>
        @endif
        @endforeach
        @foreach ($neraca as $row)
        <tr> @if ($row->jenis_rekap == 'Pendapatan')
            <td class="border border-right"> 
                @if ($row->jenis_rekap == 'Pendapatan') 
                {{ $row->jenis_akun }}
                @endif
            </td>
            <td class="text-right border"> 
                @if ($row->jenis_rekap == 'Pendapatan' && $row->jenis_saldo == 'Pengurangan')
                Rp {{number_format($row->nominal,0,'','.')}}
                @php
                $debet += $row->nominal
                @endphp
                @endif
            </td>
            <td class="text-right">
                @if ($row->jenis_rekap == 'Pendapatan' && $row->jenis_saldo == 'Pertambahan')
                Rp {{number_format($row->nominal,0,'','.')}}
                @php
                $kredit += $row->nominal
                @endphp
                @endif
            </td>
        </tr>
        @endif
        @endforeach
        @foreach ($neraca as $row)
        <tr> @if ($row->jenis_rekap == 'Kewajiban')
            <td class="border border-right"> 
                @if ($row->jenis_rekap == 'Kewajiban') 
                {{ $row->jenis_akun }}
                @endif
            </td>
            <td class="text-right border"> 
                @if ($row->jenis_rekap == 'Kewajiban' && $row->jenis_saldo == 'Pengurangan')
                Rp {{number_format($row->nominal,0,'','.')}}
                @php
                $debet += $row->nominal
                @endphp
                @endif
            </td>
            <td class="text-right">
                @if ($row->jenis_rekap == 'Kewajiban' && $row->jenis_saldo == 'Pertambahan')
                Rp {{number_format($row->nominal,0,'','.')}}
                @php
                $kredit += $row->nominal
                @endphp
                @endif
            </td>
        </tr>
        @endif
        @endforeach
        <tr>
            <th class="text-center">Total</td>
            <td class="text-right border" style="text-decoration: underline">
            @php
                echo 'Rp '.number_format($debet,0,'','.');
            @endphp
            </td>   
            <td class="text-right border" style="text-decoration: underline">
            @php
                echo 'Rp '.number_format($kredit,0,'','.');
            @endphp
            </td>
        </tr>
    </tbody>
</table>
</div>
@endsection
