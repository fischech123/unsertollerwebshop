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


$email = $_POST['Email'];


$sql = "SELECT * FROM konto WHERE Email = ? and Password = ?";
$result =$db->prepare($sql);



$result->bind_param("ss",$_POST['Email'], $_POST['Password']);
$result->execute();
$res = $result->get_result();
$row = $res->fetch_assoc();

if($row > 0)
{


    $_SESSION["Benutzer"] = $row['Benutzername'];
    $_SESSION["BenutzerID"] = $row['IDKonto'];
    header('Location: /');
}
else
{
    header('Location: /login');
    die();
}



?>