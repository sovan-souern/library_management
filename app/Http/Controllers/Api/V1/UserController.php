<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\StoreUserRequest;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $validatedData = $request->validated();

        $user = User::create($validatedData);

        return response()->json($user, 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $users = User::find($id);
        if (!$users) {
            return response()->json(['message' => 'User not found'], 404);
        }
        return response()->json($users);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'gender'     => 'required|in:male,female,other',
            'email'      => 'required|email|unique:users,email,' . $id,
        ]);

        $user->update($validatedData);

        return response()->json($user, 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $users = User::find($id);

        if (!$users) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $users->delete();
        return response()->json(['message' => 'User deleted successfully'], 200);
    }

    /**
     * Get all users with their borrowed books.
     */
    public function getUsersWithBorrowedBooks()
    {
        $users = User::with('borrows')->get();

        return response()->json([
            'status' => 'success',
            'data' => $users
        ], 200);
    }
}
