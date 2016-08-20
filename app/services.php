<?php
/**
 * Created by PhpStorm.
 * User: cesar
 * Date: 30/07/16
 * Time: 09:20
 */

$app['index.controller'] = function() use ($app) {
  return new \Api\Controllers\IndexController();
};

$app['post.controller'] = function() use ($app) {
  return new \Api\Controllers\PostController();
};

$app['menu.controller'] = function () use($app) {
  return new \App\Controllers\MenuController();
};

$app['usuarios.controller'] = function() use ($app) {
  return new \Api\Controllers\UsuariosController();
};

$app['menu.repository'] = function () use($app) {
  return $app['orm.em']->getRepository(\App\Entities\Menu::class);
};

$app['menus'] = function () use ($app) {
  return $app['menu.repository']->findBy(['ativo' => true]);
};

$app['about'] = function () {
  return 'Blog';
};

$app['label.sorted'] = function () {

  $colors = ['danger', 'primary', 'default', 'warning', 'success'];

  shuffle($colors);

  foreach ($colors as $key => $color) {
    return $colors[$key];
  }

};

$app['recents.posts'] = function() use ($app) {
    return $app['posts.repository']->getMostRecents();
};

/***********************************************
 *  API
 **********************************************/

$app['posts.repository'] = function () use ($app) {
  return $app['orm.em']->getRepository(\Api\Entities\Posts::class);
};

$app['tags.repository'] = function () use ($app) {
  return $app['orm.em']->getRepository(\Api\Entities\Tags::class);
};

$app['posts.links.repository'] = function () use ($app) {
  return $app['orm.em']->getRepository(\Api\Entities\LinksPosts::class);
};

$app['posts.history'] = function () use ($app) {
  return array_map(function($archive){
     $archive['month'] = DateTime::createFromFormat('m', $archive['month']);
    return $archive;
  }, $app['posts.repository']->getMonthHistory());

};

$app['usuarios.repository'] = function () use ($app) {
  return $app['orm.em']->getRepository(\Api\Entities\Usuarios::class);
};


