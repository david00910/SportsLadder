<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }


    protected function index()
    {

        //$users = UserResource::collection(User::orderBy('ranking', 'ASC')->paginate(10));
        $users = User::orderBy('ranking', 'ASC')->paginate(10);
        $response = [
            'pagination' => [
                'total' => $users->total(),
                'per_page' => $users->perPage(),
                'current_page' => $users->currentPage(),
                'last_page' => $users->lastPage(),
                'from' => $users->firstItem(),
                'to' => $users->lastItem()
            ],
            'data' => $users
        ];

        return response()->json($response);


    }

    protected function show($id)
    {
        $user = User::find($id);
        return response()->json([
            'data' => $user
        ]);

    }

    protected function update(User $user, Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'ranking' => 'required'
        ]);

        try {

            $user->update($data);

        }
        catch(Exception $e) {

            return response()->json([
                'status' => 'error',
                'errors' => $e->errors()
            ], 400);

        }

        return [new UserResource($user),
            response()->json(['status' => 'success'], 200)];
    }

    protected function destroy(User $user)
    {
        $user->delete();

        return response(null, 204);

    }
}
