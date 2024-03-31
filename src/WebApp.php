<?php

namespace Averkov\Cirno;

// We are using Symfony’s HTTP Foundation as the implementation of the HTTP message interface
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Web application
 */
abstract class WebApp
{
	// Cirno instance
	private $cirno = NULL;

	// Application’s route map
	private $routes = [];

	public function __construct() {
		$this->cirno = new Cirno;

		// Configure the deafult routes
		$this->initDefaultRoutes();
	}

	/**
	 * Configure the app’s default route table
	 */
	private function initDefaultRoutes() {
		$this->routes['get']['/'] = [$this, 'defaultRouteHandler'];
	}

	/**
	 * Run the application
	 * TODO: FastCGI / PHP-SGI (uWSGI) mode
	 */
	public function run() {
		$request = Request::createFromGlobals();
		return $this->handleRequest($request);
	}

	/**
	 * Handle a sligle HTTP request
	 */
	private function handleRequest(Request $request) {
		// Any request handling results in creating a response
		$response = new Response('', Response::HTTP_OK, ['content-type' => 'text/html']);
		$response->setCharset('UTF-8');

		// Selecting the handler based on the route map
		$handler = $this->selectHandler($request);

		// Calling the handler
		$result = $handler($request, $response);

		// Sending the response back to the client
		$response->send();

		// We are done
		return $result;
	}

	/**
	 * Route a GET request into a handler
	 */
	public function get() {
		$args = func_get_args();
		$this->routes['get'][$args[0]] =
			(count($args) == 2) ? $args[1] : ((count($args) == 3) ? [$args[1], $args[2]] : [$args[1], $args[2], $args[3]]);
	}
	
	/**
	 * Route a POST request into a handler
	 */
	public function post() {
		$args = func_get_args();
		$this->routes['post'][$args[0]] =
			(count($args) == 2) ? $args[1] : ((count($args) == 3) ? [$args[1], $args[2]] : [$args[1], $args[2], $args[3]]);
	}
	
	public function gp() {
		switch(count($args = func_get_args())) {
			case 2:
				$this->get($args[0], $args[1]);
				$this->post($args[0], $args[1]);
			break;
			case 3:
				$this->get($args[0], $args[1], $args[2]);
				$this->post($args[0], $args[1], $args[2]);
			break;
			case 4:
				$this->get($args[0], $args[1], $args[2], $args[3]);
				$this->post($args[0], $args[1], $args[2], $args[3]);
			break;
		}
	}
	
	private function selectHandler(Request $request) {
		$method = $request->method();
		if(!array_key_exists($method, $this->routes)) {
			throw new CirnoException("Unsupported request method {$method}");
		}
		
		$request_path = $request->getRequestUri();
		if(($pos = strpos($request_path, '?')) !== false) $request_path = substr($request_path, 0, $pos);
		foreach($this->routes[$type] as $k => $v) {
			$pattern = preg_replace(['#(:[a-z_]+?)#iU', '#(%[a-z_]+?)#iU'], ['([^/]+)', '([\\d]+)'], $k);
			$matches = [];
			if(preg_match("#^$pattern$#", $request_path, $matches)) {
				return count($matches) > 1 ? [$v, $matches] : [$v];
			}
		}
		
		throw new CirnoException("no route matching {$request_path}");
	}

	/**
	 * Load a so-called web module — a class that defines a set of URL routes
	 */
	public function loadWebModule(string $module_name): bool {
		// If the class doesn’t exist — we obviously can’t load it
		if(!class_exists($module_name)) return false;

		// Only WebModule children instances are allowed
		if(!is_a($module_name, 'WebModule')) return false;

		// Initializing the module
		$module = new $module_name($this->cirno);
		$routes = $module->getRouteMap();

		// Everything was successful
		return true;
	}

	/**
	 * Handler of the default route
	 */
	private function defaultRouteHandler($request, $response) {
		$response->setContent('Hello, I am Cirno');
	}
}
