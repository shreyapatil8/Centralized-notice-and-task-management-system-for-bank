<?php
session_start();
include_once('./includes/config.php');

// Code for login
if (isset($_POST['login'])) {
    $adminusername = $_POST['username'];
    $pass = md5($_POST['password']);

    $ret = mysqli_query($con, "SELECT * FROM admin WHERE username='$adminusername' and password='$pass'");
    $num = mysqli_fetch_array($ret);

    if ($num > 0) {
        $_SESSION['login'] = $_POST['username'];
        $_SESSION['adminid'] = $num['id'];
        echo "<script>window.location.href='dashboard.php'</script>";
        exit();
    } else {
        echo "<script>alert('Invalid username or password');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>MPSC Internal Portal Login</title>
    <link href="./css/styles.css" rel="stylesheet" />
    <link href="./css/custom.css" rel="stylesheet" />
    <link href="./css/login.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="portal-login-page">

        <div class="portal-top-banner">
            <div class="portal-logo-box">
                <img src="./assets/logo.jpeg" alt="Portal Logo">
            </div>

            <div class="portal-title-box">
                <h1 class="bank-title">
                    मामासाहेब पवार सत्यविजय सहकारी बँक <br>
                    लि., कुंडल
                </h1>
            </div>
        </div>

        <div class="portal-menu-bar">
            <a href="#" class="active">होम</a>
            <a href=" https://share.google/v0sGI322DcU2pWU9D" target="_blank">वेबसाईट</a>
            <a href="#">ई-मेल</a>
            <a href="#">संपर्क</a>
        </div>

        <div class="portal-main-wrap">
            <div class="portal-content-row">
                <div class="portal-slider-wrap">
                    <div class="portal-slide active">
                        <img src="./assets/slider/slider1.avif" alt="Slide 1">
                    </div>

                    <div class="portal-slide">
                        <img src="./assets/slider/slider2.jpg" alt="Slide 2">
                    </div>

                    <div class="portal-slide">
                        <img src="./assets/slider/slider3.jpg" alt="Slide 3">
                    </div>

                    <div class="portal-slide">
                        <img src="./assets/slider/slider4.jpg" alt="Slide 4">
                    </div>
                </div>

                <div class="portal-login-panel">
                    <div class="portal-login-card-title">Sign In</div>
                    <div class="portal-login-divider"></div>

                    <form method="post">
                        <label>Username</label>
                        <input class="form-control" name="username" type="text" required>

                        <label>Password</label>
                        <input class="form-control" id="passwordField" name="password" type="password" required>

                        <div class="portal-show-pass">
                            <input type="checkbox" id="showPasswordCheck">
                            <label for="showPasswordCheck" style="margin:0; font-weight:500;">Show password</label>
                        </div>

                        <div class="portal-login-actions">
                            <a href="#" class="portal-forgot-link">Forget password?</a>
                            <button class="portal-signin-btn" name="login" type="submit">SIGN IN</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="portal-footer">
            <div>कॉपीराइट २०२६ © MPSC Co-operative Bank Ltd. सर्व हक्क राखीव.</div>
            <div>Design and Developed By: </div>
        </div>
    </div>

    <script>
        // Show / hide password
        document.getElementById('showPasswordCheck').addEventListener('change', function() {
            const passwordField = document.getElementById('passwordField');
            passwordField.type = this.checked ? 'text' : 'password';
        });

        // Auto slideshow every 3 seconds
        const slides = document.querySelectorAll('.portal-slide');
        let currentSlide = 0;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.remove('active');
                if (i === index) {
                    slide.classList.add('active');
                }
            });
        }

        setInterval(() => {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }, 3000);
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>