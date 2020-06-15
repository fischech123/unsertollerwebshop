<?php

include_once 'Request.php';
include_once 'Router.php';
$router = new Router(new Request);


$router->get('/', function() {
    include 'View/page1.html';
});

$router->get('/penis', function() {
    return <<<HTML
  <h1>penis</h1>
HTML;
});





$router->get('/profile', function($request) {
    return <<<HTML
  <h1>Profile</h1>
HTML;
});

$router->post('/data', function($request) {

    return json_encode($request->getBody());
});