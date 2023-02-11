<div class="modal fade" id="AddKategoriModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Masukkan Kategori</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            {!! Form::open(['route' => 'kategori.save']) !!}
            <div class="mb-3">
                {!! Form::label('jenis_akun', 'Jenis Akuntansi') !!}
                {!! Form::text('jenis_akun', '',['class' => 'form-control', 'placeholder' => 'Masukkan Jenis Akun','required']) !!}
            </div>
            <div class="mb-3">
                {!! Form::label('jenis_rekap_id', 'Jenis Rekap') !!}
                {!! Form::select('jenis_rekap_id', $selectJenisRekap , '',['class' => 'form-select', 'placeholder' => 'Pilih Jenis Rekap', 'required']) !!}
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button class="btn btn-primary" type="submit">Simpan</button>
        {!! Form::close() !!}
        </div>
    </div>
    </div>
</div>