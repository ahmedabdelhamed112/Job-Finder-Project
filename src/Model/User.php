<?php
namespace Src\Model;
require_once __DIR__ . '/../Lib/Database.php';
use Src\Lib\Database;
// $db = new Database();


class User {
    private $db;
    public function __construct(){
        $this->db = new Database();
    }

    public function findByUsername($username){
        $stmt = $this->db->pdo()->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch();
    }

    // create: hashes password before insert
    public function create($username, $password, $is_admin = 0){
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->pdo()->prepare("INSERT INTO users (username,password,is_admin) VALUES (?, ?, ?)");
        return $stmt->execute([$username, $hash, $is_admin]);
    }

    public function resetAdminPassword($newPassword = 'admin123'){
        $hash = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $this->db->pdo()->prepare("UPDATE users SET password=? WHERE username='admin'");
        return $stmt->execute([$hash]);
    }
}
