<?php


$db = new mysqli("localhost", "Admin", "root", "onlinesopv2");


$email = $_POST['Email'];


$sql = "SELECT * FROM konto WHERE Email = '" . $_POST['Email'] . "' and Password = '" . $_POST['Password'] . "'";
$result = mysqli_query($db, $sql);

while ($row = mysqli_fetch_array($result)) {
    if ($row['Benutzername'] == '' ) {

        header('Location: /login');
        die();
    }
}


?>