<?php
// Jaydip Vaghashiya
class Product
{
    private $conn;

    function __construct(PDO $pdo)
    {
        $this->conn = $pdo;
        $this->create_product_table(); // Call function to create table
    }

    // Function to create the 'product' table if it doesn't exist
    private function create_product_table()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `product` (
            
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `name` VARCHAR(255) NOT NULL,
            `imgfile` VARCHAR(255) NOT NULL,
            `description` TEXT,
            `category` VARCHAR(50) NOT NULL,
            `price` DECIMAL(10, 2) NOT NULL
        )";
        $this->conn->exec($sql);
    }

    function get_product($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM product WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch();
    }
    
    function get_all_product_data()
    {
        $stmt = $this->conn->query("SELECT * FROM product");
        return $stmt->fetchAll();
    }

    function get_products_by_category($category)
    {
        $stmt = $this->conn->prepare("SELECT * FROM product WHERE category = :category");
        $stmt->bindParam(':category', $category);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    function create_product($name, $imgFilePath, $description, $category, $price)
    {
        $sql = "INSERT INTO `product` (`name`, `imgfile`, `description`, `category`, `price`) 
        VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$name, $imgFilePath, $description, $category, $price]);
        return 'done';
    }

    function delete_product($id)
    {
        $sql = "DELETE FROM `product` WHERE `id` = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return 'done';
    }
}
?>
