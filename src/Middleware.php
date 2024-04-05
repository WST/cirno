<?php

namespace Averkov\Cirno;

// We are using Symfony’s HTTP Foundation as the implementation of the HTTP message interface
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware is a request handler that does some pre- or post-processing job (i.e session handling or caching)
 * TODO: consider PSR-15
 */
abstract class Middleware extends CirnoObject
{
	/**
	 * Called before the handler
	 */
	abstract public function handleRequest(Request $request, Response $response);

	/**
	 * Called after the handler
	 */
	abstract public function handleResponse(Request $request, Response $response);
}
