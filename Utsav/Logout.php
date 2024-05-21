<?php 
session_start();
include_once("../Class/user.php");

if($_GET["logout_user"]){

    session_destroy();
    header("Location: ../Jaydip/Home.php");
    die();

}