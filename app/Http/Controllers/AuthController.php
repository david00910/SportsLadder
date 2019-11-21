<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\User;
class AuthController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'refresh']]);
    }


    /**
     * Register a new user
     */
    public function register(Request $request)
    {
        $userCount = User::count();

        $v = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password'  => 'required|min:3|confirmed',
            'gender' => 'required',
            'user_type' => 'required'
        ]);
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 422);
        }

        try {

            $user = new User;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->gender = $request->gender;
            $user->ranking = $userCount+1;
            $user->user_type = $request->user_type;
            $user->assignRole('player');
            $user->save();


        }

        catch(Exception $e) {
            return response()->json([
                'status' => 'error',
                'errors' => $e->errors()
            ], 400);

        }



        return response()->json(['status' => 'success'], 200);
    }
    /**
     * Login user and return a token
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if ($token = $this->guard()->attempt($credentials)) {
            return response()->json(['status' => 'success'], 200)->header('Authorization', $token);
        }
        return response()->json(['error' => 'login_error'], 401);
    }
    /**
     * Logout User
     */
    public function logout()
    {
        $this->guard()->logout();
        return response()->json([
            'status' => 'success',
            'msg' => 'Logged out Successfully.'
        ], 200);
    }
    /**
     * Get authenticated user
     */
    public function me(Request $request)
    {
        $user = User::find(Auth::user()->id);

        $role = User::find(Auth::user()->id)->roles()->pluck('name');

        $owner = User::find(Auth::user()->id)->ownedClub()->get();

        foreach($owner as  $ownerOf) {
            $ownedClub = $ownerOf;
        }

        foreach($role as $ro) {
            $roleTo = $ro;
        }

        if(isset($ownedClub)) {


            return response()->json([
                'status' => 'success',
                'data' => array(
                    'user' => $user,
                    'role' => $roleTo,
                    'owner' => $ownedClub
                )

            ]);
        }
        else {
            return response()->json([
                'status' => 'success',
                'data' => array(
                    'user' => $user,
                    'role' => $roleTo,
                )

            ]);
        }
    }
    /**
     * Refresh JWT token
     */
    public function refresh()
    {
        if ($token = $this->guard()->refresh()) {
            return response()
                ->json(['status' => 'success'], 200)
                ->header('Authorization', $token);
        }
        return response()->json(['error' => 'refresh_token_error'], 401);

    }
    /**
     * Return auth guard
     */
    private function guard()
    {
        return Auth::guard();
    }
}
