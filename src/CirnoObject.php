<?php

namespace Averkov\Cirno;

abstract class CirnoObject
{
	private $cirno = NULL;

	public function __construct(Cirno $cirno) {
		$this->cirno = $cirno;
	}
}
