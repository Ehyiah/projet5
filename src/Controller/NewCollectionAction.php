<?php

namespace App\Controller;


use App\UI\Form\Type\Collection\CreateCollectionType;
use App\UI\Form\Handler\Interfaces\NewCollectionHandlerInterface;
use App\UI\Responder\NewCollectionResponder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

/**
 * Class NewCollectionAction
 * @package App\Controller
 * @Route("/newCollection", name="newCollection")
 * @Security("has_role('ROLE_USER')")
 */
class NewCollectionAction
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
     * NewCollectionAction constructor.
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
     * @param NewCollectionHandlerInterface $collectionHandler
     * @param NewCollectionResponder $responder
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(
        Request $request,
        NewCollectionHandlerInterface $collectionHandler,
        NewCollectionResponder $responder
    ) {
        $form = $this->formFactory->create(CreateCollectionType::class)->handleRequest($request);

        if ($collectionHandler->handle($form)) {
            return $responder(true);
        }

        return $responder(false, $form);
    }
}