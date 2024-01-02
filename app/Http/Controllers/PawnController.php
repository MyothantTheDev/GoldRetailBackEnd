<?php

namespace App\Http\Controllers;

use App\Models\Pawn;
use App\Models\Weight;
use Illuminate\Http\Request;
use MongoDB\BSON\ObjectId;

class PawnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pawn = Pawn::all();
        return response()->json($pawn);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            "name"=> "required|string",
            "type"=> "required|string",
            "weight"=> "required|array",
            "loan"=> "required",
            "textLoan"=> "required",
            "remark"=> "required",
        ]);
        $totalweight = $request->weight;
        $pawn = Pawn::create([
            "name"=> $request->name,
            "type"=> $request->type,
            "loan"=>$request->loan,
            "textLoan" => $request->textLoan,
            "remark"=> $request->remark,
        ]);
        // $pawnObjectId = new ObjectId($pawn->id);
        $weight = Weight::create([
            "weight1"=> $totalweight[0],
            "weight2"=> $totalweight[1],
            "weight3"=> $totalweight[2],
            "pawn_id" => $pawn->id,
        ]);
        $res = [
            "pawn" => $pawn,
            "weight" => $weight,
        ];
        return response()->json($res);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pawn  $pawn
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $pawn = Pawn::with("weight")->findOrFail($id);
        return response()->json($pawn);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pawn  $pawn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pawn $pawn)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pawn  $pawn
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pawn $pawn)
    {
        //
    }
}
