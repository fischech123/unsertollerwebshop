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


$sql = "SELECT * FROM konto WHERE Email = ? OR Benutzername = ?";
$smt = $db->verbinden()->prepare($sql);
$smt->bind_param('ss',$_POST['Email'], $_POST['Benutzername']);
$smt->execute();
$checkUser = $smt->num_rows();


if($checkUser > 0){
    $smt->close();
    echo "<a href=View/anmeldung.html ";
}

$sql = "INSERT INTO konto (Benutzername, Password, Email, Vorname, Nachname, Strasse, Stadt, Land) VALUES(?,?,?,?,?,?,?,?)";

$smt = $db->verbinden()->prepare($sql);

if(!$smt) {echo "Hilfe fehler";}
$smt->bind_param('ssssssss',$_POST['Benutzername'],$_POST['Password'],$_POST['Email'], $_POST['Vorname'], $_POST['Nachname'], $_POST['Strasse'], $_POST['Stadt'], $_POST['Land']);

if(!$smt->execute()) {
    echo "Query fehlgeschlagen: ".$smt->error;
}

$smt->close();

echo "Funktioniert?";
echo "Variable " . $email;
echo "POST-Variable " . $_POST['Benutzername'];
echo "<a href=View/login.html ";
?>