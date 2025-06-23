<?php

namespace App\Http\Controllers\Api\V1;

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
    public function store(Request $request)
    {
        $users = new User();
        $users->first_name = $request->first_name;
        $users->last_name = $request->last_name;
        $users->gender = $request->gender;
        $users->email = $request->email;
        $users->save();

        return response()->json($users, 201);
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
        $users = User::find($id);

        if (!$users) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $users->update([
            'first_name' => $request->first_name, // ✅ fixed typo here
            'last_name'  => $request->last_name,
            'gender'     => $request->gender,
            'email'      => $request->email,
        ]);

        return response()->json($users, 200);
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
