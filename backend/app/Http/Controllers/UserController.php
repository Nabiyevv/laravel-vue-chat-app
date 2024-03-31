<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        if($users->isEmpty()){
            return response()->json([
                'status' => 'error',
                'message' => 'Users not found!',
                'data' => [],
            ],Response::HTTP_NOT_FOUND);
        }

        return response()->json([
                'status' => 'success',
                'message' => 'Users found',
                'data' => $users,
            ],Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        // $user = User::query()->find($id)->makeHidden(['email_verified_at','created_at','updated_at']);
        $user = User::query()->find($id);
        if(!$user)
            return response()->json([
                'status' => 'error',
                'message' => 'User not found!',
                'data' => []
            ],Response::HTTP_NOT_FOUND);

        return response()->json([
            'status' => 'success',
            'message' => 'User found',
            'data' => $user
        ]);

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
        //
    }
}
