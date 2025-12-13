<?php
require "src/Lib/Database.php";

use Src\Lib\Database;

$db = new Database();
$conn = $db->pdo();

echo "Connected Successfully!";

// class Test {
//     public static $x = 10;

//     public function show(){
//         echo self::$x;
//     }
// }


// -----------------------------------------

// To set up the project, run the following commands in terminal pls:
// php src/Migrations/migrate.php
//php seeds/seed_admin.php


// open in browser:
// http://localhost/job_finder_full/public


// to see the database, open phpmyadmin and go to job_finder_db
// http://localhost/phpmyadmin



// MVC Model View Controller
// Model
// view
// controller