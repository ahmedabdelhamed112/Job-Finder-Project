<?php
require __DIR__ . '/../src/Lib/Database.php';
require __DIR__ . '/../src/Model/User.php';
use Src\Model\User;
$user = new User();
$username = 'admin';
$password = 'admin123';
$hash = password_hash($password, PASSWORD_DEFAULT);
try{
    $user->create($username,$hash,1);
    echo "Admin created: {$username} / {$password}\n";
}catch(Exception $e){
    echo "Could not create admin (maybe exists): " . $e->getMessage() . "\n";
}
