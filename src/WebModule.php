<?php

namespace Averkov\Cirno;

abstract class WebModule extends CirnoObject
{
	// Modules set up routes
	abstract public function getRouteMap();

	public function __construct(Cirno $cirno) {
		parent::__construct($cirno);
	}
}
