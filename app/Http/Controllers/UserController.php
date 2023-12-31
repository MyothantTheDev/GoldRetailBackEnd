<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->json(['succcess' => true]);
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
        $this->validate($request, [
            "username"=> "required|string",
            "password"=> "required|min:8",
            "email" => "required|email:unique",
        ]);
        $hashedPassword = Hash::make($request->password);
        $user = User::create([
            "username"=> $request->username,
            "password"=> $hashedPassword,
            "email"=> $request->email,
            "is_admin"=> $request->is_admin,
            "is_staff"=> $request->is_staff,
        ]);
        $response = [
            'success' => true,
            'user' => $user,
            'message' => 'User is registered',
            'status' => 201,
        ];
        return response()->json( $response );
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
    }
}
