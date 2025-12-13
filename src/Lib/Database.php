<?php
namespace Src\Lib;

class Database {
    private static $pdo = null;

    // Associative Array
    public function __construct(){
        if(self::$pdo) return;
        $config = include __DIR__ . '/../../config.php';
        $h = $config['db']['host'];
        $n = $config['db']['name'];
        $u = $config['db']['user'];
        $p = $config['db']['pass'];

        $dsn = "mysql:host=$h;dbname=$n;charset=utf8mb4";
        // mysql:host=127.0.0.1;dbname=job_finder;charset=utf8mb4

        self::$pdo = new \PDO($dsn, $u, $p);
        self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        self::$pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
    }

    public function pdo(){ return self::$pdo; }

    public function query($sql, $params = []){
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
}
