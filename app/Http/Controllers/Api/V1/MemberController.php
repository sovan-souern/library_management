<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMemberRequest;
use App\Models\Category;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $member = Member::all();
        return response()->json($member);
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(StoreMemberRequest $request)
{
    $validatedData = $request->validated();

    $member = Member::create($validatedData);

    return response()->json(['message' => 'Create Member successfully!'], 201);
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $member = Member::find($id);
        return response()->json($member);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $member = Member::find($id);
        if (!$member) {
            return response()->json(['message' => 'Not found member'], 404);
        }
        $member->name = $request->name ?? $member->name;
        $member->phone = $request->phone ?? $member->phone;
        $member->email = $request->email ?? $member->email;
        $member->gender = $request->gender ?? $member->gender;
        $member->book_id = $request->book_id ?? $member->book_id;
        $member->save();

        return response()->json(['message' => 'Update successfully'], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $member = Member::find($id);
        if (!$member) {
            return response()->json(['message' => 'Member not found !'], 404);
        }
        $member->delete();
        return response()->json(['message' => 'Delete member successfully', 200]);
    }
}
