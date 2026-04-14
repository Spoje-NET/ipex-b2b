<?php
/**
 * Debian autoloader for php-spojenet-ipex-b2b
 */

// Load dependency autoloaders
require_once '/usr/share/php/Ease/autoload.php';

// PSR-4 autoloader for this package's classes.
spl_autoload_register(function (string $class): void {
    $prefixes = [
        'IPEXB2B\\' => '/usr/share/php/IPEXB2B/',
    ];
    foreach ($prefixes as $prefix => $baseDir) {
        $len = strlen($prefix);
        if (strncmp($prefix, $class, $len) !== 0) {
            continue;
        }
        $relativeClass = substr($class, $len);
        $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';
        if (file_exists($file)) {
            require $file;
            return;
        }
    }
});
