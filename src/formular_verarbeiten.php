<?php
include_once 'mysql.php';
$db = new mysql();

$user = $_POST['Benutzername'];
$pw = $_POST['Password'];
$email = $_POST['Email'];
$vName = $_POST['Vorname'];
$nName = $_POST['Nachname'];
$stadt = $_POST['Stadt'];
$strasse = $_POST['Strasse'];
$land = $_POST['Land'];


$sql = "SELECT * FROM Konto WHERE Email = ? OR Benutzername = ?";
$smt = $db->verbinden()->prepare($sql);
$smt->bind_param('ss',$email, $user);
$smt->execute();
$checkUser = $smt->num_rows();

if($checkUser > 0){
    echo "<a href=View/anmeldung.html ";
}

$sql = "INSERT INTO Konto (Benutzername, Email, Vorname, Nachname, Strasse, Stadt, Land) VALUES(?,?,?,?,?,?,?)";
$smt = $db->verbinden()->prepare($sql);
$smt->bind_param('ssssss',$pw, $email, $vName, $nName, $strasse, $stadt, $land);
$smt->execute();

echo "<a href=View/anmeldung.html ";
?>