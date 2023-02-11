<div class="modal fade" id="edit{{$row->id}}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="myModalLabel">Ubah User</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
                  {!! Form::model($user, [ 'method' => 'post','route' => ['users.update', $row->id] ]) !!}
                <div class="mb-3">
                    {!! Form::label('name', 'Nama') !!}
                    {!! Form::text('name', $row->name,['class' => 'form-control','required']) !!}
                </div>
                {{-- <div class="mb-3">
                    {!! Form::label('email', 'Jenis Saldo') !!}
                    {!! Form::text('email', $row->email, ['class' => 'form-control', 'required']) !!}
                </div> --}}
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              {{Form::button('Ubah', ['class' => 'btn btn-success', 'type' => 'submit'])}}
              {!! Form::close() !!}
          </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="delete{{$row->id}}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="myModalLabel">Hapus Kategori</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              {!! Form::model($user, [ 'method' => 'delete','route' => ['users.delete', $row->id] ]) !!}
                  <h4 class="text-center">Yakin ingin menghapus user {{ $row->name }}?</h4>
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