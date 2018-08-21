<?php

namespace App\Controller;


use App\UI\Form\Type\Image\ImageCollectionType;
use App\UI\Form\Handler\Interfaces\NewImageHandlerInterface;
use App\UI\Responder\NewImageCollectionResponder;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

/**
 * Class NewImageAction
 * @Route("/newImage", name="newImage")
 */
class NewImageAction
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
     * NewImageAction constructor.
     *
     * @param EncoderFactoryInterface $encoderFactory
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(
        EncoderFactoryInterface $encoderFactory,
        FormFactoryInterface $formFactory
    ) {
        $this->encoderFactory = $encoderFactory;
        $this->formFactory = $formFactory;
    }

    /**
     * @param Request $request
     * @param NewImageHandlerInterface $imageHandler
     * @param NewImageCollectionResponder $responder
     * @return RedirectResponse|Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(
        Request $request,
        NewImageHandlerInterface $imageHandler,
        NewImageCollectionResponder $responder
    ) {
        $form = $this->formFactory->create(ImageCollectionType::class)->handleRequest($request);

        if ($imageHandler->handle($form)) {
            return $responder(true);
        }

        return $responder(false, $form);
    }
}
