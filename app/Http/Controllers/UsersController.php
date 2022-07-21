<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\URL;
use Inertia\Inertia;

class UsersController extends Controller
{
    public function index(): \Inertia\Response
    {
        return Inertia::render('Users/Index', [
            'users' => User::all()->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'edit_url' => URL::route('users.edit', $user),
                ];
            }),
            'create_url' => URL::route('users.create'),
        ]);
    }
}
