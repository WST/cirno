<?php

namespace Cirno;

class DB extends CirnoObject
{
	// Actual database object
	private $link = NULL;

	// Stored configuration
	private $config = NULL;

	public function __construct(array $config) {
		$this->config = $config;
	}

	public function connect() {
		if(!is_null($this->link)) {
			return true;
		}

		$this->link = new PDO();
	}
}
