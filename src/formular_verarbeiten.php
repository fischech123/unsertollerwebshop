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



$db = new mysqli("localhost", "Admin", "root", "onlinesopv2");

$user = $_POST['Benutzername'];
$pw = $_POST['Password'];
$email = $_POST['Email'];
$vName = $_POST['Vorname'];
$nName = $_POST['Nachname'];
$stadt = $_POST['Stadt'];
$strasse = $_POST['Strasse'];
$land = $_POST['Land'];

$sql = "SELECT * FROM konto WHERE Email = '".$_POST['Email']."' OR Benutzername = '".$_POST['Benutzername']."'";
$result = mysqli_query($db,$sql);

while ($row = mysqli_fetch_array($result)) {
    if($row['Benutzername'] != '' or $row['Email'] !=''){

        header('Location: /anmelden');
die();
    }
}



    $conn = new mysqli("localhost", "Admin", "root", "onlinesopv2");
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO konto (Benutzername, Password, Email, Vorname, Nachname, Strasse, Stadt, Land)
VALUES (?,?,?,?,?,?,?,?)";

    $smt = $conn->prepare($sql);

    $smt->bind_param('ssssssss', $_POST['Benutzername'], $_POST['Password'], $_POST['Email'], $_POST['Vorname'], $_POST['Nachname'], $_POST['Strasse'], $_POST['Stadt'], $_POST['Land']);

    if ($smt->execute() === TRUE) {
        echo "New record created successfully";
        header("Location:/login");
    } else {
        echo "Error: " . $sql . "<br>" . $smt->error;
    }

    $conn->close();




?>