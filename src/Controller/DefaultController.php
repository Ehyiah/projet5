<?php
/**
 * Created by PhpStorm.
 * User: Matt
 * Date: 02/05/2018
 * Time: 16:41
 */

namespace App\Controller;

use App\Entity\CategoryCollection;
use App\Entity\Collection;
use App\Entity\Comment;
use App\Entity\ElementCollection;
use App\Entity\ImageCollection;

use App\Form\CategoryType;
use App\Form\CollectionType;
use App\Form\CommentType;
use App\Form\ElementCollectionType;
use App\Form\ImageCollectionType;
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
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route ("newCategory")
     */
    public function form(Request $request)
    {
        $form = $this->createForm(CategoryType::class)->handleRequest($request);
        if ($form->isSubmitted() && ($form->isValid())) {
            $category = new CategoryCollection($form->getData());
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('Category/CreateNewCategory.html.twig', array('form' => $form->createView()));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route ("/newCollection")
     */
    public function form2(Request $request)
    {
        $form = $this->createForm(CollectionType::class)->handleRequest($request);

        if ($form->isSubmitted() && ($form->isValid())) {
            $collection = new Collection($form->getData());
            $em = $this->getDoctrine()->getManager();
            $em->persist($collection);
            $em->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('Category/CreateNewCategory.html.twig', array('form' => $form->createView()));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route ("/newComment")
     */
    public function newComment(Request $request)
    {
        $form = $this->createForm(CommentType::class)->handleRequest($request);

        if ($form->isSubmitted() && ($form->isValid())) {
            $comment = new Comment($form->getData());
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('Comment/CreateNewComment.html.twig', array('form' => $form->createView()));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route ("/newElement")
     */
    public function newElement(Request $request)
    {
        $form = $this->createForm(ElementCollectionType::class)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $element = new ElementCollection($form->getData());
            $em = $this->getDoctrine()->getManager();
            $em->persist($element);
            $em->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('ElementCollection/CreateNewElementCollection.html.twig', array('form' => $form->createView()));
    }

        /**
         * test connexion prompt
         * @Route("/admin")
         */
        public function admin()
    {
        return new Response('<html><body>Admin page!</body></html>');
    }



    /**
     * @param Request $request
     * @return Response
     * @Route ("/newImage")
     */
    public function newImage(Request $request)
    {
        $form = $this->createForm(ImageCollectionType::class)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $image = new ImageCollection($form->getData());
            $em = $this->getDoctrine()->getManager();
            $em->persist($image);
            $em->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('Image/CreateNewImage.html.twig', array('form' => $form->createView()));
    }
}