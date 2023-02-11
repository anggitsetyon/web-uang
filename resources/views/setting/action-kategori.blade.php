<!-- Edit Modal -->
<div class="modal fade" id="edit{{$row->id}}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="myModalLabel">Ubah Transaksi</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
                  {!! Form::model($kategori, [ 'method' => 'patch','route' => ['kategori.update', $row->id] ]) !!}
                <div class="mb-3">
                    {!! Form::label('jenis_akun', 'Jenis Akuntansi') !!}
                    {!! Form::text('jenis_akun', $row->jenis_akun,['class' => 'form-control', 'placeholder' => 'Pilih Jenis Akuntansi','required']) !!}
                </div>
                <div class="mb-3">
                    {!! Form::label('jenis_rekap', 'Jenis Saldo') !!}
                    {!! Form::select('jenis_rekap', $selectJenisRekap, $row->jenis_rekap_id, ['class' => 'form-select', 'placeholder' => 'Pilih Jenis Rekap', 'required']) !!}
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
              <h5 class="modal-title" id="myModalLabel">Hapus Kategori</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              {!! Form::model($kategori, [ 'method' => 'delete','route' => ['kategori.delete', $row->id] ]) !!}
                  <h4 class="text-center">Yakin ingin menghapus data kategori?</h4>
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