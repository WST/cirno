<?php

namespace Averkov\Cirno\DB;

use Averkov\Cirno\Cirno;
use Averkov\Cirno\CirnoObject;

abstract class QueryResult extends CirnoObject
{
	// Parent DB object
	private $db = NULL;

	public function __construct(Cirno $cirno, DB $db) {
		$this->db = $config;
		parent::__construct($cirno);
	}

	/**
	 * Get a result row as an instance of $class_name
	 * @param string $class_name class name
	 */
	public function fetchObject(string $class_name): Record|false {

	}

	public function fetchAssoc(): array|false {

	}
}
