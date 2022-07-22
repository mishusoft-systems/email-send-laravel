<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('User/Index', [
            'users' => User::all()->map(
            fn($user): array => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'is_subscribe' => $user->is_subscribe,
            ]),
        ]);
    }

    public function unsubscribe(Request $request, string $userHash): Response
    {
        $request->validate(array(
            'user_hash' => 'string'
        ));

        User::where('hash', $userHash)->update(['is_subscribe' => false]);

        return Inertia::render('User/Unsubscription', []);

    }
}
