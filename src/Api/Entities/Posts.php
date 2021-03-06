<?php
/**
 * Created by PhpStorm.
 * User: cesar
 * Date: 01/08/16
 * Time: 09:51
 */

namespace Api\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Posts
 * @package Api\Entities
 * @ORM\Table(name="posts")
 * @ORM\Entity(repositoryClass="Api\Repositories\PostsRepository")
 */
class Posts
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer
     */
    private $id;

    /**
     * @ORM\Column(name="titulo", type="string")
     * @var string
     */
    private $titulo;

    /**
     * @ORM\Column(name="descricao", type="text")
     * @var string
     */
    private $descricao;

    /**
     * @ORM\Column(name="conteudo", type="text")
     * @var string
     */
    private $conteudo;

    /**
     * @ORM\Column(name="cadastro", type="datetime")
     * @var \DateTime
     */
    private $cadastro;

    /**
     * @ORM\Column(name="year", type="string")
     * @var string
     */
    private $year;

    /**
     * @ORM\Column(name="month", type="string")
     * @var string
     */
    private $month;

    /**
     * @ORM\Column(name="atualizado", type="datetime")
     * @var \DateTime
     */
    private $atualizado;

    /**
     * @ORM\ManyToOne(targetEntity="Usuarios")
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     * @var Usuarios
     */
    private $usuario;

    /**
     * @ORM\Column(name="ativo", type="smallint")
     * @var integer
     */
    private $ativo;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * @param mixed $titulo
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    /**
     * @return mixed
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param mixed $descricao
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }
    
    /**
     * @return string
     */
    public function getConteudo()
    {
        return $this->conteudo;
    }
    
    /**
     * @param string $conteudo
     */
    public function setConteudo($conteudo)
    {
        $this->conteudo = $conteudo;
    }
    
    /**
     * @return mixed
     */
    public function getCadastro()
    {
        return $this->cadastro;
    }

    /**
     * @param mixed $cadastro
     */
    public function setCadastro($cadastro)
    {
        $this->cadastro = $cadastro;
    }

    /**
     * @return string
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param string $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * @return mixed
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * @param mixed $month
     */
    public function setMonth($month)
    {
        $this->month = $month;
    }
    
    /**
     * @return \DateTime
     */
    public function getAtualizado()
    {
        return $this->atualizado;
    }
    
    /**
     * @param \DateTime $atualizado
     */
    public function setAtualizado($atualizado)
    {
        $this->atualizado = $atualizado;
    }

    /**
     * @return mixed
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @param mixed $usuario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * @return mixed
     */
    public function isAtivo()
    {
        return $this->ativo;
    }

    /**
     * @param mixed $ativo
     */
    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;
    }
}