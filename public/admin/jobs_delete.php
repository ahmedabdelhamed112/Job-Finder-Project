<?php
session_start();


if (!isset($_SESSION['user'])) { 
    header("Location: ../login.php"); 
    exit; 
}

require_once __DIR__ . '/../../src/Model/Job.php';
use Src\Model\Job;

$jobModel = new Job();

$id = $_GET['id'] ?? null;

if (!$id || !is_numeric($id)) {
    die("Invalid ID");
}


$jobModel->delete($id);


$_SESSION['message'] = "Job deleted successfully!";


header("Location: dashboard.php");
exit;


