<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    public function ban(User $user) {
        $user->banned = !$user->banned;
        $user->save();

        return redirect()->route('admin.users.index')->with('status', 'Status korisnika je uspešno ažuriran!');
    }

    public function promote(User $user) {
        if($user->role === 'student') {
            $user->role = 'nastavnik';
            $user->save();
        }

        return redirect()->route('admin.users.index')->with('status', 'Rola korisnika je uspešno ažurirana!');
    }

}
