#!/usr/bin/env php
<?php
$command = $argv[1] ?? null;

function help(): void {
    $COLOR_RESET = "\033[0m";
    $COLOR_GREEN = "\033[32m";

    echo "Usage: php mt <command>\n";
    echo "Commands:\n";
    echo "  $COLOR_GREEN start $COLOR_RESET            : Start the server\n";
    echo "  $COLOR_GREEN migrate $COLOR_RESET          : Run the migrations\n";
    echo "  $COLOR_GREEN migrate:rollback $COLOR_RESET : Rollback the last migration\n";
}

switch ($command) {
    case 'start':
        shell_exec('php -S localhost:8000 -t public');
        break;
    case 'migrate':
        shell_exec('cd database && php migration.php && cd ..');
        break;
    case 'migrate:rollback':
        shell_exec('cd database && php migration_rollback.php && cd ..');
        break;
    case 'help':
        help();
        break;
    default:
        echo "Command not found: $command\n";
        help();
        break;
}