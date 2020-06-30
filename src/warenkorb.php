<?php

$produktid = $_POST['warenkorbid'];




session_start();
$db = new mysqli("localhost", "Admin", "root", "onlinesopv2");



$sql = "SELECT * FROM warenkorb WHERE IDProdukt = ? and IDKunde=?";

$result =$db->prepare($sql);
$result->bind_param("ii",$_POST['warenkorbid'], $_SESSION["BenutzerID"]);
$result->execute();
$res = $result->get_result();
$row = $res->fetch_assoc();

if($row > 0)
{

    $conn = new mysqli("localhost", "Admin", "root", "onlinesopv2");
    $sql = "UPDATE warenkorb SET Menge=? WHERE IDProdukt=? and IDKunde=?";

    $smt = $conn->prepare($sql);
    $neue_menge = $row['Menge'] +1;
    $smt->bind_param('iii', $neue_menge, $_POST['warenkorbid'], $_SESSION["BenutzerID"]);

    if ($smt->execute() === TRUE) {


        header('Location: /warenkorb');
    } else {
        echo "Error: " . $sql . "<br>" . $smt->error;
    }

    $conn->close();

}
else
{
    $conn2 = new mysqli("localhost", "Admin", "root", "onlinesopv2");
    $sql2 = "INSERT INTO warenkorb (IDKunde, IDProdukt, Menge) VALUES (?,?,?)";

    $smt2 = $conn2->prepare($sql2);

    $menge = 1;

    $smt2->bind_param('iii',$_SESSION['BenutzerID'], $_POST['warenkorbid'], $menge);

    if ($smt2->execute() === TRUE) {

        header("Location:/warenkorb");
    } else {
        echo "Error: " . $sql2 . "<br>" . $smt2->error;
    }

    $conn2->close();
}

?>