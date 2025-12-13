<?php
namespace Src\Model;

require_once __DIR__ . '/../Lib/Database.php';
use Src\Lib\Database;

class Job {
    private $db;

    public function __construct(){
        $this->db = new Database();
        
    }

    // Get All Jobs With Filters
 public function getAll($location = null, $skill = null, $type = null){
    $sql = "SELECT * FROM jobs WHERE 1=1";
    $params = [];

    if ($location) {
        $sql .= " AND location LIKE ?";
        $params[] = "%$location%";
    }

    if ($skill) {
        $sql .= " AND (title LIKE ? OR skills LIKE ? OR description LIKE ?)";
        $params[] = "%$skill%"; // skill for title
        $params[] = "%$skill%"; // skill for skills
        $params[] = "%$skill%"; // skill for description
    }

    if ($type) { 
        $sql .= " AND job_type = ?";
        $params[] = $type;
    }

    $stmt = $this->db->pdo()->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();

    // $skill = "PHP";
    // $location = "Cairo";
    // $type = "Full-time";
    // $sql = "SELECT * FROM jobs WHERE 1=1
    //     AND location LIKE ?
    //     AND (title LIKE ? OR skills LIKE ? OR description LIKE ?)
    //     AND job_type = ?";
    // $params = ["%Cairo%", "%PHP%", "%PHP%", "%PHP%", "Full-time"];



}

    // Get One Job
    public function find($id){
        $stmt = $this->db->pdo()->prepare("SELECT * FROM jobs WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Create
    public function create($data){
        $stmt = $this->db->pdo()->prepare("
            INSERT INTO jobs (title, location, job_type, skills, description, email)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        return $stmt->execute([
            $data['title'],
            $data['location'],
            $data['job_type'] ?? 'Full-time',
            $data['skills'],
            $data['description'],
            $data['email']
        ]);
    }

    // Update
    public function update($id, $data){
        $stmt = $this->db->pdo()->prepare("
            UPDATE jobs
            SET title=?, location=?, job_type=?, skills=?, description=?, email=?
            WHERE id=?
        ");
        return $stmt->execute([
            $data['title'],
            $data['location'],
            $data['job_type'] ?? 'Full-time',
            $data['skills'],
            $data['description'],
            $data['email'],
            $id
        ]);
    }

    // Delete
    public function delete($id){
        $stmt = $this->db->pdo()->prepare("DELETE FROM jobs WHERE id = ?");
        return $stmt->execute([$id]);
    }
}