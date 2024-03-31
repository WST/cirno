<?php

namespace Averkov\Cirno;

abstract class Module extends CirnoObject
{
	public function __construct(Cirno $cirno) {
		parent::__construct($cirno);
	}

	/**
	 * Get list of modules that are required to use current one
	 * @return array[string] list of module names
	 */
	public static function depends(): array {
		return [];
	}
}
