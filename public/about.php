<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About-Job Finder</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
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

        .background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('images/BackGround.jpg') no-repeat center center/cover;
            filter: blur(10px);
            z-index: 1;
        }

        .about-box {
            position: relative;
            z-index: 5;
            max-width: 600px;
            margin: 120px auto;
            padding: 30px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 0 20px rgba(0,0,0,0.2);
        }

        .about-box h2 {
            margin-top: 0;
            color: #333;
        }

        .about-box p {
            color: #555;
            line-height: 1.6;
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
                <li><a href="contact.php">Contact</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </nav>
    </div>

    <div id="background" class="background"></div>
    <div class="about-box">
        <h2>About Job Finder</h2>
        <p>  Job Finder helps you discover the best job opportunities. <br>
              We connect talented candidates with top companies. <br>
              Find your next career move quickly and easily.
        </p>
    </div>
    <script>
document.getElementById('background').addEventListener('click', () => {
    window.location.href ='home.php';
});
</script>
</body>
</html>