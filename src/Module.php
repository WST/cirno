<?php

namespace Averkov\Cirno;

abstract class Module extends CirnoObject
{
	private string $instance_name = '';

	/**
	 * @param Cirno $cirno
	 */
	public function __construct(Cirno $cirno) {
		parent::__construct($cirno);
	}

	/**
	 * @param string $instance_name
	 * @return void
	 */
	public function setInstanceName(string $instance_name): string {
		$this->instance_name = $instance_name;
		return $instance_name;
	}

	/**
	 * @return string
	 */
	public function getInstanceName(): string {
		return $this->instance_name;
	}

	/**
	 * Get list of modules that are required to use current one
	 * @return array[string] list of module names
	 */
	public static function depends(): array {
		return [];
	}
}
