<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Auth;
use Illuminate\Http\Request;

class AddressSoftDeletesController extends Controller
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
     * Get Soft Deleted User.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public static function getDeletedAddress($id)
    {
        $user = Address::onlyTrashed()->where('id', $id)->get();
        if (count($user) != 1) {
            return redirect('/addresses/deleted/')->with('error', trans('addressesmanagement.errorAddressNotFound'));
        }

        return $user[0];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $addresses = Address::onlyTrashed()->get();

        return View('addressesmanagement.show-deleted-addresses', compact('addresses'));
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
        $address = self::getDeletedAddress($id);

        return view('addressesmanagement.show-deleted-address')->withAddress($address);
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
        $address = self::getDeletedAddress($id);
        $address->restore();

        return redirect('/addresses/')->with('success', trans('addressesmanagement.successRestore'));
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
        $user = self::getDeletedAddress($id);
        $user->forceDelete();

        return redirect('/addresses/deleted/')->with('success', trans('addressesmanagement.successDestroy'));
    }
}
