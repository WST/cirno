<?php

namespace Averkov\Cirno\Middleware\Session;

use Averkov\Cirno\Cirno;
use Averkov\Cirno\Interfaces\ISessionStorage;
use Averkov\Cirno\Middleware;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Session extends Middleware
{
	private ISessionStorage $storage;

	public function __construct(Cirno $cirno) {
		parent::__construct($cirno);
	}

	public function setStorage(ISessionStorage $storage, array $storage_configuration = []) {
		$storage->setConfiguration($storage_configuration);
		$this->storage = $storage;
	}

	public function handleRequest(Request $request, Response $response) {

	}

	public function handleResponse(Request $request, Response $response) {

	}
}
