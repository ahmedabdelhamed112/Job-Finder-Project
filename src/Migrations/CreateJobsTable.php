<?php
class CreateJobsTable {
    public function up(\Src\Lib\Database $db){
        $sql = "CREATE TABLE IF NOT EXISTS jobs (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            location VARCHAR(255) DEFAULT NULL,
            job_type VARCHAR(100) DEFAULT 'Full-time',
            skills TEXT DEFAULT NULL,
            description TEXT DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        $db->query($sql);
    }
}
