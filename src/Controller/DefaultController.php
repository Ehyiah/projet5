<?php
/**
 * Created by PhpStorm.
 * User: Matt
 * Date: 02/05/2018
 * Time: 16:41
 */

namespace App\Controller;

use App\Controller\LibrairieController;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @return mixed
     * @Route("/home", name="home")
     */
    public function home()
    {



        return $this->render('home.html.twig');
    }
}