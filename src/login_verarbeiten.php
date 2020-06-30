<?php


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

    session_start();
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