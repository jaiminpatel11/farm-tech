<?php
session_start();
include("../nav.php");
include("../Class/dbconnect.php");
include("../Class/product.php");
include("../Class/cart.php");

$dbconnect = new DbConnect;

$product_obj = new Product($dbconnect->get_dbconnect());

$products = $product_obj->get_all_product_data();

$cart = new Cart();

if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = array();
}

if (isset($_POST["empty_cart"])) {
    $cart->empty_cart();
    header("Location: ".$_SERVER["PHP_SELF"]);
}


if (isset($_POST["remove_item"])) {
    
    $product_id = $_POST["pid"];
    $cart->remove_cart_item($product_id);
    header("Location: ".$_SERVER["PHP_SELF"]);
}


if (isset($_POST["add_to_cart"])) {

    $product_id = $_POST["pid"];
    $quantity = $_POST["quantity"];
    
    $cart->add_to_cart_item($product_id, $quantity);
    header("Location: Products.php?msg=success");

}


// funcation for getting total price
function getTotalPrice($cart, $products)
{
    $total = 0;
    
    foreach ($cart as $productId => $item) {
        foreach ($products as $product) {
            if ($product["id"] == $productId) {
                $total += $product["price"] * $item["quantity"];
            }
        }
    }
    return $total;
}



?>

<html>
    <head>
        <link rel="stylesheet" href="../style.css">'
        
        <style>
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        border: 5px solid #ffcc00;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        border: 2px solid #ffcc00;
    }

    .table th,
    .table td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: left;
    }

    .table th {
        background-color: #f2f2f2;
    }

    .table img {
        max-width: 100px;
        height: auto;
    }

    .text-end {
        text-align: right;
    }

    .btn-container{
        text-align: center;
    }
  
        </style>
    </head>

<body>


<h2 class="mb-4 heading">CART</h2>

<div class="container mt-5">

            
    <table class="table table-bordered">
        <thead class="text-uppercase">
            <tr>
                <th>Product</th>
                <th>name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
             <!-- Jaiminkumar patel  
            
            
            added code to display added product's data to the cart
            
            
            -->
   
           <!-- 
            
            
                This loop iterates over each item in the $_SESSION["cart"] array            
                productId===> key
            -->
        <?php foreach ($_SESSION["cart"] as $productId => $item): ?>
            <!-- this inner loop helps to find and match the product with session cart-->
         <?php foreach ($products as $product): ?>
        <?php if ($product["id"] == $productId): ?>
            <tr>
                <td style="max-width: 140px;">
                    <img src="../<?php echo $product["imgfile"]; ?>" style="width:100px;">
                </td>
                <td><?php echo $product["name"]; ?></td>
                <td>$<?php echo $product["price"]; ?></td>
                <td><?php echo $item["quantity"]; ?></td>
                <td><?php echo "$".$item["quantity"] * $product["price"] . ".00"; ?></td>
                <td>
                    <form action="" method="post">
                        <input type="hidden" name="pid" value="<?php echo $productId; ?>">
                        <button type="submit" name="remove_item" class="btn btn-delete btn-container">REMOVE</button>
                    </form>
                </td>
            </tr>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endforeach; ?>

</tbody>

    </table>

    
    <h5 class="mb-4 text-end ">
        <span class="bg-white p-2">Total Amount: $<?php echo number_format(getTotalPrice($_SESSION["cart"], $products), 2); ?></span>
    </h5>


    <div class="btn-container">

        <!-- checking condition if there is item and and user info is store in  session login -->

        <?php if(isset($_SESSION["cart"]) && count($_SESSION["cart"])){ ?>
            
            <?php if(isset($_SESSION["userInfo"])){ ?>
         
               <a href="../Adil/checkout.php" class="btn btn-primary">Go to Checkout</a>

            <?php } else { ?>
                 
               <a href="../Jaiminkumar/Register.php" class="btn btn-info text-uppercase text-uppercase-info btn btn-info text-uppercase-lg mb-2">REGISTER</a> 
                 
            <?php } ?>
            
        <?php } ?>

    </div>

</div>

</body>


</html>

