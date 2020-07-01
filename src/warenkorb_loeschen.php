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


    $sql = "DELETE FROM warenkorb WHERE IDProdukt = ? and IDKunde=?";
    $result =$db->prepare($sql);
    $result->bind_param("ii", $_POST['ButtonLoeschen'],$_SESSION["BenutzerID"]);

    if ($result->execute() === TRUE) {
        echo "Erfolgreich gelöscht!";


        $sql = "SELECT * FROM warenkorb AS w, produkt AS p WHERE IDKunde = ? ";
        $result =$db->prepare($sql);
        $result->bind_param("i", $_SESSION["BenutzerID"]);
        $result->execute();
        $res = $result->get_result();

        $warenkorb = array();
        while($row = mysqli_fetch_array($res)){
            $warenkorb[] = $row;
        }

        $_SESSION["warenkorb"] = $warenkorb;

        header('Location: /warenkorb');

$conn->close();

    }
    else{
        echo "Error: " . $sql . "<br>" . $result->error;
    }

