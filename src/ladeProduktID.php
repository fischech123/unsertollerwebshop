<?php

session_start();


$session_timeout = 600; // 1800 Sek./60 Sek. = 30 Minuten
if (!isset($_SESSION['last_visit'])) {
    $_SESSION['last_visit'] = time();
    // Aktion der Session wird ausgeführt
}
if((time() - $_SESSION['last_visit']) > $session_timeout) {
    session_destroy();
    header("Location:/");
    // Aktion der Session wird erneut ausgeführt
}
$_SESSION['last_visit'] = time();



$db = new mysqli("localhost", "Admin", "root", "onlinesopv2");

// Check connection
if ( $db->connect_error ) {
    die("Connection failed: " . $db->connect_error);
}

$sql = "SELECT * FROM produkt WHERE IDProduktkategorie = ?";

$result =$db->prepare($sql);
$result->bind_param("i",$_GET['ID']);
$result->execute();

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
