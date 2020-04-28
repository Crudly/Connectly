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

    /**
     * The attributes that hidden from JSON serialization.
     *
     * @var array
     */
    protected $hidden = [
        'config'
    ];

    /**
     * Encrypts connection config
     *
     * @param  array  $value
     * @return void
     */
    public function setConfigAttribute($value) {
        $this->attributes['config'] = encrypt($value);
    }

    /**
     * Decrypts connection config
     *
     * @param  string  $value
     * @return array
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
