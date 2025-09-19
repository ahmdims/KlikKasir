@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit User: {{ $user->name }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="fv-row mb-7">
                    <label class="required fw-semibold fs-6 mb-2">Full Name</label>
                    <input type="text" name="name" class="form-control form-control-solid mb-3 mb-lg-0"
                        placeholder="Full name" value="{{ $user->name }}" />
                </div>
                <div class="fv-row mb-7">
                    <label class="required fw-semibold fs-6 mb-2">Email</label>
                    <input type="email" name="email" class="form-control form-control-solid mb-3 mb-lg-0"
                        placeholder="example@domain.com" value="{{ $user->email }}" />
                </div>
                <div class="fv-row mb-7">
                    <label class="required fw-semibold fs-6 mb-2">Roles</label>
                    <div class="d-flex flex-wrap">
                        @foreach ($roles as $role)
                            <div class="form-check form-check-custom form-check-solid me-10 mb-5">
                                <input class="form-check-input" name="roles[]" type="checkbox" value="{{ $role->name }}"
                                    id="role_{{ $role->id }}" {{ in_array($role->name, $userRoles) ? 'checked' : '' }} />
                                <label class="form-check-label" for="role_{{ $role->id }}">
                                    {{ $role->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="text-center pt-15">
                    <a href="{{ route('users.index') }}" class="btn btn-light me-3">Discard</a>
                    <button type="submit" class="btn btn-primary">
                        <span class="indicator-label">Submit</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection