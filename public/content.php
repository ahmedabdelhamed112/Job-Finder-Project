<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Contact Us - Job Finder</title>
<style>
    body, html {
        margin: 0;
        padding: 0;
        height: 100%;
        font-family: Arial, sans-serif;
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
    .content-box {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: #fff;
        padding: 30px;
        width: 90%;
        max-width: 600px;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0,0,0,0.3);
        z-index: 2;
    }

    h1 {
        text-align: center;
        color: #4CAF50;
    }

    p {
        font-size: 16px;
        line-height: 1.5;
    }
        .contact-info div {
        margin-bottom: 10px;
    }

    .contact-info i {
        margin-right: 8px;
        color: #4CAF50;
    }

</style>
</head>
<body>

<div class="background" id="background"></div>

<div class="content-box">
    <h1>Contact Us</h1>
    <p>Welcome to Job Finder! This platform helps you find your dream job easily. Browse jobs by category, location, or type, and connect with top employers in your field.</p>

    <div class="contact-info">
        <div>📧 Email: contact@jobfinder.com</div>
        <div>📞 Phone: +201060708090</div>
        <div>⏰ Working Hours: 9:00AM - 6:00PM</div>
    </div>
</div>

<script>
    const background = document.getElementById('background');
    background.addEventListener('click', () => {
        window.location.href = 'home.php';
    });
</script>

</body>
</html>