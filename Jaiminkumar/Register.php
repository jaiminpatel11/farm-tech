<?php
session_start();
include("../nav.php");
include("../Class/dbconnect.php");
include("../Class/user.php");

$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(empty($_POST["email"])) {
        $errors['email'] = "Email is required";
    } else {
        $email = $_POST["email"];
        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email)) {
            header("Location: Register.php?msg=emailerror");
            exit();
        }
    }

    if(empty($_POST["password"])) {
        $errors['password'] = "Password is required";
    } else {
        $password = $_POST["password"];
    }


    if(empty($errors)) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $dbconnect = new DbConnect;
        $db = $dbconnect->get_dbconnect();

        $user = new User($db);
        $user->create_user($_POST);
        $_SESSION["userInfo"] = $_POST;

        header("Location: Register.php?msg=success");
        header("Location: Login.php");
        exit; 
    } else {
        header("Location: Register.php?msg=error");
        exit;
    }
}
?>

<!-- Main Content -->
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
    <div class="text-center">
        <h2 class="mb-3 heading">REGISTER</h2>
        <?php
        if(isset($_GET["msg"]) && $_GET["msg"] == "error") {
            echo '<p class="fw-bold text-danger error">All Fields are Required or Valid Input.</p>';
        }
        if(isset($_GET["msg"]) && $_GET["msg"] == "emailerror") {
            echo '<p class="fw-bold text-danger error">Invalid email format. Please enter a valid email address</p>';
        }
        if(isset($_GET["msg"]) && $_GET["msg"] == "success") {
            echo '<p class="fw-bold text-success">Registration Completed.</p>';
        }
        
        ?>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="Register.php" method="post" novalidate>
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" id="email" name="email">
                    <?php if(isset($errors['email'])) echo '<p class="text-danger">' . $errors['email'] . '</p>'; ?>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password">
                    <?php if(isset($errors['password'])) echo '<p class="text-danger">' . $errors['password'] . '</p>'; ?>
                </div>
                <button type="submit" class="btn btn-primary">REGISTER</button>
            </form>
        </div>
    </div>
</div>
<?php include("../footer.php"); ?>
</body>
</html>
