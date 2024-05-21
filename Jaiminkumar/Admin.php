<?php
session_start();

include("../nav.php"); 
include("../Class/dbconnect.php"); 
include("../Class/product.php"); 

$dbconnect = new DbConnect;    
$product = new Product($dbconnect->get_dbconnect()); 

$products = $product->get_all_product_data();

$name = $imgFile = $description = $category = $price = ''; // Initialize variables

$errors = array(); // Initialize an empty array for storing errors

// Check if product is added successfully and set session variable
if (isset($_GET["msg"]) && $_GET["msg"] == "added") {
    $_SESSION['add_message'] = "Product added successfully";
}

// Check if product is deleted successfully and set session variable
if (isset($_GET["msg"]) && $_GET["msg"] == "deleted") {
    $_SESSION['delete_message'] = "Item deleted successfully";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form fields
    if (empty($_POST['name'])) {
        $errors['name'] = "Product name is required";
    } else {
        $name = $_POST['name'];
    }

    if (empty($_POST['imgfile'])) {
        $errors['imgfile'] = "Image file URL is required";
    } else {
        $imgFile = $_POST['imgfile'];
    }

    if (empty($_POST['description'])) {
        $errors['description'] = "Description is required";
    } else {
        $description = $_POST['description'];
    }

    if (empty($_POST['category'])) {
        $errors['category'] = "Category is required";
    } else {
        $category = $_POST['category'];
    }

    if (empty($_POST['price'])) {
        $errors['price'] = "Price is required";
    } else {
        $price = $_POST['price'];
    }

    // If there are no errors, proceed with adding the product
    //craeting products if there is no error
    if (empty($errors)) {
        $product->create_product($name, $imgFile, $description, $category, $price);
        header("Location: Admin.php?msg=added");
        exit;
    }
}


// delete product
if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $product->delete_product($id);
    header("Location: Admin.php?msg=deleted");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="../style.css">
    
    <style>
        .error {
            color: red;
        }
        .success-message {
            color: green;
            font-weight: bold;
            text-align: center;
            font-size: larger;
            font-family: bold;
        }
        .delete-message {
            color: red;
            font-weight: bold;
            text-align: center;
           font-size: larger;
           font-family: bold;

        }
    </style>
</head>
<body>
<h2 class="heading">Add Product</h2>
<div class="container-add-product">
    <?php
    // Display add success message
    if(isset($_SESSION['add_message'])) {
        echo '<p class="success-message">' . $_SESSION['add_message'] . '</p>';
        unset($_SESSION['add_message']); // Clear the session variable
    }
    
    // Display delete success message
    if(isset($_SESSION['delete_message'])) {
        echo '<p class="delete-message">' . $_SESSION['delete_message'] . '</p>';
        unset($_SESSION['delete_message']); // Clear the session variable
    }
    ?>
    <div class="form">
    <form action="Admin.php" method="post">
        <div class="form-group">
            <label for="name">Product Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" >
            <?php if (!empty($errors['name'])) { echo '<p class="error">' . $errors['name'] . '</p>'; } ?>
        </div>
        <div class="form-group">
        <label for="imgfile">Image File (URL):</label>
        <select class="form-control" id="imgfile" name="imgfile">
            <option value="">Select Image File</option>
            <option value="products\harvestor.jpg">harvestor</option>
            <option value="products\planter-seeders.jpg">planter-seeders</option>
            <option value="products\sprayer.jpg">Sprayer</option>
            <option value="products\tractor.jpg">Tractor</option>
            <option value="products\tractors-small-red.jpg">Tractors-small-red</option>
        </select>
            <?php if (!empty($errors['imgfile'])) { echo '<p class="error">' . $errors['imgfile'] . '</p>'; } ?>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description" rows="3" ><?php echo htmlspecialchars($description); ?></textarea>
            <?php if (!empty($errors['description'])) { echo '<p class="error">' . $errors['description'] . '</p>'; } ?>
        </div>

        <div class="form-group">
        <label for="category">Category:</label>
        <select class="form-control" id="category" name="category">
            <option value="">Select Category</option>
            <option value="Tractors">Tractors</option>
            <option value="Harvesters">Harvesters</option>
            <option value="Planters and Seeders">Planters and Seeders</option>
            <option value="Sprayers">Sprayers</option>
        </select>
        <?php if (!empty($errors['category'])) { echo '<p class="error">' . $errors['category'] . '</p>'; } ?>
        </div>

        <div class="form-group">
            <label for="price">Price:</label>
            <input type="text" class="form-control" id="price" name="price" value="<?php echo htmlspecialchars($price); ?>" >
            <?php if (!empty($errors['price'])) { echo '<p class="error">' . $errors['price'] . '</p>'; } ?>
        </div>
        <div class="button">
            <button type="submit" class="btn btn-primary" name="add">Submit</button>
        </div>
    </form>
    </div> 
    

    <div class="product-grid">
        
        <!-- ierate overe the all of the products which store in to database -->
        <?php foreach($products as $product){ ?>
            <div class="product-card">
            <img src="../<?php echo $product['imgfile']; ?>" class="product-img" alt="Product">                <div class="product-details">
                    <h5 class="product-name"><?php echo $product['name']; ?></h5>
                    <p class="product-description"><?php echo $product['description']; ?></p>
                    <p class="product-price"><?php echo "$".$product['price']; ?></p>
                    <form method="post" action="Admin.php">
                        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                        <button type="submit" name="delete" class=" btn btn-delete">DELETE</button>
                    </form>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
</body>

<?php include("../footer.php"); ?>

</html>
