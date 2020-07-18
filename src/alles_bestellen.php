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
$sql = "SELECT * FROM warenkorb AS w, produkt AS p WHERE IDKunde = ? AND w.IDProdukt = p.IDProdukt";
$result =$db->prepare($sql);
$result->bind_param("i", $_SESSION["BenutzerID"]);
$result->execute();
$res = $result->get_result();

$warenkorb = array();
while($row = mysqli_fetch_array($res)){
    $warenkorb[] = $row;
}
foreach($warenkorb as $row)
{

    $conn2 = new mysqli("localhost", "Admin", "root", "onlinesopv2");
    $sql2 = "INSERT INTO bestellung (IDKunde, IDProdukt, Menge) VALUES (?,?,?)";

    $smt2 = $conn2->prepare($sql2);

    $smt2->bind_param('iii',$_SESSION['BenutzerID'], $row['IDProdukt'], $row['Menge']);

    if ($smt2->execute() === TRUE) {


    }

}

$conn3 = new mysqli("localhost", "Admin", "root", "onlinesopv2");
$sqlDelete = "DELETE FROM warenkorb WHERE IDKunde=".$_SESSION["BenutzerID"];
$conn3->query($sqlDelete) ;
header("Location:/bestellungende");