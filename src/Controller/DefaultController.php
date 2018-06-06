<?php

namespace App\Controller;


use App\Form\CommentType;
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
     * @param Request $request
     * @param NewElementCollectionHandlerInterface $newElementCollectionHandler
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route ("/newComment")
     */
    public function newComment(Request $request, NewElementCollectionHandlerInterface $newElementCollectionHandler)
    {
        $form = $this->createForm(CommentType::class)->handleRequest($request);
        if ($newElementCollectionHandler->handle($form)) {
            return $this->redirectToRoute('home');
        }

        return $this->render('Comment/CreateNewComment.html.twig', array('form' => $form->createView()));
    }





    /**
     * test connexion prompt
     * @Route("/admin")
     */
    public function admin()
    {
        return new Response('<html><body>Admin page!</body></html>');
    }


}