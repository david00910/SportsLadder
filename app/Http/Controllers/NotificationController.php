<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Notification;
use JWTAuth;
use Auth;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    protected function indexNotification() {

        //$user = JWTAuth::parseToken()->authenticate();

        $user = User::find(Auth::user()->id)->notification()->paginate(10);

        $notification = $user;

        $response = [
            'pagination' => [
                'total' => $notification->total(),
                'per_page' => $notification->perPage(),
                'current_page' => $notification->currentPage(),
                'last_page' => $notification->lastPage(),
                'from' => $notification->firstItem(),
                'to' => $notification->lastItem()
            ],
            'data' => $user
        ];

        return response()->json($response);

    }
}
