<?php

namespace Averkov\Cirno;

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
	 */
	public function run() {

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
		
	}
}
