<?php

namespace Crudly\Connectly;

use Crudly\Encrypted\Encrypted;
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
        'config',
		'name',
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
     * Make config encrypted.
     *
     * @var array
     */
    protected $casts = [
        'config' => Encrypted::class,
    ];

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
