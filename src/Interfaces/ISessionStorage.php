<?php

namespace Averkov\Cirno\Interfaces;

interface ISessionStorage {
	public function set(string $key, mixed $value): mixed;

	public function get(string $key, mixed $default_value = null): mixed;

	public function setConfiguration(array $storage_configuration = []): void;
}
