<?php
session_start();

require_once __DIR__ . '/../src/Model/User.php';
use Src\Model\User;

$userModel = new User();

// Create default admin if not exists
$admin = $userModel->findByUsername('admin');
if(!$admin){
    $userModel->create('admin', 'admin123', 1);
}

$message = '';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $user = $userModel->findByUsername($username);

    if($user && password_verify($password, $user['password'])){
        $_SESSION['user'] = $user;
        header("Location: admin/dashboard.php");
        exit;
    } else {
        $message = 'Invalid user name or password';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Job Finder</title>
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
            font-weight: bold;
            transition: 0.3s;
        }

        nav ul li a:hover {
            background: #388E3C;
        }

        .login-container {
            max-width: 400px;
            margin: 60px auto;
            padding: 40px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
            animation: fade .6s ease forwards;
            opacity: 0;
            transform: translateY(20px);
        }
        @keyframes fade {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .login-container h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        .login-container label {
            font-weight: bold;
            display: block;
            margin: 10px 0 7px;
            color: #444;
        }

        .login-container input {
            width: 93%;
            padding: 12px;
            font-size: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            outline: none;
            transition: 0.3s;
        }

        .login-container input:focus {
            border-color: #4CAF50;
            box-shadow: 0 0 5px rgba(76,175,80,0.5);
        }

        .login-container button {
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            background: #4CAF50;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.3s;
        }

        .login-container button:hover {
            background: #3a8a3d;
        }

        .alert-danger {
            background: #f8d7da;
            padding: 12px;
            color: #721c24;
            border-radius: 6px;
            border: 1px solid #f5c6cb;
            text-align: center;
            margin-bottom: 15px;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 15px;
            margin-top: 40px;
        }
    </style>
</head>
<body>

<div class="head">
    <h1>Job Finder</h1>
    <nav>
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="content.php">Content</a></li>
            <li><a class="active" href="login.php">Login</a></li>
        </ul>
    </nav>
</div>

<div class="login-container">
    <h2>Admin Login</h2>

    <?php if($message): ?>
        <div class="alert-danger"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>
    <!-- htmlspecialchars => To avoid XSS attacks -->
     <!-- <script>alert('Hacked!')</script> -->


    <form method="POST">

        <label for="username">User Name</label>
        <input type="text" name="username" id="username" placeholder="Enter your user name" required>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Enter your password" required>

        <button type="submit">Login</button>
    </form>
</div>

<footer>
    &copy; 2025 Job Finder. All rights reserved.
</footer>

</body>
</html>

<!-- 
session_start(); 
echo $_SESSION['user']['username'];  -->
