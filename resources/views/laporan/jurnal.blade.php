@extends('layouts.index')
<title>{{ $title }}</title>
<link rel = "stylesheet" type = "text/css" media = "print" href = "{{ asset('css/css.css') }}">
@section('content')
<div class="container-sm m-1 flex table-responsive">
    <div class="d-flex text-center fs-4 flex-column">
        <h5 class="text-dark">Jurnal Umum</h5>  
        <h5 class="text-dark">{{ Carbon\Carbon::parse($periode)->endOfMonth()->translatedFormat('d F Y') }}</h5>
    </div>
    <table class="border table table-sm table-hover text-dark">
        <thead class="text-dark">
            <div class="m-1">
                <div class="d-flex d-flex bd-highlight">
                <form action="/jurnal" class="bd-highlight">
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
                                <a href="/jurnal" class="p-2 bg-warning m-1 rounded-3 link-light text-decoration-none">Reset</a>
                        </div>
                        
                    </div>
                </form>
                <button class="btn btn-secondary bd-highlight ml-auto" onclick="window.print(); ">Print
                    <i class="fas fa-print"></i>
                </button>
            </div>
                <div class="m-1">
                    <tr class="text-light bg-dark">
                        <th>Tanggal</th>
                        <th>Jenis Akuntansi</th>
                        <th>Debet</th>
                        <th>Kredit</th>
                    </tr>
                </div>
            </div>
        </thead>
        <tbody class="text-dark">
            @php
                $debet = 0;
                $kredit = 0;
            @endphp
        @foreach ($jurnal as $row)
        <tr>
            <td>{{ Carbon\Carbon::parse($row->tanggal)->translatedFormat('Y, M j') }}</td>
            <td>{{ $row->jenis_akun }}</td>
            <td class="">
                @if ($row->jenis_rekap == 'Aset' && $row->jenis_saldo == 'Pertambahan')
                Rp {{number_format($row->nominal,0,'','.')}}
                @php
                    $debet += $row->nominal;
                @endphp
                @elseif ($row->jenis_rekap == 'Kewajiban' && $row->jenis_saldo == 'Pengurangan')
                Rp {{number_format($row->nominal,0,'','.')}}
                @php
                    $debet += $row->nominal;
                @endphp
                @elseif ($row->jenis_rekap == 'Modal' && $row->jenis_saldo == 'Pengurangan')
                Rp {{number_format($row->nominal,0,'','.')}}
                @php
                    $debet += $row->nominal;
                @endphp
                @elseif ($row->jenis_rekap == 'Pendapatan' && $row->jenis_saldo == 'Pengurangan')
                Rp {{number_format($row->nominal,0,'','.')}}
                @php
                    $debet += $row->nominal;
                @endphp
                @elseif ($row->jenis_rekap == 'Beban' && $row->jenis_saldo == 'Pertambahan')
                Rp {{number_format($row->nominal,0,'','.')}}
                @php
                    $debet += $row->nominal;
                @endphp
                @endif 
            </td>
            <td>
                @if ($row->jenis_rekap == 'Aset' && $row->jenis_saldo == 'Pengurangan')
                Rp {{number_format($row->nominal,0,'','.')}}
                @php
                $kredit += $row->nominal;
                @endphp
                @elseif ($row->jenis_rekap == 'Kewajiban' && $row->jenis_saldo == 'Pertambahan')
                Rp {{number_format($row->nominal,0,'','.')}}
                @php
                $kredit += $row->nominal;
                @endphp
                @elseif ($row->jenis_rekap == 'Modal' && $row->jenis_saldo == 'Pertambahan')
                Rp {{number_format($row->nominal,0,'','.')}}
                @php
                $kredit += $row->nominal;
                @endphp
                @elseif ($row->jenis_rekap == 'Pendapatan' && $row->jenis_saldo == 'Pertambahan')
                Rp {{number_format($row->nominal,0,'','.')}}
                @php
                $kredit += $row->nominal;
                @endphp
                @elseif ($row->jenis_rekap == 'Beban' && $row->jenis_saldo == 'Pengurangan')
                Rp {{number_format($row->nominal,0,'','.')}}
                @php
                $kredit += $row->nominal;
                @endphp
                @endif 
            </td>
        </tr>
        @endforeach
        <tr>
            <th colspan="2" class="text-center">Total</td>
            <td style="text-decoration: underline">
            @php
                echo 'Rp '.number_format($debet,0,'','.');
            @endphp
            </td>   
            <td style="text-decoration: underline">
            @php
                echo 'Rp '.number_format($kredit,0,'','.');
            @endphp
            </td>
        </tr>
    </tbody>
</table>
</div>
@endsection
