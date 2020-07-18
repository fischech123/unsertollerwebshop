<?php

include_once 'Request.php';
include_once 'Router.php';
$router = new Router(new Request);

$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";



if(strstr($actual_link, 'ladeProduktID')){
    include 'ladeProduktID.php';
}


$router->get('/', function() {

    include 'View/page1.html';

});

$router->get('/anmelden', function() {

    include 'View/anmeldung.html';
});

$router->get('/login', function() {

    include 'View/login.html';
});

$router->get('/product', function() {

    // include 'View/product.html';
    //  include 'ladeProdukt.php';
    include 'ladeProduktKat.php';
});

$router->get('/productdetail', function() {

    include 'View/product.html';
});

$router->get('/warenkorb', function() {

    include 'View/warenkorb.html';
});

$router->get('/warenkorbholen', function() {

    include 'warenkorbholen.php';
});


$router->get('/logout', function() {


    include 'logout.php';
});

$router->get('/warenkorb_weg', function() {


    include 'warenkorb.php';
});

$router->get('/test', function() {
    include 'ladeProduktKat.php';
});

$router->get('/test', function() {
    include 'ladeProduktKat.php';
});

$router->get('/bestellungende', function() {
    include 'View/bestellungende.html';
});


/*
$router->get('/ladeProduktID?ID={$id}', function($id) {
    //include 'ladeProduktID.php';
    echo 'hallo';
});
*/


