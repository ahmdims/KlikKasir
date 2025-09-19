@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Role & Permission Management</h3>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                <thead>
                    <tr class="fw-bold text-muted">
                        <th class="min-w-150px">Role Name</th>
                        <th class="min-w-100px text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>
                                <span
                                    class="text-dark fw-bold text-hover-primary d-block fs-6">{{ ucfirst($role->name) }}</span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('tenant.roles.edit', $role->id) }}"
                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                    <i class="ki-duotone ki-pencil fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection