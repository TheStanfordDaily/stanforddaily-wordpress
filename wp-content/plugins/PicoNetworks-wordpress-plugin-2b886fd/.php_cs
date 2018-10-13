<?php
	// Usage: https://github.com/FriendsOfPHP/PHP-CS-Fixer#usage
	$header = <<<'EOF'
	This file is part of PHP CS Fixer.
	(c) Fabien Potencier <fabien@symfony.com>
	    Dariusz Rumiński <dariusz.ruminski@gmail.com>
	This source file is subject to the MIT license that is bundled
	with this source code in the file LICENSE.
	EOF;
	return PhpCsFixer\Config::create()
		->setRiskyAllowed(true)
		->setRules(array(
			'braces' => array('position_after_functions_and_oop_constructs' => 'same')
    ))
    ->setFinder(
			PhpCsFixer\Finder::create()
				->exclude('tests/Fixtures')
				->in(__DIR__)
				);
