<?php

namespace Tests\JapaneseDate\Support;

use PHPUnit\Event\Facade;
use PHPUnit\Util\PHP\Job;
use PHPUnit\Util\PHP\JobRunner;
use PHPUnit\Util\PHP\PhpProcessException;
use PHPUnit\Util\PHP\Result;
use SebastianBergmann\Environment\Runtime;
use const PHP_BINARY;
use const PHP_SAPI;

/**
 * phpdbg で PHPUnit の process isolation を実行するための JobRunner。
 */
class PhpdbgJobRunner extends JobRunner
{
    /**
     * @throws PhpProcessException
     */
    public function run(Job $job): Result
    {
        $temporaryFile = tempnam(sys_get_temp_dir(), 'phpunit_');

        if ($temporaryFile === false || file_put_contents($temporaryFile, $job->code()) === false) {
            throw new PhpProcessException('Unable to write temporary file');
        }

        try {
            return $this->runProcess($job, $temporaryFile);
        } finally {
            @unlink($temporaryFile);
        }
    }

    /**
     * @throws PhpProcessException
     */
    private function runProcess(Job $job, string $temporaryFile): Result
    {
        $environmentVariables = null;

        if ($job->hasEnvironmentVariables()) {
            /** @phpstan-ignore nullCoalesce.variable */
            $environmentVariables = $_SERVER ?? [];

            unset($environmentVariables['argv'], $environmentVariables['argc']);

            $environmentVariables = array_merge($environmentVariables, $job->environmentVariables());

            foreach ($environmentVariables as $key => $value) {
                if (is_array($value)) {
                    unset($environmentVariables[$key]);
                }
            }
        }

        $process = proc_open(
            $this->buildCommand($job, $temporaryFile),
            [
                0 => ['pipe', 'r'],
                1 => ['pipe', 'w'],
                2 => $job->redirectErrors() ? ['redirect', 1] : ['pipe', 'w'],
            ],
            $pipes,
            null,
            $environmentVariables,
        );

        if (!is_resource($process)) {
            throw new PhpProcessException('Unable to spawn worker process');
        }

        Facade::emitter()->testRunnerStartedChildProcess();

        fwrite($pipes[0], $job->hasInput() ? $job->input() : '');
        fclose($pipes[0]);

        $stdout = '';
        $stderr = '';

        if (isset($pipes[1])) {
            $stdout = stream_get_contents($pipes[1]);
            fclose($pipes[1]);
        }

        if (isset($pipes[2])) {
            $stderr = stream_get_contents($pipes[2]);
            fclose($pipes[2]);
        }

        proc_close($process);

        return new Result($stdout === false ? '' : $stdout, $stderr === false ? '' : $stderr);
    }

    /**
     * @return non-empty-list<string>
     */
    private function buildCommand(Job $job, string $file): array
    {
        $runtime = new Runtime();
        $phpSettings = $job->phpSettings();

        if ($runtime->hasPCOV()) {
            $pcovSettings = ini_get_all('pcov');

            if ($pcovSettings !== false) {
                $phpSettings = array_merge(
                    $phpSettings,
                    $runtime->getCurrentSettings(array_keys($pcovSettings)),
                );
            }
        } elseif ($runtime->hasXdebug()) {
            $xdebugSettings = ini_get_all('xdebug');

            if ($xdebugSettings !== false) {
                $phpSettings = array_merge(
                    $phpSettings,
                    $runtime->getCurrentSettings(array_keys($xdebugSettings)),
                );
            }
        }

        $command = array_merge([PHP_BINARY], $this->settingsToParameters($phpSettings));

        if (PHP_SAPI === 'phpdbg') {
            $command[] = '-qrr';
        }

        $command[] = '-f';
        $command[] = $file;

        if ($job->hasArguments()) {
            $command[] = '--';

            foreach ($job->arguments() as $argument) {
                $command[] = trim($argument);
            }
        }

        return $command;
    }

    /**
     * @param list<string> $settings
     *
     * @return list<string>
     */
    private function settingsToParameters(array $settings): array
    {
        $parameters = [];

        foreach ($settings as $setting) {
            $parameters[] = '-d';
            $parameters[] = $setting;
        }

        return $parameters;
    }
}
