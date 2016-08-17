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

$app['menu.repository'] = function () use($app) {
  return $app['orm.em']->getRepository(\App\Entities\menu::class);
};

$app['menus'] = function () use ($app) {
  return $app['menu.repository']->findAll();
};

/***********************************************
 *  API
 **********************************************/

$app['posts.repository'] = function () use ($app) {
  return $app['orm.em']->getRepository(\Api\Entities\Posts::class);
};

$app['posts.links.repository'] = function () use ($app) {
  return $app['orm.em']->getRepository(\Api\Entities\LinksPosts::class);
};

$app['posts.history'] = function () use ($app) {
    return $app['posts.repository']->getMonthHistory();
};

$app['usuarios.repository'] = function () use ($app) {
  return $app['orm.em']->getRepository(\Api\Entities\Usuarios::class);
};


