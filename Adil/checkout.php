<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="../style.css">
    <style>
    
body{
    margin: 0px;
    padding: 0px;
}

.container {
    background-color: #ffffff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    max-width: 600px;
    margin: 50px auto;
    border: 5px solid #ffcc00;
}

.heading {
    text-align: center;
    margin-bottom: 30px;
}

.form-label {
    font-weight: bold;
}

.form-control {
    border: 1px solid #ced4da;
    border-radius: 5px;
    padding: 8px;
    width: 100%;
    margin-bottom: 15px;
}

.form-row {
    margin-bottom: 15px;
}

.form-group.col {
    margin-bottom: 0;
}


.alert {
    border-radius: 5px;
    background-color: #f8d7da;
    border-color: #f5c6cb;
    color: #721c24;
    padding: 10px;
    margin-bottom: 15px;
}
.btn-container{
    text-align: center;
}

    </style>
</head>
<body>

<?php
session_start();
include("../nav.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $formErrors = [];

    if (empty($_POST["name"])) {
        $formErrors[] = "Name is required.";
    }

    if (empty($_POST["email"])) {
        $formErrors[] = "Email is required.";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $formErrors[] = "Invalid email format.";
    }

    if (empty($_POST["phone_num"])) {
        $formErrors[] = "Phone number is required.";
    }

    if (empty($_POST["address"])) {
        $formErrors[] = "Address is required.";
    }

    if (empty($_POST["card_num"]) || strlen($_POST["card_num"]) != 16) {
        $formErrors[] = "Card number must be 16 Digits";
    }

    if (empty($_POST["expiry_date"])) {
        $formErrors[] = "Expiry Date is required.";
    }

    if (empty($_POST["cvv"]) || strlen($_POST["cvv"]) != 3) {
        $formErrors[] = "CVV is 3 Digits value.";
    }

    if(empty($formErrors)) {
        $_SESSION["userInfo"] = $_POST;
        header("Location: ../Utsav/Success.php");
    }
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <?php
            if (!empty($formErrors)) {
                echo "<div class='alert alert-info mt-3'><ul>";
                foreach ($formErrors as $formError) {
                    echo "<li>$formError</li>";
                }
                echo "</ul></div>";
            }
            ?>
            <h2 class="mb-3 heading">CHECKOUT</h2>
            <form action="checkout.php" method="post">
                <div class="form-group">
                    <label for="name" class="form-label">Customer Full Name</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group col">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="phone" name="phone_num">
                    </div>
                </div>
                <div class="form-group">
                    <label for="address" class="form-label">Address</label>
                    <textarea class="form-control" id="address" name="address" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="card_num" class="form-label">Credit Card No.</label>
                    <input type="text" class="form-control" id="card_num" name="card_num">
                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <label for="expiry_date" class="form-label">Expiry Date</label>
                        <input type="text" class="form-control" id="expiry_date" name="expiry_date" placeholder="MM/YY">
                    </div>
                    <div class="form-group col">
                        <label for="cvv" class="form-label">CVV</label>
                        <input type="text" class="form-control" id="cvv" name="cvv">
                    </div>
                </div>
                <div class="btn-container"> 
                    <button type="submit" name="submit" class="btn btn-primary btn-container">CHECKOUT</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
