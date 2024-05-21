<?php
ob_start();

session_start();

include("../fpdf/fpdf.php");
include("../Class/dbconnect.php");
include("../Class/product.php");
include("../Class/cart.php");

$dbconnect = new DbConnect;
$productOb = new Product($dbconnect->get_dbconnect());

$products = $productOb->get_all_product_data();
$userInfo = $_SESSION["userInfo"];
var_dump($products);

var_dump($userInfo);

class Invoice extends FPDF
{
    function Header()
    {
        $this->SetFont("Arial", "B", 14);
        $this->Cell(0, 11, "ORDER INVOICE", 0, 1, "C");
        $this->Ln(2);

        $this->SetFont("Arial", "B", 14);
        $this->Cell(0, 11, "FarmTech", 0, 1, "C");
        $this->Ln(11);
    }


    function uInfo($customer)
    {
        $this->SetFont("Arial","B", 14);

        $this->Cell(0, 11, "Customer INFO", 0, 1);

        $this->SetFont("Arial", "", 11);

        $this->Cell(0, 11, "Full Name - " . $customer["name"], 1, 1);
        $this->Cell(0, 11, "Email Address -" . $customer["email"], 1, 1);
        $this->Cell(0, 11, "Phone Number - " . $customer["phone_num"], 1, 1);
        $this->Cell(0, 11, "Address -" . $customer["address"], 1, 1);
        $this->Ln(5);
    }
    function orderItems($cart, $products)
    {
        $this->SetFont("Arial", "B", 11);
        $this->Cell(60, 11, "Product", 1);
        $this->Cell(40, 11, "Quantity", 1);
        $this->Cell(40, 11, "Price", 1);
        $this->Cell(50, 11, "Total Price", 1);
        $this->Ln();
    
        $this->SetFont("Arial", "", 11);
    
        $total = 0;
    
        foreach($cart as $productId => $item) {
            $productIndex = array_search($productId, array_column($products, 'id'));
    
            // Check if the product was found
            if ($productIndex !== false) {
                $product = $products[$productIndex];
                $this->Cell(60, 11, $product["name"], 1, 0);
                $this->Cell(40, 11, $item["quantity"], 1, 0);
                $this->Cell(40, 11, "$" . $product["price"], 1, 0);
                $this->Cell(50, 11, "$" . number_format($product["price"] * $item["quantity"], 2), 1, 0);
                
                $total += $product["price"] * $item["quantity"];
    
                $this->Ln();
            } else {
                error_log("Product with ID $productId not found.");
            }
        }
    
        $this->Ln(5);
    
        $this->SetFont("Arial","B", 14);
        $this->Cell(190, 11, "Total Amount - ". "$" . number_format($total, 2) , 1, 0, 'R');
    }
    

}

// Check if cart session variable is set
if(isset($_SESSION["cart"])) {
    // Create invoice PDF
    $items = $_SESSION["cart"];
    $pdf = new Invoice();
    $pdf->AddPage();
    $pdf->uInfo($userInfo);
    $pdf->orderItems($items, $products);
    ob_end_clean();
    // Output PDF
    $pdf->Output();
} else {
    // If cart is empty, redirect to home page or show error message
    header("Location: index.php");
    exit();
}

