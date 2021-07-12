<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        return Role::orderBy('created_at', 'desc')->get();
    }

    public function store(Request $request)
    {
        $role = Role::create($request->validate([
            'name'          =>  'required',
            'description'   =>  'required'
        ]));

        return response()->json($role, 200);
    }

    public function update(Request $request, $id)
    {
        $role = Role::where('id', $id);
        $role->update($request->validate([
            'name'          =>  'required',
            'description'   =>  'required'
        ]));

        return response()->json($role->first(), 200);
    }

    public function destroy($id)
    {
        Role::where('id', $id)->delete();

        return response()->json([
            'message'   =>  'Role ' . $id . ' deleted.'
        ]);
    }
}
