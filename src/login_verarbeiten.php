<?php


$db = new mysqli("localhost", "Admin", "root", "onlinesopv2");


$email = $_POST['Email'];


$sql = "SELECT * FROM konto WHERE Email = ? and Password = ?";
$result =$db->prepare($sql);



$result->bind_param("ss",$_POST['Email'], $_POST['Password']);
$result->execute();
if($result->fetch() > 0)
{
    echo "Username oder Email exestiert bereits!";
}
else
{
    header('Location: /login');
    die();
}



?>