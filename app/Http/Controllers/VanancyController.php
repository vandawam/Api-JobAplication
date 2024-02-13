<?php

namespace App\Http\Controllers;

use App\Models\AvailablePositions;
use App\Models\JobVacancy;
use Illuminate\Http\Request;

class VanancyController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * 
     */

     public function datavac($jobVacancies){
        $dats = [] ;

        foreach ($jobVacancies as $vacancy) {


            $availablet = [];

            foreach ($vacancy->availables as $available) {
                $available_positions = [
                    'position' => $available->position ?? null,
                    'capacity' => $available->capacity ?? null,
                    'apply_capacity' => $available->apply_capacity ?? null,
                ];
                array_push($availablet, $available_positions);
            }

            $data = [
                'id' => $vacancy->id,
                'category' => [
                    'id' => $vacancy->jobCategory->id,
                    'job_category' => $vacancy->jobCategory->job_category,
                ],
                'company' => $vacancy->company,
                'address' => $vacancy->address,
                'description' => $vacancy->description,
                'available' => $availablet
            ];

            array_push($dats, $data);
        }

        
        return $dats;

     }
    public function index(Request $request)
    {
        $token = $request->get("token");

        if ($token) {
            try {

                $jobVacancies = JobVacancy::with(['jobCategory', 'availables'])->get();

                if (!$jobVacancies) {
                    return response()->json(['message' => 'No Vacancy found'], 404);
                }

                $response = [
                    'vacancies' => $this->datavac($jobVacancies)
                ];

                return response()->json($response);
                
            } catch (\Exception $e) {
                return response()->json(['message' => 'Error retrieving data' . $e->getMessage()], 500);
            }
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $job_vacancy, Request $request)
    {
        $token = $request->get('token');

        if ($token) {
            try {

                $jobVacancies = JobVacancy::with(['jobCategory', 'availables'])->where('id', $job_vacancy)->get();

                if ($jobVacancies->count() < 1) {
                    return response()->json(['message' => 'No Vacancy found'], 404);
                }

                $response = [
                    'vacancy' => $this->datavac($jobVacancies)
                ];

                return response()->json($response);
                
            } catch (\Exception $e) {
                return response()->json(['message' => 'Error retrieving data' . $e->getMessage()], 500);
            }
        }
            return response()->json(['message' => 'Unauthorized user'], 401);
        

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
