<?php
$conn2 = new mysqli("localhost", "Admin", "root", "onlinesopv2");
$sql = "SELECT * FROM warenkorb AS w, produkt AS p WHERE IDKunde = ? AND w.IDProdukt = p.IDProdukt";
$result =$db->prepare($sql);
$result->bind_param("i", $_SESSION["BenutzerID"]);
$result->execute();
$res = $result->get_result();

$warenkorb = array();
while($row = mysqli_fetch_array($res)){
    $warenkorb[] = $row;
}

$_SESSION["warenkorb"] = $warenkorb;

$conn2->close();

header("Location:/warenkorb");