<?php
function loadEnv($envFilePath)
{
    if (!file_exists($envFilePath)) {
        return false;
    }

    $envContent = file_get_contents($envFilePath);

    $lines = explode("\n", $envContent);

    foreach ($lines as $line) {
        if (empty($line) || $line[0] === '#') {
            continue;
        }

        list($key, $value) = explode('=', $line, 2);

        $value = trim($value);
        $value = trim($value, '"');
        $value = trim($value, "'");

        putenv("$key=$value");

        $_ENV[$key] = $value;
    }

    return true;
}

$envFilePath = '.env';
loadEnv($envFilePath);