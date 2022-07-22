<?php

namespace App\Http\Controllers;

use App\Models\SentEmail;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserResponseController extends Controller
{
    public function index(Request $request, int $user, string $type, int $typeId): \Inertia\Response
    {
        SentEmail::where(array('user' => $user, 'message' => $typeId))->update(['is_response_found' => true]);

        return Inertia::render('User/Response', []);
    }
}
