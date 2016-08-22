<?php
/**
 * Created by PhpStorm.
 * User: cesar
 * Date: 22/08/16
 * Time: 09:31
 */

$app->get('/search', function (\Symfony\Component\HttpFoundation\Request $request) use ($app) {
    return $app['post.controller']->search($request->get('q'), $app);
})->bind('search');

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