<?php

namespace Flurry;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Flurry\Locality;
use Flurry\AreaCode;

class Customer extends Model
{
    use SoftDeletes;

	/***** 			Accesores			*****/

    public function getAddressAttribute() {
        $address = $this->street." ".$this->street_number;
        return $address;
    }

    public function getFullAddressAttribute() {
        $address = $this->street." ".$this->street_number;
        if ($this->floor)
            $address .= ', piso '.$this->floor;
        if ($this->department)
            $address .= ', dpto. '.$this->department;
        if ($this->between_street_one && $this->between_street_two)
            $address .= ', entre '.$this->between_street_one.' y '.$this->between_street_two;
        return $address;
    }

    public function getFullPhoneAttribute() {
        if ($this->phone)
            return '0'.$this->area_code_phone->code.' '.$this->phone;
        else
            return null;
    }

    public function getFullMobileAttribute() {
        if ($this->mobile)
            return '0'.$this->area_code_mobile->code.' '.$this->mobile;
        else
            return null;
    }

    public function getFullNameAttribute() {
        if (!$this->lastname)
            return $this->name;
        return $this->lastname.", ".$this->name;
    }


    /*****          Propiedades         *****/ 
    protected $appends = [
        'full_name',
        'address',
        'full_address',
        'full_phone',
        'full_mobile',
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected $fillable = [
        'name',
        'lastname',
        'area_code_phone_id',
        'phone',
        'area_code_mobile_id',
        'mobile',
        'email',
        'street',
        'street_number',
        'locality_id',
        'between_street_one',
        'between_street_two',
        'latitude',
        'longitude',
        'floor',
        'department',
        'facebook_nick',
        'instagram_nick',
        'twitter_nick'
    ];


	/***** 			Relaciones			*****/

    public function locality()
    {
        return $this->belongsTo('Flurry\Locality');
    }

    public function area_code_phone()
    {
        return $this->belongsTo('Flurry\AreaCode');
    }

    public function area_code_mobile()
    {
        return $this->belongsTo('Flurry\AreaCode');
    }
}
