<?php
class mysql{

    //Datenbank verbinden
    function verbinden(){
        $db = new mysqli("localhost", "Admin", "root", "onlinesopv2");
        if ($db->connect_errno) {
            die("Verbindung fehlgeschlagen: " . $db->connect_error);
        }elseif (! $db){
            printf("Verbindung fehlgeschlagen: %s\n", mysqli_connect_error());
            exit();
        }

        return $db;
    }

}