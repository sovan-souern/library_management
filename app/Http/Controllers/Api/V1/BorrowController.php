<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Borrow;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['message' => 'List of borrows']);

        return Borrow::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $borrow = new Borrow();
        $borrow->user_id = $request->user_id;
        $borrow->start_at = $request->start_at;
        $borrow->end_date = $request->end_date;
        $borrow->status = $request->status;
        $borrow->quantity = $request->quantity;
        $borrow->save();
        return response()->json($borrow, 201);
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $borrow = Borrow::find($id);
        if (!$borrow) {
            return response()->json(['message' => 'Borrow not found'], 404);
        }
        return response()->json($borrow);
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $borrow = Borrow::find($id);

        if (!$borrow) {
            return response()->json(['message' => 'Borrow not found'], 404);
        }

        $borrow->delete();
        return response()->json(['message' => 'Borrow deleted successfully']);
        //
    }
}
