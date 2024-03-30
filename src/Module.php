<?php

namespace Averkov\Cirno;

abstract class Module extends CirnoObject
{
	// Modules set up routes
	abstract public function setRouteMap();

	public function __construct(Cirno $cirno) {
		parent::__construct($cirno);

		// Configuring route map
		self::setRouteMap();
	}
}
