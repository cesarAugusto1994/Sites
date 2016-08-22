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
$app->get('/events', function(){})->bind('events');

include __DIR__.'/routes/post.php';
include __DIR__.'/routes/menu.php';
include __DIR__.'/routes/user.php';
include __DIR__.'/routes/access.php';