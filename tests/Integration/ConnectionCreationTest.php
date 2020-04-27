<?php

namespace Crudly\Connectly\Tests\Integration;

use Crudly\Connectly\Connectly;
use Crudly\Connectly\Tests\TestCase;

use Illuminate\Database\MySqlConnection;
use Illuminate\Database\PostgresConnection;
use Illuminate\Database\SqlServerConnection;
use Illuminate\Database\SQLiteConnection;

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

		$this->pgsql = [
			'driver' => 'pgsql',
			'host' => '127.0.0.1',
			'port' => '3306',
			'database' => 'connectly_test_base',
			'username' => 'connectly_user',
			'password' => 'hunter2',
		];

		$this->sqlsrv = [
			'driver' => 'sqlsrv',
			'host' => '127.0.0.1',
			'port' => '3306',
			'database' => 'connectly_test_base',
			'username' => 'connectly_user',
			'password' => 'hunter2',
		];

		$this->sqlite = [
			'driver' => 'sqlite',
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
        $this->assertSame('mysql', $connection->getDriverName());
		$this->assertSame('connectly_test_base', $connection->getDatabaseName());
		
		$config = $connection->getConfig();

		foreach ($this->mysql as $key => $value)
		{
			$this->assertArrayHasKey($key, $config);
			$this->assertSame($value, $config[$key]);
		}
    }
	
    /**
     * Create a PostgreSQL connection from config.
     *
     * @return void
     */
    public function testPostgresFromConfig()
    {
		$connectly = new Connectly;

		$connectly->config = $this->pgsql;

		$connection = $connectly->connect();

        $this->assertInstanceOf(PostgresConnection::class, $connection);
        $this->assertSame('pgsql', $connection->getDriverName());
		$this->assertSame('connectly_test_base', $connection->getDatabaseName());
		
		$config = $connection->getConfig();

		foreach ($this->pgsql as $key => $value)
		{
			$this->assertArrayHasKey($key, $config);
			$this->assertSame($value, $config[$key]);
		}
    }
	
    /**
     * Create a MS SQL Server connection from config.
     *
     * @return void
     */
    public function testSqlServerFromConfig()
    {
		$connectly = new Connectly;

		$connectly->config = $this->sqlsrv;

		$connection = $connectly->connect();

        $this->assertInstanceOf(SqlServerConnection::class, $connection);
        $this->assertSame('sqlsrv', $connection->getDriverName());
		$this->assertSame('connectly_test_base', $connection->getDatabaseName());
		
		$config = $connection->getConfig();

		foreach ($this->sqlsrv as $key => $value)
		{
			$this->assertArrayHasKey($key, $config);
			$this->assertSame($value, $config[$key]);
		}
    }
	
    /**
     * Create a SQLite connection from config.
     *
     * @return void
     */
    public function testSQLiteFromConfig()
    {
		$connectly = new Connectly;

		$connectly->config = $this->sqlite;

		$connection = $connectly->connect();

        $this->assertInstanceOf(SQLiteConnection::class, $connection);
        $this->assertSame('sqlite', $connection->getDriverName());
		$this->assertSame('connectly_test_base', $connection->getDatabaseName());
		
		$config = $connection->getConfig();

		foreach ($this->sqlite as $key => $value)
		{
			$this->assertArrayHasKey($key, $config);
			$this->assertSame($value, $config[$key]);
		}
    }
}