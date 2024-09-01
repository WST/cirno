<?php

namespace Averkov\Cirno\DB;

use Averkov\Cirno\CirnoObject;
use Averkov\Cirno\Console;

/**
 * Database manager is responsible for performing database migrations
 */
class Manager extends CirnoObject
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
