<?php

namespace Crudly\Connectly;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;

class Connectly extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'config'
    ];

    protected $hidden = [
        'config'
    ];

    /**
     * Encrypts connection config 
     *
     * @var
     */
    public function setConfigAttribute($value) {
    	return encrypt($value);
    }

    /**
     * Decrypts connection config 
     *
     * @var
     */
    public function getConfigAttribute($value) {
        return decrypt($value);
    }

}
