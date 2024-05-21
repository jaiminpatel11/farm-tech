<?php
// Jaiminkumar patel
class User
{
    private $conn;

    function __construct(PDO $conn)
    {
        $this->conn = $conn;
        $this->create_user_table(); // Call function to create table
    }

    // Function to create the 'user' table if it doesn't exist
    private function create_user_table()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `user` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `email` VARCHAR(255) NOT NULL,
            `password` VARCHAR(255) NOT NULL
        )";
        $this->conn->exec($sql);
    }

    function create_user($u)
    {
        $stmt = $this->conn->prepare("INSERT INTO `user` (`email`, `password`) 
        VALUES (:email, :password)");
        $stmt->bindParam(':email', $u["email"]);
        $stmt->bindParam(':password', $u["password"]);

        $stmt->execute();
    }

    function get_user($u)
    {
        $stmt = $this->conn->prepare("SELECT * FROM `user` WHERE `email` = :email 
        AND `password` = :password");
        $stmt->bindParam(':email', $u["email"]);
        $stmt->bindParam(':password', $u["password"]);

        $stmt->execute();

        return $stmt->fetch();
    }
}

?>
