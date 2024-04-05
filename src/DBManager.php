<?php

namespace Averkov\Cirno;

/**
 * Database manager is responsible for performing database migrations
 */
class DBManager extends CirnoObject
{
	private $db = NULL;

	public function __construct(DB $db, Console $console) {
		parent::__construct($db->getCirno());
	}

	public function dropTable(string $table) {
		$success = $this->db->dropTable($table);
		$this->console->reportOperation("Dropping table: $table", $success);
	}
}
