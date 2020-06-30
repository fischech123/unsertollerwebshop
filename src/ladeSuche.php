<?php
    session_start();
    $db = new mysqli("localhost", "Admin", "root", "onlinesopv2");

    $sql = "SELECT * FROM produkt WHERE Beschreibung LIKE '%".$_POST['Text']."%' OR Bezeichnung LIKE '%".$_POST['Text']."%'";
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
