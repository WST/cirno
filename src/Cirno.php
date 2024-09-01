<?php

namespace Averkov\Cirno;

use Averkov\Cirno\DB\DB;
use Averkov\Cirno\DB\SQLite;

define('CIRNO_ROOT', __DIR__);

class Cirno
{
	// Links with the databases
	private array $dbs = [];

	private array $modules = [];

	public function __construct() {

	}

	/**
	 * Connect to an SQL database server (MySQL or PostgreSQL)
	 * @param array $config database configuration
	 * @param string $link_name link name
	 */
	public function connectDatabase(array $config, string $link_name = 'default'): DB {
		$driver = $config['DRIVER'];
		unset($config['DRIVER']);
		if(!is_a($driver, 'DB')) throw new CirnoException("Wrong database driver: $driver");
		$link = new $driver($config);
		$this->dbs[$link_name] = $link;
		return $link;
	}

	/**
	 * Open a SQLite database
	 * @param string $filename database file name
	 * @param string $link_name link name
	 */
	public function openDatabase(string $filename, string $link_name = 'default'): DB {
		$config = [
			'FILENAME' => $filename,
		];
		$link = new SQLite($config);
		$this->dbs[$link_name] = $link;
		return $link;
	}

	public function loadModule(string $module_name, $instance_name = null): bool {
		if(is_null($instance_name)) {
			$instance_name = $module_name;
		}
		$module = new $module_name;
		$module->setInstanceName($instance_name);
		$this->modules[$instance_name] = $module;
		return true;
	}
}
