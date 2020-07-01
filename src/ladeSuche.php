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

    $_POST['Text'] = strtoupper($_POST['Text']);
    $sql = "SELECT * FROM produkt WHERE upper(Beschreibung) LIKE '%".$_POST['Text']."%' OR upper(Bezeichnung) LIKE '%".$_POST['Text']."%'";
    $result = mysqli_query($db,$sql);


    //  Speichere in Array
    $search = array();
    while($row = mysqli_fetch_array($result)){
        $search[] = $row;
    }

    $_SESSION["sucheProdukt"] = $search;

    mysqli_close($db);

    //  Gehe zu der Produktansicht
    header("Location:/productdetail");
?>
