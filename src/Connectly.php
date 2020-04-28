<?php

namespace Crudly\Connectly;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Connectors\ConnectionFactory;

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
        $this->attributes['config'] = encrypt($value);
    }

    /**
     * Decrypts connection config 
     *
     * @var
     */
    public function getConfigAttribute($value) {
        return decrypt($value);
    }

    /**
     * Establish a PDO connection based on the configuration.
     *
     * @return \Illuminate\Database\Connection
     */
    public function connect() {
        $connection = resolve(ConnectionFactory::class);

        return $connection->make($this->config);
    }
}
