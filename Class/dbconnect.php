<?php
// utsav padariya
class DbConnect
{
    private $con;

    function __construct()
    {
        try {
            // Connect to MySQL database using PDO
            $this->con = new PDO("mysql:host=localhost", "root", "");
            // Set PDO to throw exceptions on error
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Create the database if it doesn't exist
            $dbname = "farmtech";
            $stmt = $this->con->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$dbname'");
            if ($stmt->rowCount() == 0) {
                $this->con->exec("CREATE DATABASE $dbname");
            }

            // Select the created database
            $this->con->exec("USE $dbname");
        } catch (PDOException $e) {
            // Handle connection errors gracefully
            echo "Connection failed: " . $e->getMessage();
            exit(); // Exit script on connection failure
        }
    }

    function get_dbconnect()
    {
        return $this->con;
    }
}

// Create a new instance of DbConnect
$db = new DbConnect();

// Now you can use $db->get_dbconnect() to get the PDO connection object


?>
