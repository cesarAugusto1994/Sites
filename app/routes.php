<?php
/**
 * Created by PhpStorm.
 * User: cesar
 * Date: 30/07/16
 * Time: 10:02
 */

$app->get('/', 'index.controller:index')->bind('home');
$app->get('/about', 'index.controller:about')->bind('about');
$app->get('/contact', 'index.controller:contact')->bind('contact');
$app->get('/events')->bind('events');

include __DIR__.'/routes/post.php';
include __DIR__.'/routes/menu.php';
include __DIR__.'/routes/user.php';
include __DIR__.'/routes/access.php';

$app->error(function (\Exception $e, $code) use ($app) {

    switch ($e->getCode()) {
        case 400 :
            $message = 'Bad request.';
            break;
        case 401 :
            $message = 'Page not found.';
            break;
        default:
            $message = 'Arquivo não existente.';
            break;
    }

    return $app['twig']->render('error.html.twig', ['error' => $message, 'message' => $e->getMessage()]);
});