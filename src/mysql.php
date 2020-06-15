<?php
class mysql{

    //Datenbank verbinden
    function verbinden(){
        $db = new mysqli("localhost", "Admin", "root", "onlinesopv2");
        if ($db->connect_errno) {
            die("Verbindung fehlgeschlagen: " . $db->connect_error);
        }
        return $db;
    }

}