<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbGenerator;

Breadcrumbs::for('dashboard', function (BreadcrumbGenerator $trail) {
    $trail->push('Home', route('dashboard'));
});

Breadcrumbs::for('tenant.create', function (BreadcrumbGenerator $trail) {
    $trail->parent('dashboard');
    $trail->push('Create Tenant', route('tenant.create'));
});

Breadcrumbs::for('tenant.index', function (BreadcrumbGenerator $trail) {
    $trail->parent('dashboard');
    $trail->push('Tenants', route('tenant.index'));
});

Breadcrumbs::for('tenant.settings', function (BreadcrumbGenerator $trail) {
    $trail->parent('tenant.index');
    $trail->push('Tenant Settings', route('tenant.settings'));
});

Breadcrumbs::for('tenant.edit', function (BreadcrumbGenerator $trail, $tenant) {
    $trail->parent('tenant.index');
    $trail->push('Edit Tenant', route('tenant.edit', $tenant));
});

Breadcrumbs::for('users.index', function (BreadcrumbGenerator $trail) {
    $trail->parent('dashboard');
    $trail->push('Users', route('users.index'));
});

Breadcrumbs::for('users.edit', function (BreadcrumbGenerator $trail, $user) {
    $trail->parent('users.index');
    $trail->push('Edit User', route('users.edit', $user));
});

Breadcrumbs::for('roles.index', function (BreadcrumbGenerator $trail) {
    $trail->parent('dashboard');
    $trail->push('Roles', route('roles.index'));
});

Breadcrumbs::for('roles.show', function (BreadcrumbGenerator $trail, $role) {
    $trail->parent('roles.index');
    $trail->push('Show Role', route('roles.show', $role));
});

Breadcrumbs::for('permissions.index', function (BreadcrumbGenerator $trail) {
    $trail->parent('dashboard');
    $trail->push('Permissions', route('permissions.index'));
});