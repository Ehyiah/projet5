<?php

namespace App\Controller;


use App\Form\CategoryType;
use App\Form\CollectionType;
use App\Form\CommentType;
use App\Form\ElementCollectionType;
use App\Form\ImageCollectionType;
use App\UI\Form\Handler\Interfaces\NewCategoryCollectionHandlerInterface;
use App\UI\Form\Handler\Interfaces\NewCollectionHandlerInterface;
use App\UI\Form\Handler\Interfaces\NewElementCollectionHandlerInterface;
use App\UI\Form\Handler\Interfaces\NewImageHandlerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

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
     * @param NewCategoryCollectionHandlerInterface $categoryCollectionHandler
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route ("newCategory")
     */
    public function form(Request $request, NewCategoryCollectionHandlerInterface $categoryCollectionHandler)
    {
        $form = $this->createForm(CategoryType::class)->handleRequest($request);
        if ($categoryCollectionHandler->handle($form)) {
            return $this->redirectToRoute('home');
        }

        return $this->render('Category/CreateNewCategory.html.twig', array('form' => $form->createView()));
    }

    /**
     * @param Request $request
     * @param NewCollectionHandlerInterface $collectionHandler
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route ("/newCollection")
     */
    public function form2(Request $request, NewCollectionHandlerInterface $collectionHandler)
    {
        $form = $this->createForm(CollectionType::class)->handleRequest($request);

        if ($collectionHandler->handle($form)) {
            return $this->redirectToRoute('home');
        }

        return $this->render('Category/CreateNewCategory.html.twig', array('form' => $form->createView()));
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
     * @param Request $request
     * @param NewElementCollectionHandlerInterface $newElementCollectionHandler
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route ("/newElement")
     */
    public function newElement(Request $request, NewElementCollectionHandlerInterface $newElementCollectionHandler)
    {
        $form = $this->createForm(ElementCollectionType::class)->handleRequest($request);

        if ($newElementCollectionHandler->handle($form)) {
            return $this->redirectToRoute('home');
        }

        return $this->render('ElementCollection/CreateNewElementCollection.html.twig', array('form' => $form->createView()));
    }

    /**
     * @param Request $request
     * @param NewImageHandlerInterface $newImageHandler
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route ("/newImage")
     */
    public function newImage(Request $request, NewImageHandlerInterface $newImageHandler)
    {
        $form = $this->createForm(ImageCollectionType::class)->handleRequest($request);

        if ($newImageHandler->handle($form)) {
            return $this->redirectToRoute('home');
        }

        return $this->render('Image/CreateNewImage.html.twig', array('form' => $form->createView()));
    }

    /**
     * @param Request $request
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     * @Route ("/login", name="login")
     */
    public function login(Request $request, AuthenticationUtils $authenticationUtils)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
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