<?php

namespace Averkov\Cirno;

class SQLite extends DB
{
	public function connect() {
		if(!is_null($this->link)) {
			return true;
		}

		$this->link = new PDO("sqlite:test.db");
	}

	public function quote(string $str): string {
		return $this->link->quote($str);
	}
}
