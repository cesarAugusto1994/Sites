<?php
/**
 * Created by PhpStorm.
 * User: cesar
 * Date: 01/08/16
 * Time: 15:58
 */

namespace Api\Controllers;

use Api\Entities\Posts;
use Api\Entities\Tags;
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
        $post = $app['posts.repository']->findBy(['id' => $id, 'ativo' => true]);
        $tags = $app['tags.repository']->findBy(['post' => $id]);
        $links = $app['posts.links.repository']->findBy(['post' => $id]);

        return $app['twig']->render('post.html.twig', [
            'post' => current($post),
            'tags' => $tags,
            'links' => $links
        ]);
    }

    /**
     * @param $year
     * @param Application $app
     * @return mixed
     */
    public function postsByYear($year, Application $app)
    {
        return $app['twig']->render('index.html.twig', [
            'posts' => $app['posts.repository']->findBy(['year' => $year, 'ativo' => true], ['cadastro' => 'DESC']),
        ]);
    }

    /**
     * @param $year
     * @param $month
     * @param Application $app
     * @return mixed
     */
    public function postsByYearAndMonth($year, $month, Application $app)
    {
        return $app['twig']->render('index.html.twig', [
            'posts' => $app['posts.repository']->findBy(['year' => $year, 'month' => $month, 'ativo' => true], ['cadastro' => 'DESC']),
        ]);
    }

    /**
     * @param $author
     * @param Application $app
     * @return mixed
     */
    public function postsByAuthor($author, Application $app)
    {
        return $app['twig']->render('index.html.twig', [
            'posts' => $app['posts.repository']->findBy(['usuario' => $author, 'ativo' => true], ['cadastro' => 'DESC']),
        ]);
    }

    /**
     * @param int $tag
     * @param Application $app
     * @return mixed
     */
    public function postsByTags($tag, Application $app)
    {
        $tags = $app['tags.repository']->findByName($tag);
        $posts = [];

        foreach ($tags as $tag) {
            $posts[] = $tag->getPost();
        }

        return $app['twig']->render('index.html.twig', [
            'posts' => $posts,
        ]);
    }

    /**
     * @param string $search
     * @param Application $app
     * @return mixed
     */
    public function search($search, Application $app)
    {
        return $app['twig']->render('index.html.twig', [
            'posts' => $app['posts.repository']->search($search),
        ]);
    }
    
    /**
     * @param int $id
     * @param Application $app
     * @return mixed
     */
    public function editarPost($id, Application $app)
    {
        return $app['twig']->render('admin/edit_post.html.twig', [
            'post' => $app['posts.repository']->find($id),
        ]);
    }
    
    /**
     * @param Request $request
     * @param Application $app
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function editar(Request $request, Application $app)
    {
        /**
         * Posts $post
         */
        $post = $app['posts.repository']->find($request->get('id'));

        $post->setTitulo($request->get('titulo'));
        $post->setDescricao($request->get('descricao'));
        $post->setConteudo(strip_tags($request->get('descricao')));
        $post->setAtualizado(new \DateTime('now'));

        $app['posts.repository']->save($post);

        return $app->redirect('post/'.$post->getId().'/'.substr($post->getTitulo(), 0, 30));
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

        $arrTags = explode(',', $request->get('tags'));

        foreach ($arrTags as $tag) {
            $tags = new Tags();
            $tags->setPost($post);
            $tags->setNome($tag);
            $app['tags.repository']->save($tags);
        }
        
        return $app->redirect('post/'.$post->getId().'/'.substr($post->getTitulo(), 0, 30));
    }
    
    /**
     * @param int $id
     * @param Application $app
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
        public function alterarStatus($id, Application $app)
    {
        /**
         * Posts $post
         */
        $post = $app['posts.repository']->find($id);
        $post->setAtualizado(new \DateTime('now'));

        if ($post->isAtivo() == true) {
            $post->setAtivo(false);
        } else {
            $post->setAtivo(true);
        }
    
        $app['posts.repository']->save($post);
    
        return $app->redirect('/grid_posts');
    }
}