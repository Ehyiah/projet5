<?php

namespace App\Controller;


use App\UI\Form\Type\Comment\NewCommentType;
use App\UI\Form\Handler\Interfaces\NewCommentHandlerInterface;
use App\UI\Responder\NewCommentResponder;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

/**
 * Class NewCommentAction
 * @package App\Controller
 * @Route("/newComment", name="newComment")
 */
class NewCommentAction
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
     * NewCommentAction constructor.
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
     * @param NewCommentHandlerInterface $commentHandler
     * @param NewCommentResponder $responder
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(Request $request, NewCommentHandlerInterface $commentHandler, NewCommentResponder $responder)
    {
        $form = $this->formFactory->create(NewCommentType::class)->handleRequest($request);

        if ($commentHandler->handle($form)) {
            return $responder(true);
        }

        return $responder (false, $form);
    }
}