<?php

namespace Averkov\Cirno\Html;

use Twig\TemplateWrapper;
use \Twig\Loader\FilesystemLoader;
use \Twig\Environment;

class Page {
	private FilesystemLoader $loader;
	private Environment $twig;

	private array $tags = [];

	private TemplateWrapper $template;

	public function __construct(string $template, ?string $directory = null, ?string $cache = NULL) {
		if(is_null($directory)) {
			$directory = CIRNO_ROOT . '/templates';
		}

		// If the cache is not set, we use the system temp dir
		if(is_null($cache)) {
			$cache = sys_get_temp_dir();
		}

		$this->loader = new FilesystemLoader($directory);
		$this->twig = new Environment($this->loader, ['cache' => $cache]);
		$this->template = $this->twig->load($template);
	}

	public function __toString(): string {
		return $this->template->render($this->tags);
	}
}
