<?php

namespace Averkov\Cirno\Html;

use Averkov\Cirno\Cirno;
use Averkov\Cirno\Module;

class TemplateDirectory extends Module {
	private $directory = '';

	public function __construct(Cirno $cirno, string $directory) {
		parent::__construct($cirno);
		$this->directory = $directory;
	}

	public function openTemplate($filename): Template {

	}
}
