<?php

namespace Averkov\Cirno;

class Cirno
{
	// Links with the databases
	private $dbs = [];

	public function __construct() {

	}

	/**
	 * Connect to an SQL database server (MySQL or PostgreSQL)
	 */
	public function connectDatabase(array $config, string $link_name = 'default') {
		$this->dbs[$link_name] = new DB($config);
	}

	/**
	 * Open a SQLite database
	 */
	public function openDatabase(string $filename, string $link_name = 'default') {

	}

	public function loadModule(string $module_name) {
		
	}
}
