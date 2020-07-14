<?php

include_once 'Request.php';
include_once 'Router.php';
$router = new Router(new Request);

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


$router->get('/logout', function() {


    include 'logout.php';
});

$router->get('/warenkorb_weg', function() {


    include 'warenkorb.php';
});

$router->get('/test', function() {
    include 'ladeProduktKat.php';
});

