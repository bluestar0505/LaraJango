<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'addresses';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'house',
        'street',
        'quarter',
        'city',
        'region',
        'country',
        'description',
        'w3w',
        'lat',
        'long',
        'full',
        'activated',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'activated',
    ];

    protected $dates = [
        'deleted_at',
    ];

    public static function checkExistSameAddress($house, $street, $quarter, $city, $region, $country, $w3w, $lat, $long) {
        $is_exist = Address::where('house', $house)
            ->where('street', $street)
            ->where('quarter', $quarter)
            ->where('city', $city)
            ->where('region', $region)
            ->where('country', $country)
            ->where('w3w', $w3w)
            ->where('lat', $lat)
            ->where('long', $long)->exists();
        if($is_exist) {
            return Address::where('house', $house)
                ->where('street', $street)
                ->where('quarter', $quarter)
                ->where('city', $city)
                ->where('region', $region)
                ->where('country', $country)
                ->where('w3w', $w3w)
                ->where('lat', $lat)
                ->where('long', $long)->get()->first();
        } else {
            return false;
        }
    }
}
