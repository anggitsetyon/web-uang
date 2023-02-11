    <div class="modal fade" id="AddTransaksiModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Masukkan Transaksi</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'transaksi.save']) !!}
                <div class="mb-3">
                    {!! Form::label('kategori_id', 'Jenis Akuntansi') !!}
                    {!! Form::select('kategori_id', $selectJenisAkun, '',['class' => 'form-select', 'placeholder' => 'Pilih Jenis Akuntansi','required']) !!}
                </div>
                <div class="mb-3">
                    {!! Form::label('jenis_saldo_id', 'Jenis Saldo') !!}
                    {!! Form::select('jenis_saldo_id', $selectJenisSaldo , '',['class' => 'form-select', 'placeholder' => 'Pilih Jenis Saldo', 'required']) !!}
                </div>
                <div class="mb-3">
                    {!! Form::label('lokasi', 'Lokasi') !!}
                    {!! Form::text('lokasi', '', ['class' => 'form-control', 'required']) !!}
                </div>
                <div class="mb-3">
                    {!! Form::label('nominal', 'Nominal') !!}
                    {!! Form::number('nominal', '', ['class' => 'form-control', 'placeholder' => 'Contoh: 10000', 'required']) !!}
                </div>
                <div class="mb-3">
                    {!! Form::label('keterangan', 'Keterangan') !!}
                    {!! Form::text('keterangan', '', ['class' => 'form-control', 'required']) !!}
                </div>
                <div class="mb-3">
                    {!! Form::label('tanggal', 'Tanggal') !!}
                    {!! Form::date('tanggal', now(), ['class' => 'form-control', 'required']) !!}
                </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-primary add_transaksi" type="submit">Simpan</button>
                {!! Form::close() !!}
                </div>
        </div>
        </div>
    </div>