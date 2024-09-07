<?php

namespace Averkov\Cirno\Middleware\Session;

use Averkov\Cirno\DB\DB;
use Averkov\Cirno\Interfaces\ISessionStorage;

class DatabaseStorage implements ISessionStorage {
	private ?DB $db = null;
	public function get(string $key, mixed $default_value = null): mixed {
		// TODO: Implement get() method.
	}

	public function set(string $key, mixed $value): mixed {
		// TODO: Implement set() method.
	}

	public function setConfiguration(array $storage_configuration = []): void {
		// Use the default database by default
		if(!count($storage_configuration)) {
			$cirno = Cirno::getInstance();
			$this->db = $cirno->getDatabaseLink();
		}
	}
}
