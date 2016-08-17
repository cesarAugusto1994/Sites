<?php
/**
 * Created by PhpStorm.
 * User: cesar
 * Date: 01/08/16
 * Time: 15:58
 */

namespace Api\Controllers;

use Api\Entities\Posts;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class PostController
 * @package Api\Controllers
 */
class PostController
{
    /**
     * @param int $id
     * @param Application $app
     * @return mixed
     */
    public function post($id, Application $app)
    {
        return $app['twig']->render('post.html.twig', [
            'post' => $app['posts.repository']->find($id),
            'links' => $app['posts.links.repository']->findBy(['post' => $id])
        ]);
    }
    
    /**
     * @param Request $request
     * @param Application $app
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function criar(Request $request, Application $app)
    {
        $post = new Posts();
        $usuario = $app['usuarios.repository']->find(1);
        $dataCadastro = new \DateTime();
        
        $post->setTitulo($request->get('titulo'));
        $post->setDescricao($request->get('descricao'));
        $post->setCadastro($dataCadastro);
        $post->setDataCadastro($dataCadastro->format('Ym'));
        $post->setUsuario($usuario);
        $post->setAtivo(true);

        $app['posts.repository']->save($post);
        
        return $app->redirect('post/'.$post->getId().'/'.$request->get('titulo'));
    }
}