<?php

/**
 * Created by PhpStorm.
 * User: cesar
 * Date: 20/07/16
 * Time: 11:08
 */

namespace Security;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class Security
 * @package Security
 */
class Security
{
    /**
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function login(Request $request, Application $app)
    {
        return $app['twig']->render('login.twig', array(
            'error'         => $app['security.last_error']($request),
            'last_username' => $app['session']->get('_security.last_username'),
        ));
    }

    public function loginCheck()
    {
        
    }
    
    public function logout()
    {
        
    }
}