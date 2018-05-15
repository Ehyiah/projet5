<?php

namespace App\Controller;

use App\Entity\Librairie;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;



class LibrairieController extends Controller
{

    // AJOUT d'une librairie fixe
    // a modifier pour biblio personnalisée
    /**
     * @Route("/librairie", name="librairie")
     */
    public function index()
    {
        $entityManager = $this->getDoctrine()->getManager();

        $lib = new Librairie();
        $lib->setNom('Test');
        $lib->setType('TypeTest');

        $entityManager->persist($lib);

        $entityManager->flush();




        return $this->render('librairie/index.html.twig', [
            'controller_name' => 'LibrairieController',
        ]);
    }




    /**
     * @Route("/librairie/{id}", name="librairieGet")
     */
    public function ShowLibrairie($id)
    {

        $lib = $this->getDoctrine()
            ->getRepository(Librairie::class)
            ->find($id);

        if (!$lib)
        {
            throw $this->createNotFoundException(
                'pas trouvé librairie ' .$id
            );
        }


        return $this->render('librairie/index.html.twig', ['librairie' => $lib]);


    }

    /**
     * @Route("/product/{id}", name="product_show")
     */



    /**
     * @Route("/updateLib/{id}")
     */
    public function updateLibrairie($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $lib = $entityManager->getRepository(Librairie::class)->find($id);

        if (!$lib)
        {
            throw $this->createNotFoundException(
                'pas trouvé '
            );

        }

        $lib->setNom('Nouveau Nom');
        $entityManager->flush();

        // renvoi à la route appelée product_show
        return $this->redirectToRoute('product_show', [
            'id' => $lib->getId()
        ]);

    }



    /**
     * @Route("/deleteLib/{id}")
     */

    public function deleteLibrairie($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $lib = $entityManager->getRepository(Librairie::class)->find($id);

        $entityManager->remove($lib);

        $entityManager->flush();

        // mauvais retour
        return $this->redirectToRoute('product_show', [
            'id' => $lib->getId()
        ]);
    }


    /**
     * @Route("/listLib")
     */
    public function listLib()
    {
        $libs = $this->getDoctrine()
            ->getRepository(Librairie::class)
            ->listLib();

        return $this->render('librairie/listLib.html.twig', ['Librairie' => $libs]);
    }
}
