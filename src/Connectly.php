<?php

namespace Crudly\Connectly;

use Illuminate\Support\Facades\Crypt;
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

    public $config = [ ];

    protected $sampleConfig = [
        'driver'    => '',
        'host'      => '',
        'port'      => '',
        'database'  => 'connectly_test_base',
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
        $connection = new ConnectionFactory(app());

        return $connection->make(array_merge($this->sampleConfig, $this->config));
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
     * Get the connection config.
     *
     * @return string
     */
    public function getConfig()
    {
        return $this->config;
    }
}
