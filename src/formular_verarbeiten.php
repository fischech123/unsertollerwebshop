<?php
include_once 'mysql.php';
$db = new mysqli("localhost", "Admin", "root", "onlinesopv2");

$user = $_POST['Benutzername'];
$pw = $_POST['Password'];
$email = $_POST['Email'];
$vName = $_POST['Vorname'];
$nName = $_POST['Nachname'];
$stadt = $_POST['Stadt'];
$strasse = $_POST['Strasse'];
$land = $_POST['Land'];

$sql = "SELECT * FROM konto WHERE Email = ? OR Benutzername = ?";
$smt = $db->prepare($sql);
$smt->bind_param('ss',$_POST['Email'], $_POST['Benutzername']);
$smt->execute();
$checkUser = $smt->num_rows();



if($checkUser > 0){
    $smt->close();
    echo "<a href=View/anmeldung.html ";
}

$conn = new mysqli("localhost", "Admin", "root", "onlinesopv2");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO konto (Benutzername, Password, Email, Vorname, Nachname, Strasse, Stadt, Land)
VALUES (?,?,?,?,?,?,?,?)";

$smt = $conn->prepare($sql);

$smt->bind_param('ssssssss',$_POST['Benutzername'],$_POST['Password'],$_POST['Email'], $_POST['Vorname'], $_POST['Nachname'], $_POST['Strasse'], $_POST['Stadt'], $_POST['Land']);

if ($smt->execute() === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $smt->error;
}

$conn->close();

echo "Funktioniert?";
echo "Variable " . $email;
echo "POST-Variable " . $_POST['Benutzername'];
echo "<a href=View/login.html ";
?>