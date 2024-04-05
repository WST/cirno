<?php

namespace Averkov\Cirno;

/**
 * Implements console input & output
 */
class Console extends CirnoObject
{
	public function __construct(Cirno $cirno) {
		parent::__construct($cirno);
	}

	public function reportOperation(string $message, bool $success = true) {

	}
}