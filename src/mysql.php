<?php
class mysql{

    //Datenbank verbinden
    function verbinden(){
        $db = new mysqli("localhost", "Admin", "root", "onlinesopv2");
        return $db;
    }

}