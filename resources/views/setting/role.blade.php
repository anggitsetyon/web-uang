@extends('layouts.index')
@section('content')
<title>User Role</title>
<div class="container-sm m-3">
    <div class="d-flex">
        <a href="/users" class="p-2 bg-secondary mt-1 rounded-3 link-light text-decoration-none">
            <i class="fas fa-angle-left"></i>
            Kembali</a>
    </div>
    <div class="list-group list-group-flush">
    <div class="mt-3 list-group-item">Name: {{ $user->name }}</div>
    <div class="list-group-item">Email: {{ $user->email }}</div>
    <div class="mt-2 list-group-item">Roles: 
        <div class="d-flex">
            @if ($user->roles)
                @foreach ($user->roles as $user_role)
                    <form class="" method="POST"
                        action="{{ route('users.role.delete', [$user->id, $user_role->id]) }}"
                        onsubmit="return confirm('Yakin ingin menghapus role {{ $user_role->name }}?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger m-1">{{ $user_role->name }}</button>
                    </form>
                @endforeach
            @endif
        </div>
    </div>
    </div>
    <div class="d-flex bd-highlight mt-2">
        <form method="POST" action="{{ route('users.role.save', $user->id) }}" class="bd-highlight">
        @csrf
            <div class="d-flex">
                <div class=" d-flex flex-row align-items-center ml-2">
                    <label for="role" class="">Roles</label>
                    <select name="role" required data-column="1" class="form-select form-select-sm m-1" aria-label=".form-select-sm example" autocomplete="role-name">
                        <option value="">Add Role</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
            @error('role')
                <span class="text-red-400 text-sm">{{ $message }}</span>
            @enderror
            <button type="submit" class="btn btn-success">Assign</button>
            </div>
        </form>
    </div>
</div>
    
@endsection