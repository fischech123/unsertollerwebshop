<?php

include_once 'Request.php';
include_once 'Router.php';
$router = new Router(new Request);


$router->get('/', function() {
    return ;
        /*<<<HTML
  <h1>Hello world23123213</h1>
HTML;*/
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