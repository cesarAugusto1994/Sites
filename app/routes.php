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

$app->get('grid_posts/', function() use ($app) {
    return $app['twig']->render('admin/grid_posts.html.twig', [
        'posts' => $app['posts.repository']->findBy([], ['cadastro' => 'DESC'])
    ]);
})->bind('grid_posts');

$app->get('postForm', function () use ($app) {
    return $app['twig']->render('/admin/newpost.html.twig');
})->bind('postForm');

$app->post('newPost', function (\Symfony\Component\HttpFoundation\Request $request) use ($app) {
    return $app['post.controller']->criar($request, $app);
})->bind('newPost');

$app->get('edit_post/{id}/{name}', function($id, $name) use ($app) {
    return $app['post.controller']->editarPost($id, $app);
})->bind('edit_post');

$app->post('save_edit_post', function(\Symfony\Component\HttpFoundation\Request $request) use ($app) {
    return $app['post.controller']->editar($request, $app);
})->bind('save_edit_post');

$app->get('status_post/{id}', function($id) use ($app) {
    return $app['post.controller']->alterarStatus((int)$id, $app);
})->bind('status_post');

$app->get('tag/{tag}', function($tag) use ($app) {
    return $app['post.controller']->postsByTags($tag, $app);
})->bind('tag');

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

$app->get('/admin/logout', function() use($app){
    $app['session']->remove('user');
})->bind('logout');

$app->get('/admin/', function() use ($app) {
    if(isset($app['user'])) {
        $app['session']->set('user', $app['user']);
        $app['session']->save();
    }
    return $app->redirect('/');
})->bind('admin');

$app->get('/search', function (\Symfony\Component\HttpFoundation\Request $request) use ($app) {
    return $app['post.controller']->search($request->get('q'), $app);
})->bind('search');

/**
 * Menu Blog
 */

$app->get('menu', function() use ($app) {
    return $app['menu.controller']->index($app);
})->bind('menu');

$app->post('novo_menu', function(\Symfony\Component\HttpFoundation\Request $request) use ($app) {
    return $app['menu.controller']->criar($request, $app);
})->bind('novo_menu');

$app->post('edit_menu', function(\Symfony\Component\HttpFoundation\Request $request) use ($app) {
    return $app['menu.controller']->editar($request, $app);
})->bind('novo_menu');

$app->get('edit_menu/{id}', function($id) use ($app) {
    return $app['twig']->render('admin/edit_blog_menu.html.twig', ['menu' => $app['menu.repository']->find($id)]);
})->bind('edit_menu');

$app->post('save_edit_menu', function(\Symfony\Component\HttpFoundation\Request $request) use ($app) {
    return $app['menu.controller']->editar($request, $app);
})->bind('save_edit_menu');

$app->get('alterar_suatus_menu/{id}', function($id) use ($app) {
    return $app['menu.controller']->alterarStatus((int)$id, $app);
})->bind('alterar_suatus_menu');

$app->get('events', function(){

})->bind('events');

$app->get('go', function () {
    return new \Symfony\Component\HttpFoundation\Response('GO');
});