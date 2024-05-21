
<html>
    <head>
        <style>
body{
    margin: 0;
    padding: 0;
}
header {
  background-color: #333;
  color: white;
  padding: 15px;
}

nav {
  display: flex;
  justify-content: space-between;
  align-items: center;
}


.nav-links {
  list-style: none;
  display: flex;
}

.navbar-brand{
    color: #ffffff;
    text-decoration: none;
    font-size: 24px;
    font-weight: bold;
}

.nav-links li {
  margin-right: 20px;
  padding: 0 20px;
}

.nav-links a {
  text-decoration: none;
  color: white;
  transition: all 0.5s ease-in-out;
  font-size: 18px;
  border-bottom: 2px solid transparent;
}

.nav-links a:hover,
.nav-links li a:active {
  color: #ffcc00;
  border-bottom: 2px solid #ffcc00;
}

.navbar-brand{
    color: #ffffff;
    text-decoration: none;
    font-size: 24px;
    font-weight: bold;
}


        </style>
    </head>
<header>

<body>
<nav class="navbar">
        <div>
            <a class="navbar-brand" href="../Jaydip/Home.php" >FarmTech</a>
     
         </div>

            <div  id="MyNav">
                <ul class="nav-links">
                    
                    <li>
                        <a  href="../Jaydip/Home.php">Home</a>
                    </li>
                    
                    <li>
                        <a  href="../Jaydip/Products.php">Products</a>
                    </li>

                    <li>
                        <a  href="../Adil/Cart.php">Cart</a>
                    </li>



                    <?php

                    if(isset($_SESSION["userInfo"])) {
                        echo   '<li ><a class="" href="../Utsav/Logout.php?logout_user=1">Logout</a></li>';
                    } else {
                        echo '
                        <li class="nav-item">
                            <a  href="../Jaiminkumar/Login.php">Login</a>
                            
                        </li>
                        <li class="nav-item">
                                <a href="../Jaiminkumar/Register.php"">Register</a>
                            </li>';

                    }


                    ?>

                    
                    <li class="nav-item">
                        <a  href="../Jaiminkumar/Admin.php">Admin</a>
                    </li>

                </ul>
            </div>
    </nav>

</body>
</header>
</html>