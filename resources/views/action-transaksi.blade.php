<!-- Edit Modal -->
<div class="modal fade" id="edit{{$row->id}}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="myModalLabel">Ubah Transaksi</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
                  {!! Form::model($transaksi, [ 'method' => 'patch','route' => ['transaksi.update', $row->id] ]) !!}
                <div class="mb-3">
                    {!! Form::label('kategori_id', 'Jenis Akuntansi') !!}
                    {!! Form::select('kategori_id', $selectJenisAkun, $row->kategori_id,['class' => 'form-select', 'placeholder' => 'Pilih Jenis Akuntansi','required']) !!}
                </div>
                <div class="mb-3">
                    {!! Form::label('jenis_saldo_id', 'Jenis Saldo') !!}
                    {!! Form::select('jenis_saldo_id', $selectJenisSaldo, $row->jenis_saldo_id, ['class' => 'form-select', 'placeholder' => 'Pilih Jenis Saldo', 'required']) !!}
                </div>
                <div class="mb-3">
                    {!! Form::label('lokasi', 'Lokasi') !!}
                    {!! Form::text('lokasi', $row->lokasi, ['class' => 'form-control', 'placeholder' => 'Pilih Lokasi', 'required']) !!}
                </div>
                <div class="mb-3">
                    {!! Form::label('nominal', 'Nominal') !!}
                    {!! Form::number('nominal', $row->nominal, ['class' => 'form-control', 'placeholder' => 'Contoh: 10000', 'required']) !!}
                </div>
                <div class="mb-3">
                    {!! Form::label('tanggal', 'Tanggal') !!}
                    {!! Form::date('tanggal', $row->tanggal, ['class' => 'form-control', 'required']) !!}
                </div>
                <div class="mb-3">
                    {!! Form::label('keterangan', 'Keterangan') !!}
                    {!! Form::text('keterangan', $row->keterangan, ['class' => 'form-control', 'required']) !!}
                </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              {{Form::button('Ubah', ['class' => 'btn btn-success', 'type' => 'submit'])}}
              {!! Form::close() !!}
          </div>
      </div>
    </div>
  </div>
   
  <!-- Delete Modal -->
  <div class="modal fade" id="delete{{$row->id}}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="myModalLabel">Hapus Transaksi</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              {!! Form::model($transaksi, [ 'method' => 'delete','route' => ['transaksi.delete', $row->id] ]) !!}
                  <h4 class="text-center">Yakin ingin menghapus data transaksi?</h4>
                  {{-- <h5 class="text-center">Name: {{$row->firstname}} {{$row->lastname}}</h5> --}}
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              {{Form::button('Hapus', ['class' => 'btn btn-danger', 'type' => 'submit'])}}
              {!! Form::close() !!}
          </div>
      </div>
    </div>
  </div>