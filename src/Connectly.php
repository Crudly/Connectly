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
        'credentials'
    ];

    /**
     * Encrypts credtials ..
     *
     * @var string
     */
    public function storeCredentials(String $credentials) {
    	return Crypt::encryptString($credentials);
    }

}
