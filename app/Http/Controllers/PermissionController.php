<?php

namespace App\Http\Controllers;

use App\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();

        return view('permission.index', compact('permissions'));
    }
}