<?php

/**
 * Global APCu mock functions for testing.
 * Included only inside #[RunInSeparateProcess] tests so they do not leak into other processes.
 */
if (!function_exists('apcu_fetch')) {
    function apcu_fetch(string $key, bool &$success = false): mixed
    {
        $success = isset($GLOBALS['_test_apcu_store'][$key]);

        return $success ? $GLOBALS['_test_apcu_store'][$key] : false;
    }
}

if (!function_exists('apcu_add')) {
    function apcu_add(string $key, mixed $value, int $ttl = 0): bool
    {
        $GLOBALS['_test_apcu_store'][$key] = $value;

        return true;
    }
}
