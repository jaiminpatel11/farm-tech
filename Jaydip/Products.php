<?php
session_start();

include("../nav.php"); 
include("../Class/dbconnect.php"); 
include("../Class/product.php"); 
include("../Class/cart.php");

$dbconnect = new DbConnect;

$product = new Product($dbconnect->get_dbconnect()); 


$cart = new Cart(); // Create an instance of the Cart class

// condition id cat !== all at that time display product by category
if(isset($_GET["cat"]) && $_GET["cat"] != "All"){
    $products = $product->get_products_by_category($_GET["cat"]);
} else {
    $products = $product->get_all_product_data();
}

// Check if the form was submitted with the name 'add_to_cart'
if (isset($_POST["add_to_cart"])) {
    // Retrieve the product ID and quantity from the form data
    $product_id = $_POST["pid"];
    $quantity = $_POST["quantity"];
    
    // Call the add_to_cart_item method of the Cart class to add the product to the cart
    $cart->add_to_cart_item($product_id, $quantity);
    
    // Redirect back to Products.php with a success message
    header("Location: Products.php?msg=success");
    exit; // Ensure no further code execution after redirection
}

?>

<html>
<head>
    <link rel="stylesheet" href="../style.css">
    <style>
       .container-add-product {
        margin-top: 50px;
    }

    .form {
        margin-bottom: 40px;
    }

    .select-wrapper {
        display: flex;
        align-items: center;
    }

    .form-select {
        flex: 1;
        margin-right: 10px;
        border: 1px solid #ccc; 
        padding: 10px; 
        border-radius: 5px;
        width: 320px; 
    }

    .btn-filter {
        width: 100px; 
    }

    </style>
</head>
<body>
    <h4 class="heading text-center">PRODUCTS</h4>
    <div class="container-add-product text-center">
        <form class="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
    <div class="select-wrapper">
        <select class="form-select" name="cat">
            <option value="All">All Products</option>
            <option value="Tractors">Tractors</option>
            <option value="Harvesters">Harvesters</option>
            <option value="Planters and Seeders">Planters and Seeders</option>
            <option value="Sprayers">Sprayers</option>
        </select>
        <button type="submit" class="btn btn-primary btn-filter">Filter</button>
    </div>
</form>
        
        <div class="product-grid">
                 <!-- "jaiminkumar" helped Jaydip to display products -->
            <?php 
            if(!empty($products)) { 
                foreach($products as $product) {
            ?>
                    <div class="product-card">
                    <img src="../<?php echo $product['imgfile']; ?>" class="product-img" alt="Product">
                        <div class="card-body">
                        <h5 class="product-name"><?php echo $product['name']; ?></h5>
                        <p class="card-text"><?php echo $product['description']; ?></p>
                        <p class="product-price"><?php echo "$".$product['price']; ?></p>
                            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <input type="hidden" name="pid" value="<?php echo $product['id']; ?>">
                            <input type="text" id="quantity" name="quantity" class="form-control mb-3" value="1">
                            <button type="submit" name="add_to_cart" class="btn btn-primary btn-add-to-cart">Add to Cart</button>
                            </form>
                        </div>
                    </div>
            <?php 
                }
            } else {
                echo "<p>No products found.</p>";
            }
            ?>
        </div>
    </div>
  
</body>
</html>
