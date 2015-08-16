<?php

error_reporting(E_ALL & E_STRICT);

$autoload_path = NULL;

// Handling autoloading for different use cases.
// @see https://github.com/sebastianbergmann/phpunit/blob/master/phpunit
foreach (array(__DIR__ . '/../../autoload.php', __DIR__ . '/../vendor/autoload.php', __DIR__ . '/vendor/autoload.php') as $file) {
  if (file_exists($file)) {
    $autoload_path = $file;
    break;
  }
}

unset($file);

// Provide warning, when no autoloader was found.
if (!isset($autoload_path)) {
  fwrite(STDERR,
    'You need to set up the project dependencies using the following commands:' . PHP_EOL .
    'wget http://getcomposer.org/composer.phar' . PHP_EOL .
    'php composer.phar install' . PHP_EOL
  );
  die(1);
}

require $autoload_path;

unset($autoload_path);
