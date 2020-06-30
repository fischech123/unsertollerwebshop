<?php

    session_start();
    $db = new mysqli("localhost", "Admin", "root", "onlinesopv2");

    // Check connection
    if ( $db->connect_error ) {
        die("Connection failed: " . $db->connect_error);
    }

    $sql = "SELECT * FROM produkt";
    $result = mysqli_query($db,$sql);

    $product = array();
    while($row = mysqli_fetch_array($result)){
        $product[] = $row;
    }

    $_SESSION["produkt"] = $product;

    mysqli_close($db);

    //  Weiterleitung an products
    header("Location:/productdetail");
    // Die Daten einlesen
    //$data = mysqli_fetch_array($result,MYSQLI_ASSOC);



?>
