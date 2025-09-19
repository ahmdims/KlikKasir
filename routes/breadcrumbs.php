<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbGenerator;

Breadcrumbs::for('dashboard', function (BreadcrumbGenerator $trail) {
    $trail->push('Home', route('dashboard'));
});

Breadcrumbs::for('users.index', function (BreadcrumbGenerator $trail) {
    $trail->parent('dashboard');
    $trail->push('Users', route('users.index'));
});

Breadcrumbs::for('users.edit', function (BreadcrumbGenerator $trail, $user) {
    $trail->parent('users.index');
    $trail->push('User Edit', route('users.edit', $user));
});

Breadcrumbs::for('roles.index', function (BreadcrumbGenerator $trail) {
    $trail->parent('dashboard');
    $trail->push('Roles', route('roles.index'));
});

Breadcrumbs::for('roles.show', function (BreadcrumbGenerator $trail, $role) {
    $trail->parent('roles.index');
    $trail->push('Role Show', route('roles.show', $role));
});

Breadcrumbs::for('permissions.index', function (BreadcrumbGenerator $trail) {
    $trail->parent('dashboard');
    $trail->push('Permissions', route('permissions.index'));
});