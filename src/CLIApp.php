<?php

namespace Averkov\Cirno;

/**
 * Command-line application
 */
abstract class CLIApp
{
	private ?Cirno $cirno = null;
	public function __construct() {
		$this->cirno = Cirno::getInstance();
	}

	public function run(): int {
		return 0;
	}
}
