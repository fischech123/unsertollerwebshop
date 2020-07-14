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


$refs = array();
$list = array();

$db = new mysqli("localhost", "Admin", "root", "onlinesopv2");

// Check connection
if ( $db->connect_error ) {
    die("Connection failed: " . $db->connect_error);
}


$sql = "SELECT ID, OberKID, Bezeichnung FROM produktkat ORDER BY ID";
$sql1 = "SELECT item_id, parent_id, name FROM items ORDER BY name";

$result = mysqli_query($db,$sql);

foreach ($result as $row)
{
    $ref = & $refs[$row['ID']];

    $ref['OberKID'] = $row['OberKID'];
    $ref['Bezeichnung']  = $row['Bezeichnung'];

    if ($row['OberKID'] == 0)
    {
        $list[$row['ID']] = & $ref;
    }
    else
        if($row['OberKID'] != 0)
    {
        $refs[$row['OberKID']]['children'][$row['ID']] = & $ref;
    }
}

mysqli_close($db);

function toUL(array $array)
{
    $html = '<ul>' . PHP_EOL;

    foreach ($array as $value)
    {
        $html .= '<li><a href="'.$value['ID'].'">' . $value['Bezeichnung'];
        //$html .= '<li>' . $value['Bezeichnung'];
        if (!empty($value['children']))
        {
            $html .= toUL($value['children']);
        }
        //$html .= '</li>' . PHP_EOL;
        $html .= '</a></li>' . PHP_EOL;
    }

    $html .= '</ul>' . PHP_EOL;

    return $html;
}
$html = toUL($list);
$_SESSION["produktKat"] = $html;

include 'ladeProdukt.php';

?>
