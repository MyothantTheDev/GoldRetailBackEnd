<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Weight;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use QuickBooks_WebConnector_Server;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sales = Sale::all();
        foreach($sales as $sale) {
            $sale->totalweight;
            $sale->encounts;
            $sale->gemWeight;
        };
        return response()->json($sales);
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
            "buyerName" => "required|string",
            "price" => "required",
            "weight" => "required",
            "encount" => "required",
            "gemWeight" => "required",
            "gold" => "required",
            "fee" => "required",
            "gem" => "required",
            "polish" => "required",
            "discount" => "required",
            "total" => "required",
            "net" => "required"
        ]);
        $weightArray = [$request->weight,$request->encount,$request->gemWeight];
        $weightID = [];
        for ($i=0; $i < count($weightArray); $i++) {
            # code...$weightArray[$i]
            $weight = Weight::create([
                "weight1" => $weightArray[$i][0],
                "weight2" => $weightArray[$i][1],
                "weight3" => $weightArray[$i][2]
            ]);
            $weightID[$i] = $weight->id;
        }
        $sale = Sale::create([
            "buyer" => $request->buyerName,
            "price" => $request->price,
            "gold" => $request->gold,
            "fee" => $request->fee,
            "gem" => $request->gem,
            "polish" => $request->polish,
            "discount" => $request->discount,
            "total" => $request->total,
            "net" => $request->net,
            "weight" => $weightID[0],
            "encount" => $weightID[1],
            "gem_weight" => $weightID[2],
        ]);
        return response()->json($sale);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $sale = Sale::find($id);
        $sale->totalweight;
        $sale->encounts;
        $sale->gemWeight;
        return response()->json($sale, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        try {
            //code...
            $request->validate([
                "buyerName" => "required|string",
                "price" => "required",
                "weight" => "required",
                "encount" => "required",
                "gemWeight" => "required",
                "gold" => "required",
                "fee" => "required",
                "gem" => "required",
                "polish" => "required",
                "discount" => "required",
                "total" => "required",
                "net" => "required"
            ]);
            $weightArray = [$request->weight,$request->encount,$request->gemWeight];
            $weightCatagory = ["weight","encount","gemWeight"];
            $weightUpdateArray = [];
            for ($i=0; $i < count($weightCatagory) ; $i++) {
                $tempArray = [
                    "weight1" => $weightArray[$i][0],
                    "weight2" => $weightArray[$i][1],
                    "weight3" => $weightArray[$i][2]
                ];
                $weightUpdateArray[$weightCatagory[$i]] = $tempArray;
            }
            $sale = Sale::find($id);
            $sale->totalweight->update($weightUpdateArray["weight"]);
            $sale->encounts->update($weightUpdateArray["encount"]);
            $sale->gemWeight->update($weightUpdateArray["gemWeight"]);
            $sale->update([
                "buyer" => $request->buyerName,
                "price" => $request->price,
                "gold" => $request->gold,
                "fee" => $request->fee,
                "gem" => $request->gem,
                "polish" => $request->polish,
                "discount" => $request->discount,
                "total" => $request->total,
                "net" => $request->net,
            ]);
            $sale->save();
            return response()->json($sale, 200);
        } catch (\Exception $e) {
            return response()->json(["message" => "Something went wrong!", "error" => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            $sale = Sale::find($id);
            $sale->totalweight->delete();
            $sale->delete();
            return response()->json([$sale, "message" => "Sale Item delete successful."], 200);
        } catch (\Exception $e) {
            return response()->json(["message" => "Something went wrong!", "error" => $e->getMessage()], 500);
        }
    }
}
