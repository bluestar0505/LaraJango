<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Validator;
use Carbon\Carbon;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use What3words\Geocoder\Geocoder;


class APIJangoController extends Controller
{
    public $successStatus = 200;

    public function login(){
        $user = User::where('email', request('email'))->get();
        if (count($user) > 0 ){
            if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
                $user = Auth::user();
                $token = $user->createToken('MyApp')-> accessToken;
                Passport::tokensExpireIn(Carbon::now()->addDays(15));
                $role = $user->roles[0];
                return response()->json(['status' => 'ok', 'token' => $token, 'level'=>$role->level], $this-> successStatus);
            }
            else{
                return response()->json(['status'=>'error', 'message'=>'Your account or password is incorrect.']);
            }
        } else {
            return response()->json(['status'=>'error', 'message'=>'That user doesn\'t exist.']);
        }
    }

    public function register(){
        $err_message = '';
        $user = new User;
        $name = request('name');
        if ($name == null || $name == ''){
            $err_message = 'Name cannot be empty';
        } else {
            $email = request('email');
            if ($email == null || $email == ''){
                $user->email = $email;
                $err_message = 'Email cannot be empty';
            } else {
                $password = request('password');
                if ($password == null || $password == ''){
                    $user->password = $password;
                    $err_message = 'Password cannot be empty';
                } else {
                    $user->name = request('name');
                    $user->email = request('email');
                    $user->password = Hash::make(request('password'));
                    $user->address = request('address');
                    $user->phone = request('phone');
                    $user->idno = request('idno');
                    $user->pin = request('pin');
                    $user->balance = 0;
                    $user->latitude = request('latitude');
                    $user->longitude = request('longitude');
                    $user->save();
                    return response()->json(['status' => 'ok'], $this-> successStatus);
                }
            }
        }
        return response()->json(['status'=>'error', 'message'=>$err_message], 401);
    }

    public function addAddress() {
        $options = [
            'key' => '7IV4EGBO',   // mandatory
            'timeout' => 20             // default: 10 secs
        ];
        $geocoder = new Geocoder($options);
        $params = [
            'lang' => 'en',         // ISO 639-1 2 letter code; default: en
            'display' => 'full',    // full or terse, default: full
            'format' => 'json'      // json, geojson or xml, default: json
        ];
        $coords = [
            'lat' =>  request('lat'),
            'lng' => request('long')
        ];
        $w3w_result = json_decode($geocoder->reverseGeocode($coords, $params));

        $params = [
            'lang' => 'en',         // ISO 639-1 2 letter code; default: en
            'display' => 'full',    // full or terse, default: full
            'format' => 'json'      // json, geojson or xml, default: json
        ];
        $w3w_code = $w3w_result->words;
        $standard_blend = json_decode($geocoder->forwardGeocode($w3w_code, $params));
        $standardblend_code = $standard_blend->words;

        if ($standard_blend->status->status == 200 ) {
            $geomentry = $standard_blend->geometry;
        } else {

        }

        $address = new Address();
        $address->house = request('house');
        $address->street = request('street');
        $address->quarter = request('quarter');
        $address->city = request('city');
        $address->region = request('region');
        $address->country = request('country');
        $address->description = request('location');
        $address->w3w = $standardblend_code;
        $address->lat = $geomentry->lat;
        $address->long = $geomentry->lng;
        $address->activated = 1;

        $address->full = $address->house . ', ' . $address->street . ', ' . $address->quarter . ', ' . $address->city . ', ' . $address->region . ', ' . $address->country;

        $check_exist_result = Address::checkExistSameAddress($address->house, $address->street, $address->quarter, $address->city, $address->region, $address->country, $address->w3w, $address->lat, $address->long);

        if( $check_exist_result ) {
            return response()->json(['status' => 'ok', 'is_exist' => 1, 'id_address' =>$check_exist_result->id], $this-> successStatus);
        } else {
            if( $address->save() ) {
                return response()->json(['status' => 'ok'], $this-> successStatus);
            } else {
                return response()->json(['status' => 'fail'], $this-> successStatus);
            }
        }
        /*$validator = Validator::make($address->toArray(),
            [
                'house'             => 'required|numeric',
                'street'            => 'required|max:255',
                'quarter'           => 'required|max:255',
                'city'              => 'required|max:255',
                'region'            => 'required|max:255',
                'country'           => 'required|max:255',
                'description'       => 'required|max:255',
                'lat'               => 'required|max:255',
                'long'              => 'required|max:255',
            ],
            [

            ]
        );
        if ($validator->fails()) {
            var_dump($validator);exit;
        }
        $address->save();
        $address = Address::create([
            'house'             => $request->input('house'),
            'street'            => $request->input('street'),
            'quarter'           => $request->input('quarter'),
            'city'              => $request->input('city'),
            'region'            => $request->input('region'),
            'country'           => $request->input('country'),
            'description'       => $request->input('description'),
            'w3w'               => 'w3w' ,
            'lat'               => $request->input('lat'),
            'long'              => $request->input('long'),
            'full'              => $full_address,
            'activated'         => 1,
        ]);*/
    }

    public function updateAddress($id) {
        $address = Address::find($id);
        $address->house = request('house');
        $address->street = request('street');
        $address->quarter = request('quarter');
        $address->city = request('city');
        $address->region = request('region');
        $address->country = request('country');
        $address->description = request('location');
        $address->activated = 1;
        if( $address->save() ) {
            return response()->json(['status' => 'ok'], $this-> successStatus);
        } else {
            return response()->json(['status' => 'fail'], $this-> successStatus);
        }
    }

    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this-> successStatus);
    }



    public function logout (Request $request) {

        $token = $request->user()->token();
        $token->revoke();

        $response = 'You have been succesfully logged out!';
        return response($response, 200);

    }
}