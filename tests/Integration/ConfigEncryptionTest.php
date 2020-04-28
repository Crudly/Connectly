<?php

namespace Crudly\Connectly\Tests\Integration;

use Crudly\Connectly\Connectly;
use Crudly\Connectly\Tests\TestCase;

class ConfigEncryptionTest extends TestCase
{
	protected $connectly;
	protected $config;
	protected $encrypted;

    protected function setUp(): void
    {
        parent::setUp();

		$this->connectly = new Connectly;

		$this->config = [
			'driver' => 'drvr',
			'host' => '127.0.0.1',
			'port' => '3306',
			'database' => 'connectly_test_base',
			'username' => 'connectly_user',
			'password' => 'hunter2',
		];

		$this->encrypted = encrypt($this->config);
	}
	
    /**
     * Config encryption.
     *
     * @return void
     */
    public function testEncryption()
    {
		$this->connectly->config = $this->config;
		
		$encryptedConfig = $this->connectly->getAttributes()['config'];

		$this->assertIsString($encryptedConfig);
		$this->assertNotSame($this->config, $encryptedConfig);
		$this->assertSame($this->config, decrypt($encryptedConfig));
    }

    /**
     * Config decryption.
     *
     * @return void
     */
    public function testGetter()
    {
		$this->connectly->setRawAttributes(['config' => $this->encrypted]);
		$get = $this->connectly->config;
		$this->assertSame($this->config, $get);
    }
}