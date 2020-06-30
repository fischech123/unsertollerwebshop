<?php
$produktid = $_POST['warenkorbid'];





$db = new mysqli("localhost", "Admin", "root", "onlinesopv2");



$sql = "SELECT * FROM produkt WHERE IDProdukt = ?";

$result =$db->prepare($sql);
$result->bind_param("i",$_POST['warenkorbid']);
$result->execute();
$res = $result->get_result();
$row = $res->fetch_assoc();

if($row > 0)
{
    session_start();
    print_r($row["IDProdukt"]);
    $_SESSION["produktid"] = $row["IDProdukt"];
   // header('Location: /warenkorb');

}
else
{
    header('Location: /login');
    die();
}



?>