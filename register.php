<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register PDO OOP AJAX</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        html,
        body {
        height: 100%;
        }

        .form-signin {
        max-width: 330px;
        padding: 1rem;
        }

        .form-signin .form-floating:focus-within {
        z-index: 2;
        }

        .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        }
    </style>

</head>
<body>

    <?php include("nav.php"); ?>

    <main class="form-signin w-100 m-auto">
        <form id="registerForm">
            <h1 class="h3 mb-3 fw-normal">Register Page</h1>
            <div id="response" class="alert alert-danger" role="alert" style="display: none;"></div>
            <div class="form-floating">
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name">
                <label for="name">Your name</label>
            </div>
            <div class="form-floating">
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
                <label for="email">Email address</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                <label for="floatingPassword">Password</label>
            </div>

            <button class="btn btn-primary w-100 py-2" type="submit">Sign Up</button>
            <p class="mt-5 mb-3 text-body-secondary">&copy; 2024</p>
        </form>
    </main>
    
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
           $("#registerForm").on("submit", function(event) {
                event.preventDefault();

                const formData = {
                    name: $("#name").val(),
                    email: $("#email").val(),
                    password: $("#password").val()
                }

                $.ajax({
                    url: "/register-login-pdo-oop-ajax/api/registerUser.php",
                    type: "POST",
                    data: JSON.stringify(formData),
                    contentType: "application/json", // sending JSON data to the server
                    success: function(response) {
                        console.log(response);
                        if (response.success === true) {
                            $("#response").removeClass("alert-danger").addClass("alert-success").text(response.message).show();
                        } else {
                            $("#response").removeClass("alert-success").addClass("alert-danger").text(response.message).show();
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log("An error occurred: " + textStatus);
                    }
                })
           })
        })
    </script>

</body>
</html>