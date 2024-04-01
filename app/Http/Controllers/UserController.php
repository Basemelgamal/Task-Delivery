<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function getUsers(Request $request){
        $userRole = Role::where('name', 'user')->first();
        $users = $userRole->users()
            ->filterByName($request->term)
            ->paginate(100);
        return response()->json($users);
    }
}
