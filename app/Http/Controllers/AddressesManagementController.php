<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use What3words\Geocoder\Geocoder;

class AddressesManagementController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $pagintaionEnabled = config('addressesmanagement.enablePagination');

        if ($pagintaionEnabled) {
            $addresses = Address::paginate(config('addressesmanagement.paginateListSize'));
        } else {
            $addresses = Address::all();
        }

        return View('addressesmanagement.show-addresses', compact('addresses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
        ];

        return view('addressesmanagement.create-address')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
            'lat' => $request->input('lat'),
            'lng' => $request->input('long')
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
        $address->description = request('description');
        $address->w3w = $standardblend_code;
        $address->lat = $geomentry->lat;
        $address->long = $geomentry->lng;

        $address->full = $address->house . ', ' . $address->street . ', ' . $address->quarter . ', ' . $address->city . ', ' . $address->region . ', ' . $address->country;
        $is_exist = Address::checkExistSameAddress($address->house, $address->street, $address->quarter, $address->city, $address->region, $address->country, $address->w3w, $address->lat, $address->long);

        $validator = Validator::make($request->all(),
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
                'house.required'        => trans('addressesmanagement.messages.houseRequire'),
                'house.numeric'         => trans('addressesmanagement.messages.houseNumeric'),
                'street.required'       => trans('addressesmanagement.messages.streetRequire'),
                'street.max'            => trans('addressesmanagement.messages.streetMax'),
                'quarter.required'      => trans('addressesmanagement.messages.quarterRequire'),
                'quarter.max'           => trans('addressesmanagement.messages.quarterMax'),
                'city.required'         => trans('addressesmanagement.messages.cityRequire'),
                'city.max'              => trans('addressesmanagement.messages.cityMax'),
                'region.required'       => trans('addressesmanagement.messages.regionRequire'),
                'region.max'            => trans('addressesmanagement.messages.regionMax'),
                'country.required'      => trans('addressesmanagement.messages.countryRequire'),
                'country.max'           => trans('addressesmanagement.messages.countryMax'),
                'description.required'  => trans('addressesmanagement.messages.descriptionRequire'),
                'description.max'       => trans('addressesmanagement.messages.descriptionMax'),
                'lat.required'          => trans('addressesmanagement.messages.latRequire'),
                'lat.max'               => trans('addressesmanagement.messages.latMax'),
                'long.required'         => trans('addressesmanagement.messages.longRequire'),
                'long.max'              => trans('addressesmanagement.messages.longMax'),
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $full_address = $request->input('house') . ', ' . $request->input('street') . ', ' . $request->input('quarter') . ', ' . $request->input('city') . ', ' . $request->input('region') . ', ' . $request->input('country');
        $user = Address::create([
            'house'             => $request->input('house'),
            'street'            => $request->input('street'),
            'quarter'           => $request->input('quarter'),
            'city'              => $request->input('city'),
            'region'            => $request->input('region'),
            'country'           => $request->input('country'),
            'description'       => $request->input('description'),
            'w3w'               => $standardblend_code ,
            'lat'               => $geomentry->lat,
            'long'              => $geomentry->long,
            'full'              => $full_address,
            'activated'         => 1,
        ]);
        $user->save();
        return redirect('addresses')->with('success', trans('addressesmanagement.createSuccess'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $address = Address::find($id);

        return view('addressesmanagement.show-address')->withAddress($address);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $address = Address::findOrFail($id);

        $data = [
            'address'        => $address,
        ];

        return view('addressesmanagement.edit-address')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $address = Address::find($id);
        $validator = Validator::make($request->all(),
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
                'activated'         => 'required',
            ],
            [
                'house.required'        => trans('addressesmanagement.houseRequire'),
                'house.numeric'         => trans('addressesmanagement.houseNumeric'),
                'street.required'       => trans('addressesmanagement.streetRequire'),
                'street.max'            => trans('addressesmanagement.streetMax'),
                'quarter.required'      => trans('addressesmanagement.quarterRequire'),
                'quarter.max'           => trans('addressesmanagement.quarterMax'),
                'city.required'         => trans('addressesmanagement.cityRequire'),
                'city.max'              => trans('addressesmanagement.cityMax'),
                'region.required'       => trans('addressesmanagement.regionRequire'),
                'region.max'            => trans('addressesmanagement.regionMax'),
                'country.required'      => trans('addressesmanagement.countryRequire'),
                'country.max'           => trans('addressesmanagement.countryMax'),
                'description.required'  => trans('addressesmanagement.descriptionRequire'),
                'description.max'       => trans('addressesmanagement.descriptionMax'),
                'lat.required'          => trans('addressesmanagement.latRequire'),
                'lat.max'               => trans('addressesmanagement.latMax'),
                'long.required'         => trans('addressesmanagement.longRequire'),
                'long.max'              => trans('addressesmanagement.longMax'),
                'activated.max'         => trans('addressesmanagement.activatedRequire'),
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $address->house = $request->input('house');
        $address->street = $request->input('street');
        $address->quarter = $request->input('quarter');
        $address->city = $request->input('city');
        $address->region = $request->input('region');
        $address->country = $request->input('country');
        $address->description = $request->input('description');
        $address->full = $request->input('house') . ', ' . $request->input('street') . ', ' . $request->input('quarter') . ', ' . $request->input('city') . ', ' . $request->input('region') . ', ' . $request->input('country');
        $address->activated = $request->input('activated');
        $address->save();
        return back()->with('success', trans('addressesmanagement.updateSuccess'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $address = Address::findOrFail($id);
        $address->delete();
        return redirect('addresses')->with('success', trans('addressesmanagement.deleteSuccess'));
    }

    /**
     * Method to search the users.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $searchTerm = $request->input('address_search_box');
        $searchRules = [
            'address_search_box' => 'required|string|max:255',
        ];
        $searchMessages = [
            'address_search_box.required' => 'Search term is required',
            'address_search_box.string'   => 'Search term has invalid characters',
            'address_search_box.max'      => 'Search term has too many characters - 255 allowed',
        ];

        $validator = Validator::make($request->all(), $searchRules, $searchMessages);

        if ($validator->fails()) {
            return response()->json([
                json_encode($validator),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $results = Address::where('id', 'like', $searchTerm.'%')
                    ->orWhere('house', 'like', $searchTerm.'%')
                    ->orWhere('street', 'like', $searchTerm.'%')
                    ->orWhere('quarter', 'like', $searchTerm.'%')
                    ->orWhere('city', 'like', $searchTerm.'%')
                    ->orWhere('region', 'like', $searchTerm.'%')
                    ->orWhere('country', 'like', $searchTerm.'%')
                    ->orWhere('description', 'like', $searchTerm.'%')
                    ->orWhere('w3w', 'like', $searchTerm.'%')
                    ->orWhere('lat', 'like', $searchTerm.'%')
                    ->orWhere('long', 'like', $searchTerm.'%')
                    ->orWhere('full', 'like', $searchTerm.'%')->get();

        return response()->json([
            json_encode($results),
        ], Response::HTTP_OK);
    }
}
