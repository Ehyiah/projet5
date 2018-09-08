<?php

namespace App\Controller\Category;


use App\Controller\Category\Interfaces\NewCategoryCollectionActionInterface;
use App\UI\Form\Handler\Interfaces\NewCategoryCollectionHandlerInterface;
use App\UI\Form\Type\Category\CategoryType;
use App\UI\Responder\NewImageCollectionResponder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class NewCategoryCollectionAction
 * @Route ("/newCategory", name="newCategory")
 * @Security("has_role('ROLE_ADMIN')")
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
     * @var NewCategoryCollectionHandlerInterface
     */
    private $formHandler;

    /**
     * NewCategoryCollectionAction constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(
        EncoderFactoryInterface $encoderFactory,
        FormFactoryInterface $formFactory,
        NewCategoryCollectionHandlerInterface $formHandler
    ) {
        $this->encoderFactory = $encoderFactory;
        $this->formFactory = $formFactory;
        $this->formHandler = $formHandler;
    }


    /**
     * {@inheritdoc}
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(
        Request $request,
        NewImageCollectionResponder $responder
    ) {
        $form = $this->formFactory->create(CategoryType::class)
                                    ->handleRequest($request);

        if ($this->formHandler->handle($form)) {
            $request->getSession()->getFlashBag()->add('success', 'Nouvelle catégorie créée');
            return $responder(true);
        }

        return $responder (false, $form);
    }
}
