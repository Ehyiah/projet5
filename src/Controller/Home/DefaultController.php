<?php

namespace App\Controller\Home;


use App\Controller\Home\Interfaces\DefaultControllerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DefaultController
 */
class DefaultController extends Controller implements DefaultControllerInterface
{
    /**
     * {@inheritdoc}
     *
     * @Route("/home", name="home")
     */
    public function __invoke(): Response
    {
        return $this->render('home.html.twig');
    }

    /**
     * @return mixed
     * @Route("/home2", name="home2")
     */
    public function home2()
    {
        return $this->render('home2.html.twig');
    }
}
