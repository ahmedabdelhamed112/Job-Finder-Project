<?php
require_once __DIR__ . '/../src/Model/Job.php';
use Src\Model\Job;

// Get job id
$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: home.php");
    exit;
}

// Fetch job from database
$jobModel = new Job();
$job = $jobModel->find($id);
if (!$job) die("Job not found");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($job['title']) ?></title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f4f4;
        }

        .head {
            background-color: #4CAF50;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .head h1 {
            margin: 0;
        }

        nav ul {
            margin: 0;
            padding: 0;
            list-style: none;
            display: flex;
            gap: 25px;
        }

        nav ul li a {
            text-decoration: none;
            color: white;
            padding: 8px 15px;
            border-radius: 4px;
            transition: 0.3s;
            font-weight: bold;
        }

        nav ul li a:hover {
            background: #388E3C;
        }

        /* Job box */
        .job-box {
            max-width: 700px;
            margin: 75px auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 0 18px rgba(0,0,0,0.15);
        }

        .skill-badge {
            background: #eaeaea;
            padding: 5px 12px;
            border-radius: 6px;
            display: inline-block;
            margin-right: 5px;
            margin-bottom: 5px;
        }

        .back-btn {
            display: inline-block;
            margin: 25px auto;
            padding: 10px 15px;
            background: #ddd;
            border-radius: 6px;
            text-decoration: none;
            color: black;
            font-weight: bold;
        }

        .back-btn:hover {
            background: #ccc;
        }
    </style>

</head>

<body>

<div class="head">
    <h1>Job Finder</h1>
    <nav>
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="About.php">About</a></li>
            <li><a href="content.php">Content</a></li>
            <li><a href="login.php">Login</a></li>
         
        </ul>
    </nav>
</div>


<!-- JOB DETAILS -->
<div class="job-box">

    <h2><?= htmlspecialchars($job['title']) ?></h2>

    <p><strong>📍 Location:</strong> <?= htmlspecialchars($job['location']) ?></p>

    <p><strong>💼 Job Type:</strong> <?= htmlspecialchars($job['job_type']) ?></p>

    <h3>Required Skills:</h3>
    <div>
        <?php 
            $skills = explode(",", $job['skills']);
            foreach ($skills as $s): ?>
                <span class="skill-badge"><?= htmlspecialchars(trim($s)) ?></span>
        <?php endforeach; ?>
    </div>

    <hr>

    <h3>Description</h3>
    <p><?= nl2br(htmlspecialchars($job['description'])) ?></p>
        <!-- nl2br => new line to <br> -->
    <hr>

    <?php
    $recipient = htmlspecialchars($job['email']);
    $subject = urlencode("Application for: " . $job['title'] . " position");
    $body = urlencode("Please attach your CV and write your introduction here.");
    ?>

    <a href="mailto:<?= $recipient ?>?subject=<?= $subject ?>&body=<?= $body ?>" 
        style="display:inline-block; padding:12px 20px; background:#4CAF50; color:white; text-decoration:none; border-radius:8px;">
        📧 Send Email
    </a>

    <a href="home.php" class="back-btn" 
        style="margin: 0; padding: 12px 20px; background:#4CAF50; color:white; border-radius: 8px; text-decoration: none; font-weight: bold;">
        ← Back to Jobs Home
    </a>

</div>

</body>
</html>