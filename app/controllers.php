<?php
/**
 * Created by PhpStorm.
 * User: cesar
 * Date: 29/07/16
 * Time: 16:07
 */

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

$array = [
    'paises' => ['Brasil', 'Colombia', 'Venezuela', 'Paraguai', 'Irlanda']
];

$app->get('/', function() use ($app) {
    return $app['twig']->render('index.html.twig');
    return $app['index.controller']->index($app);
})->bind('home');

$app->get('/about', 'index.controller:about')->bind('about');
$app->get('/contact', 'index.controller:contact')->bind('contact');

$app->get('/pais/{nome}', function($nome) use ($app) {
    return new Response(json_encode($app->escape($nome) . ' foi cadastrado.'));
});

$app->get('pais/buscar/{nome}', function ($nome) use ($array) {

   if(false === $search = array_search($nome, $array['paises'])) {
        return new Response(json_encode('Nada encontrado'),  401);
   }
    return new Response(json_encode($nome . ' Foi encontrado'), 200);
});
