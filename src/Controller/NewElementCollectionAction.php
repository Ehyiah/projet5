<?php

namespace App\Controller;


use App\Form\ElementCollectionType;
use App\UI\Form\Handler\Interfaces\NewElementCollectionHandlerInterface;
use App\UI\Responder\NewElementCollectionResponder;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

/**
 * Class NewElementCollectionAction
 * @package App\Controller
 * @Route("/newElement", name="newElement")
 */
class NewElementCollectionAction
{
    /**
     * @var EncoderFactoryInterface
     */
    private $encoderFactory;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * NewElementCollectionAction constructor.
     * @param EncoderFactoryInterface $encoderFactory
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(EncoderFactoryInterface $encoderFactory, FormFactoryInterface $formFactory)
    {
        $this->encoderFactory = $encoderFactory;
        $this->formFactory = $formFactory;
    }

    /**
     * @param Request $request
     * @param NewElementCollectionHandlerInterface $newElementCollectionHandler
     * @param NewElementCollectionResponder $responder
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(Request $request, NewElementCollectionHandlerInterface $newElementCollectionHandler, NewElementCollectionResponder $responder)
    {
        $form = $this->formFactory->create(ElementCollectionType::class)->handleRequest($request);

        if ($newElementCollectionHandler->handle($form)) {
            return $responder(true);
        }

        return $responder(false, $form);
    }
}