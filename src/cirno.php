<?php

namespace Cirno;

class Cirno
{
	// Links with the databases
	private $dbs = [];

	public function __construct() {

	}

	public function connectDatabase(array $config, string $link_name = 'default') {
		$this->dbs[$link_name] = new DB($config);
	}
}
