<?php

namespace Averkov\Cirno;

abstract class DBQueryResult extends CirnoObject
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
	public function fetchObject(string $class_name): DBRecord|false {

	}

	public function fetchAssoc(): array|false {

	}
}
