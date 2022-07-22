<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index(): \Inertia\Response
    {
        return Inertia::render('Users', [
            'users' => User::all()->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'is_subscribe' => $user->is_subscribe,
                    // 'edit_url' => URL::route('users.edit', $user),
                ];
            }),
            // 'create_url' => URL::route('users.create'),
            // 'update_url' => URL::route('users.create'),
        ]);
    }
}
