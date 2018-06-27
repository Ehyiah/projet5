<?php

namespace App\Controller;


use App\UI\Form\Handler\Interfaces\NewElementCollectionHandlerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

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

    /**
     * @return mixed
     * @Route("/home2", name="home2")
     */
    public function home2()
    {
        return $this->render('home2.html.twig');
    }




    /**
     * @param Request $request
     * @param NewElementCollectionHandlerInterface $newElementCollectionHandler
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route ("/newComment0")

    public function newComment(Request $request, NewElementCollectionHandlerInterface $newElementCollectionHandler)
    {
        $form = $this->createForm(NewCommentType::class)->handleRequest($request);
        if ($newElementCollectionHandler->handle($form)) {
            return $this->redirectToRoute('home');
        }

        return $this->render('Comment/CreateNewComment.html.twig', array('form' => $form->createView()));
    }
    */




    /**
     * test page protégée
     * @Route("/admin")
     */
    public function admin()
    {
        return new Response('<html><body>Admin page!</body></html>');
    }


}