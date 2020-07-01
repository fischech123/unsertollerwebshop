<?php
include_once 'mysql.php';



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


$db = new mysql();

$ergebnis = mysqli_query($db->verbinden(), "SELECT * FROM produktkategorie");
$count =0;

while($row = mysqli_fetch_object($ergebnis))
{
    $ausgabe[$count]=$row->this;
    print_r($ausgabe);
}