<?php
$finder = Symfony\CS\Finder\DefaultFinder::create()
->exclude('help-docs')
->exclude('languages')
->exclude('assets')
->in(__DIR__); 

return Symfony\CS\Config\Config::create()
->fixers(
		array(
			'encoding',
			'linefeed',
			'trailing_spaces',
			'short_tag',
			'php_closing_tag',
			'extra_empty_lines',
			'function_declaration',
			'controls_spaces',
			'standardize_not_equal'
			)
)
->finder($finder);