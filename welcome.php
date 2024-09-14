<?php
include_once "config/class.php";

if (!isset($_SESSION['userId'])) {
    header("Location: login.php");
    exit(); // เพิ่ม exit() เพื่อป้องกันการทำงานต่อ
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register PDO OOP AJAX</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <?php include("nav.php"); ?>

    <div class="px-4 py-5 my-5 text-center">
        <?php
        $web = new Websystem();
        $userData = $web->displayData();
        ?>
        <h1 class="display-5 fw-bold text-body-emphasis">Welcome, <?= htmlspecialchars($userData['name']); ?></h1>
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4">Quickly design and customize responsive mobile-first sites with Bootstrap, the world's most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.</p>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <button type="button" class="btn btn-primary btn-lg px-4 gap-3">Primary button</button>
                <button type="button" class="btn btn-outline-secondary btn-lg px-4">Secondary</button>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $("#logout").on("click", function(e) {
                e.preventDefault();
                if (confirm('Are you sure you want to logout?')) {
                    $.ajax({
                        url: "/register-login-pdo-oop-ajax/api/logoutUser.php",
                        type: "GET",
                        dataType: 'json',
                        success: function(response) {
                            alert(response.message);
                            window.location.href = 'login.php'; // go to login page before logout success.
                        },
                        error: function() {
                            alert('An error occurred during logout. Please try again.');
                        }
                    });
                }
            });
        });
    </script>

</body>

</html>