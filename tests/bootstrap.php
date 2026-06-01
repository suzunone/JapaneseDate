<?php

require_once __DIR__ . '/../vendor/autoload.php';

if (PHP_SAPI === 'phpdbg') {
    PHPUnit\Util\PHP\JobRunnerRegistry::set(
        new Tests\JapaneseDate\Support\PhpdbgJobRunner(
            new PHPUnit\Framework\ChildProcessResultProcessor(
                PHPUnit\Event\Facade::instance(),
                PHPUnit\Event\Facade::emitter(),
                PHPUnit\TestRunner\TestResult\PassedTests::instance(),
                PHPUnit\Runner\CodeCoverage::instance(),
            ),
        ),
    );
}

Tests\JapaneseDate\Support\ProcessLimiter::installForPhpUnitIsolation();
