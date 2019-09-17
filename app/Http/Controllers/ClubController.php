<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Result;
use App\Club;
use App\Http\Resources\ClubResource;
use Illuminate\Http\Resources\Json\Resource;


class ClubController extends Controller
{
    public function __construct() {
    $this->middleware('auth');
}

    protected function index() {
        try {

            $clubs = Resource::collection(Club::orderBy('created_at', 'ASC')->paginate(8));
            $response = [
                'pagination' => [
                    'total' => $clubs->total(),
                    'per_page' => $clubs->perPage(),
                    'current_page' => $clubs->currentPage(),
                    'last_page' => $clubs->lastPage(),
                    'from' => $clubs->firstItem(),
                    'to' => $clubs->lastItem()
                ],
                'data' => $clubs
            ];
        }
        catch (Exception $e) {
            return response()->json([
                'status' => $e
            ], 400);
        }
        return response()->json($response);
    }



}
