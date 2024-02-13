<?php

namespace App\Http\Controllers;

use App\Models\Regional;
use App\Models\Society;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use Notifiable;
    public function login(Request $request)
    {
        $credentials = $request->only('id_card_number', 'password');

        $society = Society::with('regional')->where($credentials)->first();

        if ($society) {
            
            $token = md5(uniqid());

            $society->update(['login_tokens' => $token]);

            $response = [
                'name' => $society->name,
                'born_date' => $society->born_date,
                'gender' => $society->gender,
                'address' => $society->address,
                'token' => $token,
                'regional' => [
                    'id' => $society->regional->id,
                    'province' => $society->regional->province,
                    'district' => $society->regional->district
                ]
            ];

            return response()->json($response);
        }

        return response()->json(['message' => 'ID Card Number or Password incorrect'], 401);
    }

    public function logout(Request $request)
    {
        $credentials = $request->only('id_card_number', 'password');

        $society = Society::with($credentials);
        $token = $request->input('token');

        if ($token) {
            $token = null;
            $society->update(['login_tokens'=> $token]);
            return response()->json(['message'=> 'LogOut Succes']);
        }

        return response()->json(['message'=> 'Invalid token'],401);
    }


    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
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
        //
    }
}
