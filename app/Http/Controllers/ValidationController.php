<?php

namespace App\Http\Controllers;

use App\Models\Society;
use App\Models\Validation;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ValidationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $token = $request->input("token");
        $society = Society::where('login_tokens', $token)->first();
        $validation = Validation::with('validator')->where('society_id', $society->id)->first();

        if ($token && $validation) {

            return response()->json([
                'validation' => $validation
            ], 200);
        }

        return response()->json(['message' => 'Unauthorized user'], 401);
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
        
        $workexp = $request->input("work_experience");
        $jobcat = $request->input("job_category_id");
        $jobpos = $request->input("job_position");
        $reson = $request->input("reason_accepted");
        $token = $request->input("token");

        $societyId = Society::where("login_tokens", $token)->first();
        $validation = Validation::where('society_id', $societyId->id)->first();

        if ($token && !$validation) {

            $dataToUpdate = [
                'work_experience' => $workexp,
                'job_category_id' => $jobcat,
                'job_position' => $jobpos,
                'reason_accepted' => $reson,
                'society_id' => $societyId->id,

            ];

            Validation::create($dataToUpdate);
            return response()->json(['message' => 'Request data validation sent successfully'], 200);
        }

        return response()->json(['message' => 'Unauthorized user'], 401);
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
