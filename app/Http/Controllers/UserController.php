<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => ['required', Password::min(8)],
            'birthDate' => 'required|date|date_format:Y-m-d',
            'profilePicture' => 'nullable|url',
            'isSelfPay' => 'required|boolean',
            'address' => 'required|string|max:255',
            'phoneNumber' => 'required|string|max:20',
        ]);

        $user = User::create($validated);

        return response()->json($user, 201);
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'firstName' => 'sometimes|required|string|max:255',
            'lastName' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:users,email,' . $user->id,
            'birthDate' => 'sometimes|required|date|date_format:Y-m-d',
            'profilePicture' => 'nullable|url',
            'isSelfPay' => 'sometimes|required|boolean',
            'address' => 'sometimes|required|string|max:255',
            'phoneNumber' => 'sometimes|required|string|max:20',
        ]);

        $user->update($validated);

        return response()->json($user, 200);
    }

    public function showLoginForm()
    {
        $user = null; // or fetch user data if needed
        return view('login', compact('user'));
    }
}