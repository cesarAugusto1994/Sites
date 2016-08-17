<?php
/**
 * Created by PhpStorm.
 * User: cesar
 * Date: 23/07/16
 * Time: 10:38
 */

namespace Security;


use Silex\Application;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;

class FailureHandler implements AuthenticationFailureHandlerInterface
{
    public function __construct(Application $app) {
        $this->app = $app;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        return new JsonResponse(array(
            'type' => 'error',
            'message' => $exception->getMessage(),
            'username' => $this->app['session']->get('_security.last_username'),
        ));
    }
}