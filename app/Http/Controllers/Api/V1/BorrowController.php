<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBorrowRequest;
use App\Models\Borrow;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $borrow = Borrow::all();
        return response()->json($borrow);

       
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(StoreBorrowRequest $request)
    {
        $validated = $request->validated();

        $borrow = Borrow::create($validated);

        return response()->json($borrow, 201);
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
        $borrow = Borrow::find($id);
        $borrow->user_id = $request->user_id ?? $borrow-> user_id;
        $borrow->start_at= $request->start_at?? $borrow-> start_at;
        $borrow->end_date = $request->end_date ?? $borrow-> end_date;
        $borrow->status = $request->status ?? $borrow-> status;
        $borrow->quantity = $request->quantity ?? $borrow-> quantity;
        $borrow->save();
        return response()->json(['message'=>'Update borrow successfully'], 200);
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
