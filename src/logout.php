<?php
session_start();
$_SESSION["Benutzer"] = NULL;
$_SESSION["BenutzerID"] = Null;
session_destroy();
header('Location: /');