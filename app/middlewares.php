<?php
/**
 * Created by PhpStorm.
 * User: cesar
 * Date: 29/07/16
 * Time: 17:12
 */

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

$app->before(function (Request $request) use ($app) {
    $app['twig']->addGlobal('current_page_name', $request->getRequestUri());
});

$app->after(function (Request $request, Response $response) {
    $response->headers->set('Content-type', 'text/json');
});