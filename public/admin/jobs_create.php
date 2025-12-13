<?php
session_start();

if(!isset($_SESSION['user'])) { 
    header("Location: ../login.php"); 
    exit; 
}

require_once __DIR__ . '/../../src/Model/Job.php';
use Src\Model\Job;

$jobModel = new Job();
$errors = [];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    
    if (empty($_POST['title']) || empty($_POST['email']) || empty($_POST['description'])) {
        $errors[] = "Job Title, Description, and Email are required.";
    }

    if (empty($errors)) {
      
        $jobModel->create([
            'title' => $_POST['title'],
            'location' => $_POST['location'],
            'job_type' => $_POST['job_type'],
            'skills' => $_POST['skills'],
            'description' => $_POST['description'],
            'email' => $_POST['email']
        ]);
        
        
        $_SESSION['message'] = "Job created successfully!";
        header("Location: dashboard.php");
        exit;
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Job</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
       
        body { background-color: #f5f6fa; font-family: Arial, sans-serif; }
        .sidebar { width: 250px; height: 100vh; background-color: #2d3436; position: fixed; left: 0; top: 0; padding-top: 30px; color: white; }
        .sidebar h3 { text-align: center; margin-bottom: 20px; }
        .sidebar a { display: block; padding: 14px 20px; margin: 5px 10px; color: #dfe6e9; text-decoration: none; border-radius: 6px; transition: 0.3s; }
        .sidebar a:hover { background-color: #4CAF50; color: #fff; }
        .main-content { margin-left: 260px; padding: 25px; }
        .topbar { background: #4CAF50; padding: 15px 25px; border-radius: 10px; color: white; margin-bottom: 25px; }
        .form-container { background: white; box-shadow: 0 3px 8px rgba(0,0,0,0.15); padding: 30px; border-radius: 10px; }
    </style>
</head>
<body>

<div class="sidebar">
    <h3><i class="fas fa-cogs"></i> Admin Panel</h3>
    <a href="dashboard.php"><i class="fas fa-chart-line me-2"></i> Dashboard</a>
    <a href="jobs_create.php" style="background-color: #4CAF50; color: #fff;"><i class="fas fa-plus me-2"></i> Add Job</a> 
    <a href="../logout.php"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
</div>

<div class="main-content">
    
    <div class="topbar">
        <h2><i class="fas fa-plus-circle"></i> Create New Job Listing</h2>
    </div>

    <?php if(!empty($errors)): ?>
        <div class="alert alert-danger mb-4" role="alert">
            <?php foreach($errors as $error): ?>
                <?= htmlspecialchars($error) ?><br>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="form-container">
        <form method="POST">
            
            <div class="mb-3">
                <label for="title" class="form-label">Job Title <span class="text-danger">*</span></label>
                <input name="title" id="title" class="form-control" placeholder="e.g., Senior Software Engineer" required value="<?= htmlspecialchars($_POST['title'] ?? '') ?>">
            </div>
            
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input name="location" id="location" class="form-control" placeholder="e.g., Remote or New York" value="<?= htmlspecialchars($_POST['location'] ?? '') ?>">
            </div>
            
            <div class="mb-3">
                <label for="job_type" class="form-label">Job Type</label>
                <select name="job_type" id="job_type" class="form-control">
                    <option value="Full-time" <?= (($_POST['job_type'] ?? '') == 'Full-time') ? 'selected' : '' ?>>Full-time</option>
                    <option value="Part-time" <?= (($_POST['job_type'] ?? '') == 'Part-time') ? 'selected' : '' ?>>Part-time</option>
                    <option value="Internship" <?= (($_POST['job_type'] ?? '') == 'Internship') ? 'selected' : '' ?>>Internship</option>
                    <option value="Remote" <?= (($_POST['job_type'] ?? '') == 'Remote') ? 'selected' : '' ?>>Remote</option>
                </select>
            </div>
            
            <div class="mb-3">
                <label for="skills" class="form-label">Required Skills</label>
                <input name="skills" id="skills" class="form-control" placeholder="e.g., PHP, MySQL, JavaScript (Comma Separated)" value="<?= htmlspecialchars($_POST['skills'] ?? '') ?>">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email for Applications <span class="text-danger">*</span></label>
                <input name="email" id="email" class="form-control" placeholder="Contact Email" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Job Description <span class="text-danger">*</span></label>
                <textarea name="description" id="description" class="form-control" rows="8" placeholder="Enter detailed job description..." required><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>
            </div>

            <button type="submit" class="btn btn-success btn-lg"><i class="fas fa-save me-2"></i> Create Job Listing</button>
            <a href="dashboard.php" class="btn btn-link mt-3 text-secondary">&larr; Back to Dashboard</a>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>