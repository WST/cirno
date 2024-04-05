<?php

namespace Averkov\Cirno;

/**
 * A database table record
 */
class DBRecord extends CirnoObject implements ArrayAccess
{
	private $row = false;

	public function __construct(Cirno $cirno, string $table_name = '', $row = []) {
	}

	public function offsetExists(mixed $offset): bool {
		return is_array($this->row) && isset($this->row[$offset]);
	}

	public function offsetGet(mixed $offset): mixed {

	}

	public function offsetSet(mixed $offset, mixed $value): void {

	}

	public function offsetUnset(mixed $offset): void {

	}
}
