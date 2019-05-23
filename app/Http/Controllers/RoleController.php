<?php

namespace Flurry\Http\Controllers;

use Illuminate\Http\Request;
use Flurry\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $roles = Role::all()->sortBy('name');
            return response()->json($roles, 200);
        }
        abort(404);
    }
}
