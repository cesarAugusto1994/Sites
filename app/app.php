<?php
/**
 * Created by PhpStorm.
 * User: cesar
 * Date: 29/07/16
 * Time: 16:04
 */
use Silex\Application;

require __DIR__.'/../vendor/autoload.php';

$app = new Application();

$app['debug'] = true;

include_once __DIR__.'/../app/providers.php';
include_once __DIR__.'/../app/services.php';
//include_once __DIR__.'/../app/middlewares.php';
include_once __DIR__.'/../app/routes.php';

return $app;