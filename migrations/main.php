<?php

$autoloadFiles = [
    __DIR__ . '/vendor/autoload.php',
];
$autoloader = false;
foreach ($autoloadFiles as $autoloadFile) {
    if (file_exists($autoloadFile)) {
        require_once $autoloadFile;
        $autoloader = true;
    }
}
if (!$autoloader) {
    if (extension_loaded('phar') && ($uri = Phar::running())) {
        echo 'The phar has been built without dependencies' . PHP_EOL;
    }
    die('vendor/autoload.php could not be found. Did you run `php composer.phar install`?');
}
