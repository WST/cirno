<?php

namespace Averkov\Cirno;

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
