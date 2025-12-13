<?php
require __DIR__ . '/../../config.php';
require __DIR__ . '/../Lib/Database.php';
use Src\Lib\Database;

$db = new Database();

require __DIR__ . '/CreateUsersTable.php';
require __DIR__ . '/CreateJobsTable.php';

$migrations = [
    new CreateUsersTable(),
    new CreateJobsTable()
];

foreach ($migrations as $m) {
    $m->up($db);
}

echo "Migrations done\n";
