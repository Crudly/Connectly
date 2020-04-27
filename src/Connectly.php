<?php

namespace Crudly\Connectly;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\MySqlConnection;

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

    public $config = [
        'driver'    => '',
        'host'      => '',
        'port'      => '',
        'database'  => '',
        'username'  => '',
        'password'  => '',
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

    /**
     * Creates connection
     *
     * @return Illuminate\Database\MySqlConnection
     */
    public function connect() {
        return new MySqlConnection($this->config);
    }

    /**
     * Get an option from the configuration options.
     *
     * @param  string|null  $option
     * @return mixed
     */
    public function getConfigKeyValue($option = null)
    {
        return \Arr::get($this->config, $option);
    }

    /**
     * Get the driver name.
     *
     * @return string
     */
    public function getDriverName()
    {
        return $this->getConfigKeyValue('driver');
    }

    /**
     * Get the database name.
     *
     * @return string
     */
    public function getDatabaseName()
    {
        return $this->getConfigKeyValue('database');
    }

    /**
     * Get the database name.
     *
     * @return string
     */
    public function getConfig()
    {
        return $this->config;
    }
}
