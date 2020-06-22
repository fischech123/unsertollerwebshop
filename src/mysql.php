<?php
class mysql{

    //  Datenbank verbinden
    function verbinden(){
        $db = new mysqli("localhost", "Admin", "root", "onlinesopv2");
        if ($db->connect_errno) {
            die("Verbindung fehlgeschlagen: " . $db->connect_error);
        }
        return $db;
    }

    //  Ausgabe aller Produkte
    function allProcducts(){
        $sql = "SELECT IDProdukt, Bezeichnung, Beschreibung, Preis, IDProduktkategorie FROM Produkt";
        return $this->verbinden()->query($sql);
    }

    //  Ausgabe Suche
    function search($_text){
        $sql = "select * from Produkt where (Beschreibung like ? OR Bezeichnung like ?)";
        $smt = $this->verbinden()->prepare($sql);
        $smt->bind_param('ss',$_text, $_text);
        $smt->execute();

        return $smt->get_result();
    }

}