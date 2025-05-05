<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all(); // Fetch all users
        return response()->json($users); // Return as JSON
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => 'user', // Default role
        ]);

        return response()->json($user, 201); // Return the created user with a 201 status
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id); // Find the user by ID

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404); // Return 404 if not found
        }

        return response()->json($user); // Return the user as JSON
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id); // Find the user by ID

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404); // Return 404 if not found
        }

        $validated = $request->validate([
            'name'     => 'sometimes|string|max:255',
            'email'    => 'sometimes|string|email|max:255|unique:users,email,' . $id,
            'password' => 'sometimes|string|min:6',
        ]);

        $user->update([
            'name'     => $validated['name'] ?? $user->name,
            'email'    => $validated['email'] ?? $user->email,
            'password' => isset($validated['password']) ? Hash::make($validated['password']) : $user->password,
        ]);

        return response()->json($user); // Return the updated user
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id); // Find the user by ID

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404); // Return 404 if not found
        }

        $user->delete(); // Delete the user

        return response()->json(['message' => 'User deleted successfully']); // Return success message
    }
}
