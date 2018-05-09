<?php
/**
 * Created by PhpStorm.
 * User: Matt
 * Date: 02/05/2018
 * Time: 11:21
 */

namespace App\Controller;

use App\Entity\Librairie;
use App\Forms\LibType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
Use Symfony\Component\HttpFoundation\Request;




class NewLib extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/newLib", name="newLib")
     */

    public function new(Request $request)
    {
        // on instancie une nouvelle librairie entity
        $lib = new Librairie();


        $form = $this->createForm(LibType::class, $lib);

        // traitement formulaire

        $form->handleRequest($request);

        if ($form->isSubmitted() && ($form->isValid()))
        {
            $lib = $form->getData();

            // actions à effectuer comme sauvegarde dans BDD
             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($lib);
             $entityManager->flush();

             // redirection aprés traitement formulaire
             return $this->redirectToRoute('newLib');
        }



        // affichage page formulaire
        return $this->render('CreateNewLib/CreateNewLib.html.twig', array('form' => $form->createView()));

    }

}