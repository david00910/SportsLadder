<?php

namespace App\Http\Controllers;

use App\Result;
use App\User;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ResultResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class ResultsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => 'index']);
    }


    protected function index()
    {

       //return ResultResource::collection(Result::orderBy('date', 'DESC')->paginate(10));

        $results = ResultResource::collection(Result::orderBy('updated_at', 'DESC')->paginate(10));
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

    protected function show($id)
    {
        $result = Result::with('winners')->with('losers')->find($id);
        return response()->json([
            'data' => $result
        ]);
    }

    protected function create() {

        $users = User::orderBy('ranking', 'ASC')->get();

        return response()->json($users);

    }

    protected function store(Request $request)
    {
        $current = JWTAuth::parseToken()->authenticate();
        $cu = $current->id;

        $request->validate([
            'winner_id' => 'required',
            'loser_id' => 'required',
            'result' => 'required'
        ]);

        try {

            $result = new Result;
            $result->winner_id = $request->winner_id;
            $result->loser_id = $request->loser_id;
            $result->result = $request->result;
            if($request->winner_id == $cu || $request->loser_id == $cu)  {
                $result->save();
            }
            else {
                return response()->json(['err' => 'You must be either the loser or the winner!',
                    $request->winner_id, $request->loser_id, $cu]);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'error' => $e->errors()
            ], 400);

        }

        return response()->json(['status' => 'success', 'msg' => 'You have successfully saved the result of your match!'], 200);
    }

    protected function update(Request $request)
    {

    }

    protected function destroy()
    {

    }
}
