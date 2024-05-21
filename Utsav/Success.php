<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You!</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .heading {
            color: #007bff;
            margin-bottom: 20px;
        }

        .message {
            text-align: center;
            margin-bottom: 30px;
            font-size: 18px;
            color: #6c757d;
        }

        .btn-primary {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<?php include("../nav.php"); ?>

<div class="container">
    <h2 class="heading">Thank you for Shopping with FarmTech</h2>
    <p class="message">Click the button below to download your invoice</p>
    <a href="Invoice.php" class="btn btn-primary">Download Order Invoice</a>
</div>

</body>
</html>
