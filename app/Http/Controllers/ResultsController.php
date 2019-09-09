<?php

namespace App\Http\Controllers;

use App\Result;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ResultResource;

class ResultsController extends Controller
{

    public function index()
    {

       //return ResultResource::collection(Result::orderBy('date', 'DESC')->paginate(10));

        $results = ResultResource::collection(Result::orderBy('date', 'DESC')->paginate(10));
        $response = [
            'pagination' => [
                'total' => $results->total(),
                'per_page' => $results->perPage(),
                'current_page' => $results->currentPage(),
                'last_page' => $results->lastPage(),
                'from' => $results->firstItem(),
                'to' => $results->lastItem()
            ],
            'data' => $results
        ];

        return response()->json($response);

    }

    public function show($id)
    {
        $result = Result::with('winners')->with('losers')->find($id);
        return response()->json([
            'data' => $result
        ]);
    }

    public function update(Request $request)
    {

    }

    public function destroy(User $user)
    {

    }
}
