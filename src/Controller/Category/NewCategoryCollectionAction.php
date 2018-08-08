<?php

namespace App\Controller\Category;


use App\Controller\Category\Interfaces\NewCategoryCollectionActionInterface;
use App\UI\Form\Handler\Interfaces\NewCategoryCollectionHandlerInterface;
use App\UI\Form\Type\Security\PasswordRecoverInputType;
use App\UI\Responder\NewImageCollectionResponder;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class NewCategoryCollectionAction
 * @package App\Controller
 * @Route ("/newCategory", name="newCategory")
 */
class NewCategoryCollectionAction implements NewCategoryCollectionActionInterface
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
     * NewCategoryCollectionAction constructor.
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
     * @param NewCategoryCollectionHandlerInterface $categoryCollectionHandler
     * @param NewImageCollectionResponder $responder
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(
        Request $request,
        NewCategoryCollectionHandlerInterface $categoryCollectionHandler,
        NewImageCollectionResponder $responder
    ) {
        $form = $this->formFactory->create(PasswordRecoverInputType::class)
                                    ->handleRequest($request);

        if ($categoryCollectionHandler->handle($form)) {
            return $responder(true);
        }

        return $responder (false, $form);
    }
}