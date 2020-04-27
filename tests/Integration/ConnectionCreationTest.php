<?php

namespace Crudly\Connectly\Tests\Integration;

use Crudly\Connectly\Connectly;
use Crudly\Connectly\Tests\TestCase;

use Illuminate\Database\MySqlConnection;

class ConnectionCreationTest extends TestCase
{
	protected $config;

    protected function setUp(): void
    {
        parent::setUp();

		$this->mysql = [
			'driver' => 'mysql',
			'host' => '127.0.0.1',
			'port' => '3306',
			'database' => 'connectly_test_base',
			'username' => 'connectly_user',
			'password' => 'hunter2',
		];
	}
	
    /**
     * Create a MySQL connection from config.
     *
     * @return void
     */
    public function testMysqlFromConfig()
    {
		$connectly = new Connectly;

		$connectly->config = $this->mysql;

		$connection = $connectly->connect();

        $this->assertInstanceOf(MySqlConnection::class, $connection);
        $this->assertSame('mysql', $connectly->getDriverName());
		$this->assertSame('connectly_test_base', $connectly->getDatabaseName());
		
		$config = $connectly->getConfig();

		foreach ($this->mysql as $key => $value)
		{
			$this->assertArrayHasKey($key, $config);
			$this->assertSame($value, $config[$key]);
		}
    }
}