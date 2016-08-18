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

$app->get('/archives/{year}', function($year) use ($app){
    return $app['post.controller']->postsByYear($year, $app);
})->bind('archives')->value('year', 2016);

$app->get('/author/{author}/{name}', function($author, $name) use ($app){
    return $app['post.controller']->postsByAuthor($author, $app);
})->bind('author')->value('name', 'Usuario');

$app->get('/archives/{year}/{month}', function($year, $month) use ($app){
    return $app['post.controller']->postsByYearAndMonth($year, $month, $app);
})->bind('archives_by_year_month')->value('year', 2016);

$app->get('/about', 'index.controller:about')->bind('about');
$app->get('/contact', 'index.controller:contact')->bind('contact');

$app->get('profile/{user}', function($user) use($app) {
    return $app['usuarios.controller']->getUser(1, $app);
})->bind('profile')->value('user', 1);

$app->get('/login', function(\Symfony\Component\HttpFoundation\Request $request) use ($app) {
    return $app['index.controller']->login($request, $app);
})->bind('login');

$app->post('/admin/login_check', 
    function(\Symfony\Component\HttpFoundation\Request $request) use($app) {

})->bind('login_check');

$app->get('go', function () {
    return new \Symfony\Component\HttpFoundation\Response('GO');
});