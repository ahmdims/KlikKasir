@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Permissions for: <span class="text-primary">{{ ucfirst($role->name) }}</span></h3>
    </div>
    <form action="{{ route('roles.update', $role->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="row">
                <h4>Assign Permissions:</h4>
                @foreach($permissions as $permission)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input"
                                   type="checkbox"
                                   name="permissions[]"
                                   value="{{ $permission->name }}"
                                   id="perm_{{ $permission->id }}"
                                   {{ in_array($permission->name, $rolePermissions) ? 'checked' : '' }}
                            />
                            <label class="form-check-label" for="perm_{{ $permission->id }}">
                                {{ $permission->name }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="card-footer d-flex justify-content-end py-6 px-9">
             <a href="{{ route('roles.index') }}" class="btn btn-light btn-active-light-primary me-2">Discard</a>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
    </form>
</div>
@endsection