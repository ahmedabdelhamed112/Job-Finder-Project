<?php
session_start();


if (!isset($_SESSION['user'])) { 
    header("Location: ../login.php"); 
    exit; 
}

require_once __DIR__ . '/../../src/Model/Job.php';
use Src\Model\Job;

$jobModel = new Job();
$jobs = $jobModel->getAll();
$jobCount = count($jobs);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        
        body { background-color: #f5f6fa;
             font-family: Arial, sans-serif;
             }

        .sidebar {
            width: 250px; 
            height: 100vh; 
            background-color:#2d3436; 
            position:fixed;
            left: 0;
            top: 0;
            padding-top:30px; 
            color: white; 
                }


        .sidebar h3 {
             text-align: center;
              margin-bottom: 20px;
             }


        .sidebar a 
        { 
        display: block;
        padding:14px 20px;
        margin: 5px 10px; 
        color: #dfe6e9;
        text-decoration: none;
        border-radius: 6px;
        transition: 0.3s; 
                }

        .sidebar a:hover
         { background-color: #4CAF50;
            color: #fff;
        }

        .main-content 
        { margin-left: 260px; padding: 25px;
    }

        .topbar { background: #4CAF50;
             padding: 15px 25px;
              border-radius: 10px; 
              color: white;
               margin-bottom: 25px;
             }

        .stats-card { background: #4CAF50;
             border-radius: 10px;
              padding: 20px;
               color: white; 
               box-shadow: 0 3px 8px rgba(0,0,0,0.2);
                transition: 0.3s;
             }

        .stats-card:hover {
             transform: translateY(-3px);
             }


        .table-container { background: white;
             box-shadow: 0 3px 8px rgba(0,0,0,0.15);
              padding: 20px; 
              border-radius: 10px;
             }


        table thead {
             background-color: #4CAF50;
              color: white;
             }


        table tbody tr:hover { 
            background-color: #eef0f1;
             cursor: pointer;
             }

        .action-btn {
             padding: 6px 10px; 
            }

    </style>
</head>
<body>


<div class="sidebar">
    <h3><i class="fas fa-cogs"></i> Admin Panel</h3>
    <a href="dashboard.php"><i class="fas fa-chart-line me-2"></i> Dashboard</a>
    <a href="jobs_create.php"><i class="fas fa-plus me-2"></i> Add Job</a>
    <a href="../logout.php"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
</div>


<div class="main-content">
    
    <div class="topbar">
        <h2><i class="fas fa-briefcase"></i> Jobs Management</h2>
    </div>

    
  <?php if(isset($_SESSION['message'])): ?>
<div class="alert alert-success alert-dismissible fade show" role="alert"
     style="
       position: fixed;
        bottom: 25px; 
        right: 25px; 
        z-index: 1050;
        min-width: 300px;
        max-width: 400px;
        text-align: right; 
        box-shadow: 0 3px 15px rgba(0,0,0,0.3);
     ">
    <?= $_SESSION['message']; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php unset($_SESSION['message']); ?>
<?php endif; ?>

   
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="stats-card">
                <h5>Total Jobs</h5>
                <h2><i class="fas fa-bullhorn"></i> <?= $jobCount ?></h2>
            </div>
        </div>
    </div>

    <div class="table-container">
        <h4 class="mb-3">Job Listings</h4>

        <table class="table table-striped table-hover align-middle">
            <thead>
                <tr>
                    <th>Job Title</th>
                    <th>Location</th>
                    <th>Skills</th>
                    <th>Email</th>
                    <th style="width: 120px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($jobCount > 0): ?>
                    <?php foreach($jobs as $job): ?>
                    <tr>
                        <td><strong><?= htmlspecialchars($job['title']) ?></strong></td>
                        <td><?= htmlspecialchars($job['location']) ?></td>
                        <td><?= htmlspecialchars($job['skills']) ?></td>
                        <td>
                            <a href="mailto:<?= htmlspecialchars($job['email']) ?>">
                                <?= htmlspecialchars($job['email']) ?>
                            </a>
                        </td>
                        <td>
                            <a href="jobs_edit.php?id=<?= $job['id'] ?>" class="btn btn-sm btn-primary action-btn">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-sm btn-danger action-btn" 
                                    onclick="openDeleteModal(<?= $job['id'] ?>);">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center text-muted">No jobs found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>


<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered"> 
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <p>Are you sure you want to delete this job?</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <a id="confirmDeleteBtn" href="#" class="btn btn-danger">Yes, Delete</a>
            </div>

        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>

function openDeleteModal(id) {
    let deleteBtn = document.getElementById('confirmDeleteBtn');
    deleteBtn.href = "jobs_delete.php?id=" + id;

    let modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}


setTimeout(function() {
    var alert = document.querySelector('.alert');
    if(alert){
        var bsAlert = new bootstrap.Alert(alert);
        bsAlert.close();
    }
}, 3000);
</script>

</body>
</html>
