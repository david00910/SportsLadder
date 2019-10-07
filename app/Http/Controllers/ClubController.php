<?php

namespace App\Http\Controllers;

use App\ClubMembers;
use Carbon\Traits\Date;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Result;
use App\Club;
use App\Address;
use App\ZipCode;
use Illuminate\Support\Facades\Storage;
use JWTAuth;
use Image;
use DB;
use File;
use App\Http\Resources\ClubResource;
use Illuminate\Http\Resources\Json\Resource;


class ClubController extends Controller
{
    public function __construct() {
    $this->middleware('auth');
}

    protected function index() {
        try {

            $clubs = ClubResource::collection(Club::orderBy('created_at', 'DESC')->paginate(6));

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

    protected function store(Request $request)
    {
        $currentY = date('Y');

        $request->validate([
            'name' => 'required',
            'foundation_date' => 'required|numeric|min:1830|max:' . $currentY,
            'about',
            'street' => 'required',
            'zip' => 'required',
            'city' => 'required',
            'country' => 'required',

        ]);

        try {

            $currentUser = JWTAuth::parseToken()->authenticate();
            $cu = $currentUser->id;

            $zipCode = ZipCode::where('zip', '=', $request->zip)->first();
            $clubName = Club::where('name', '=', $request->name)->first();

            if ($clubName === null) {

                if ($zipCode === null) {

                    $zip = new ZipCode;
                    $zip->zip = $request->zip;
                    $zip->city = $request->city;
                    $zip->save();
                }


                $address = new Address;
                $address->pCode = $request->zip;
                $address->country = $request->country;
                $address->street = $request->street;
                $address->save();

                $last_id = DB::getPDO()->lastInsertId();

                $club = new Club;
                $club->name = $request->name;
                $club->about = $request->about;
                $club->foundation_date = $request->foundation_date;
                $club->owner = $cu;
                $club->address_id = $last_id;
                $club->save();

                // IMAGE HANDLING

                if($request->get('image')) {
                    $image = $request->get('image');
                    $name = time() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];

                    $tempImage = Image::make($image);

                    $tempImage->resize(500, null, function ($constraint) {
                            $constraint->aspectRatio();
                    })->orientate();

                    $tempImage->save(public_path('images/').$name);

                    $originalImagePath = 'storage/images/clubs/'.$club->id.'/'. $name;

                    Storage::disk('local')->put('public/images/clubs/'.$club->id.'/'.$name, $tempImage);
                    $tempPath = public_path('images/').$name;
                    unlink($tempPath);

                    $club->avatar_url = $originalImagePath;
                    $club->save();



                }

                if ($currentUser->hasRole('player')) {


                    $currentUser->removeRole('player');
                    $currentUser->assignRole('club_owner');
                }

            } else {
                return response()->json(['err' => 'A club with the same name already exists..']);
            }




        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'error' => $e->errors()
            ], 400);

        }

        return response()->json(['status' => 'success', 'msg' => 'You have successfully created your club!'], 200);
    }

    protected function show($id) {

        $club = Club::with('clubAddress')->with('ownerUser')->with('clubMembers')->find($id);

        return response()->json($club);

    }

    protected function changeImage(Request $request, $id) {

        try {

            $club = Club::with('clubAddress')->with('ownerUser')->with('clubMembers')->find($id);
            if($request->get('image')) {
                $image = $request->get('image');
                $name = time() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];

                $tempImage = Image::make($image);

                $tempImage->resize(500, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->orientate();

                $tempImage->save(public_path('images/').$name);

                $originalImagePath = 'storage/images/clubs/'.$club->id.'/'. $name;

                Storage::disk('local')->put('public/images/clubs/'.$club->id.'/'.$name, $tempImage);
                $tempPath = public_path('images/').$name;
                unlink($tempPath);

                $club->avatar_url = $originalImagePath;
                $club->save();



            }
        }
        catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'error' => $e->errors()
            ], 400);
        }

        return response()->json(['status' => 'success', 'msg' => 'You have successfully changed the image of your club!'], 200);
    }

    protected function editInfo($id, Request $request) {

        $currentY = date('Y');
        $request->validate([
            'name' => 'required',
            'foundation_date' => 'required|numeric|min:1830|max:' . $currentY,
            'about',
            'street' => 'required',
            'zip' => 'required',
            'city' => 'required',
            'country' => 'required',

        ]);

        try {

            $club = Club::find($id);

            $zipCode = ZipCode::where('zip', '=', $request->zip)->first();


                if ($zipCode === null) {

                    $zip = new ZipCode;
                    $zip->zip = $request->zip;
                    $zip->city = $request->city;
                    $zip->save();
                }


                $address = new Address;
                $address->pCode = $request->zip;
                $address->country = $request->country;
                $address->street = $request->street;
                $address->save();

                $last_id = DB::getPDO()->lastInsertId();


                $club->name = $request->name;
                $club->about = $request->about;
                $club->foundation_date = $request->foundation_date;
                $club->address_id = $last_id;
                $club->save();


        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'error' => $e->errors()
            ], 400);

        }

        return response()->json(['status' => 'success', 'msg' => 'You have successfully edited the general information of your club!'], 200);
    }

}
