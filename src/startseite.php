<?php
include_once 'mysql.php';
$db = new mysql();

$ergebnis = mysqli_query($db->verbinden(), "SELECT * FROM produktkategorie");
$count =0;

while($row = mysqli_fetch_object($ergebnis))
{
    $ausgabe[$count]=$row->this;
    print_r($ausgabe);
}