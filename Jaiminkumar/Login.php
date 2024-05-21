<?php

session_start();
include("../nav.php");
include("../Class/dbconnect.php");
include("../Class/user.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["email"]) || empty($_POST["password"])) {
        header("Location: Login.php?msg=error");
        exit(); 
    } else {

        $email = $_POST["email"];
        $password = $_POST["password"];

        // Sanitize inputs to prevent SQL injection
        $email = htmlspecialchars($email);
        $password = htmlspecialchars($password);

        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email)) {
            header("Location: Login.php?msg=emailerror");
            exit();
        }

        $dbconnect = new DbConnect;
        $db = $dbconnect->get_dbconnect();

        $user = new User($db);
        
        // Use prepared statements to prevent SQL injection
        $userInfo = $user->get_user($_POST);

        if ($userInfo) {
            $_SESSION["userInfo"] = $userInfo;
            header("Location: ../Jaydip/Home.php");
            exit(); 
        } else {
            header("Location: Login.php?msg=invalid");
            exit(); 
        }
    }
}

?>

<html>
<head>
    <link rel="stylesheet" href="../style.css">
    <style>
        .container {
            width: 30%;
            margin: auto;
            background: white;
            padding: 20px;
            margin-top: 50px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(1, 0, 2, 0.4);
        }

        form {
            display: grid;
            width: 100%;
            gap: 10px;
        }

        input[type="email"],
        input[type="password"] {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #333;
            width: 100%;
            box-sizing: border-box;
        }

        .error {
            color: red;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .text-center {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .mb-3 {
            margin-bottom: 20px;
        }

        .col-md-6 {
            width: 100%;
        }
    </style>
</head>
<body>
<div class="container my-5">
    <div class="text-">
        <h2 class="heading mb-3">LOGIN</h2>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <?php
            if(isset($_GET["msg"]) && $_GET["msg"] == "error") {
                echo '<p class="fw-bold text-danger error">All Fields are required</p>';
            }

            if(isset($_GET["msg"]) && $_GET["msg"] == "invalid") {
                echo '<p class="fw-bold text-danger error">Email / Password is invalid</p>';
            }

            if(isset($_GET["msg"]) && $_GET["msg"] == "emailerror") {
                echo '<p class="fw-bold text-danger error">Invalid email format. Please enter a valid email address</p>';
            }
            ?>
            <form action="Login.php" method="post" novalidate>
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <button type="submit" class="btn btn-primary">LOGIN</button>
            </form>
        </div>
    </div>
</div>
<?php include("../footer.php"); ?>
</body>
</html>
