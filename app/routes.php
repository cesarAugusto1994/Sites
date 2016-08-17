<?php
/**
 * Created by PhpStorm.
 * User: cesar
 * Date: 30/07/16
 * Time: 10:02
 */

$app->get('/', 'index.controller:index')->bind('home');

$app->get('/post/{postId}/{postTitulo}', function ($postId, $postTitulo) use ($app){
    return $app['post.controller']->post($postId, $app);
})->bind('post');

$app->get('postForm', function () use ($app) {
    return $app['twig']->render('/admin/newpost.html.twig');
})->bind('postForm');

$app->post('newPost', function (\Symfony\Component\HttpFoundation\Request $request) use ($app) {
    return $app['post.controller']->criar($request, $app);
})->bind('newPost');

$app->get('/about', 'index.controller:about')->bind('about');
$app->get('/contact', 'index.controller:contact')->bind('contact');

$app->get('/login', function(\Symfony\Component\HttpFoundation\Request $request) use ($app) {
    return $app['index.controller']->login($request, $app);
})->bind('login');

$app->post('/admin/login_check', 
    function(\Symfony\Component\HttpFoundation\Request $request) use($app) {

})->bind('login_check');

$app->get('go', function () {
    return new \Symfony\Component\HttpFoundation\Response('GO');
});