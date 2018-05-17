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
use App\Form\CategoryType;
use App\Form\CollectionType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route ("/home2")
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
}