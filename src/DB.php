<?php

namespace Averkov\Cirno;

abstract class DB extends CirnoObject
{
	// Actual database object
	private $link = NULL;

	// Stored configuration
	private $config = NULL;

	public function __construct(array $config) {
		$this->config = $config;
	}

	abstract public function connect();

	public function queryAll($sql) {

	}

	public function queryOne($sql) {

	}

	public function dropTable(string $table_name) {

	}
}
