<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Menu;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        $menus = Menu::all();
        return view('admin.roles.create', compact('menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $role = Role::create($request->only('title'));
        // Attach menus if necessary
        $role->menus()->sync($request->menus);

        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $menus = Menu::all();
        return view('admin.roles.edit', compact('role', 'menus'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $role = Role::findOrFail($id);
        $role->update($request->only('title'));
        // Update menus if necessary
        $role->menus()->sync($request->menus);

        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }
}
