<?php
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

echo var_dump($refs);
$html = toUL($refs);
echo var_dump($html);

function toUL(array $array)
{
    $html = '<ul>' . PHP_EOL;

    foreach ($array as $value)
    {
        $html .= '<li>' . $value['Bezeichnung'];
        if (!empty($value['children']))
        {
            $html .= toUL($value['children']);
        }
        $html .= '</li>' . PHP_EOL;
    }

    $html .= '</ul>' . PHP_EOL;

    return $html;
}


?>
