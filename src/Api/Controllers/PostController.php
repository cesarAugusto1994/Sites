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
    
    public function postsByYear($year, Application $app)
    {
        return $app['twig']->render('index.html.twig', [
            'posts' => $app['posts.repository']->findBy(['year' => $year], ['cadastro' => 'DESC']),
        ]);
    }
    
    public function postsByYearAndMonth($year, $month, Application $app)
    {
        return $app['twig']->render('index.html.twig', [
            'posts' => $app['posts.repository']->findBy(['year' => $year, 'month' => $month], ['cadastro' => 'DESC']),
        ]);
    }
    
    public function postsByAuthor($author, Application $app)
    {
        return $app['twig']->render('index.html.twig', [
            'posts' => $app['posts.repository']->findBy(['usuario' => $author], ['cadastro' => 'DESC']),
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
        $post->setConteudo(strip_tags($request->get('descricao')));
        $post->setCadastro($dataCadastro);
        $post->setYear($dataCadastro->format('Y'));
        $post->setMonth($dataCadastro->format('m'));
        $post->setUsuario($usuario);
        $post->setAtivo(true);

        $app['posts.repository']->save($post);
        
        return $app->redirect('post/'.$post->getId().'/'.substr($post->getTitulo(), 0, 20));
    }
}