<?php

// Adil motala
class Cart
{
    function empty_cart()
    {

        $_SESSION["cart"] = array();

    }


    function remove_cart_item($product_id)
    {

        unset($_SESSION["cart"][$product_id]);

    }

    // function for adding items to the cart
    function add_to_cart_item($product_id, $quantity)
    {

        // if product alredy exist then it increase the quantity of the products.
        // if not then adds new entry with quantity
        if (isset($_SESSION["cart"][$product_id])) {
            $_SESSION["cart"][$product_id]["quantity"] = $_SESSION["cart"][$product_id]["quantity"] + $quantity;
        } else {
            $_SESSION["cart"][$product_id] = array("quantity" => $quantity);
        }


    }



}
