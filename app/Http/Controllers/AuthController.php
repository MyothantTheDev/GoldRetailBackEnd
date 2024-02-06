<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','refresh','register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request) {
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
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    // public function refresh()
    // {
    //     // return $this->respondWithToken(auth()->refresh());
    //     $connection = DB::connection('mongodb');
    //     $msg = 'Mongo DB is accessible.';
    //     try {
    //         //code...
    //         $connection->command(['ping' => 1]);
    //     } catch (\Exception $e) {
    //         //throw $th;
    //         $msg = 'Mongo DB is not accessible. Error: ' . $e->getMessage();
    //     }
    //     return response()->json(['msg' => $msg]);
    // }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
