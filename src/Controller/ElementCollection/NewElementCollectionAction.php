<?php

namespace App\Controller\ElementCollection;


use App\Controller\ElementCollection\Interfaces\NewElementCollectionActionInterface;
use App\UI\Form\Type\ElementCollection\NewElementCollectionType;
use App\UI\Form\Handler\Interfaces\NewElementCollectionHandlerInterface;
use App\UI\Responder\Interfaces\NewElementCollectionResponderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

/**
 * Class NewElementCollectionAction
 * @Route("/newElement", name="newElement")
 * @Security("has_role('ROLE_ADMIN')")
 */
class NewElementCollectionAction implements NewElementCollectionActionInterface
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
     * @var NewElementCollectionHandlerInterface
     */
    private $handler;

    /**
     * NewElementCollectionAction constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(
        EncoderFactoryInterface $encoderFactory,
        FormFactoryInterface $formFactory,
        NewElementCollectionHandlerInterface $handler
    ) {
        $this->encoderFactory = $encoderFactory;
        $this->formFactory = $formFactory;
        $this->handler = $handler;
    }


    /**
     * {@inheritdoc}
     */
    public function __invoke(
        Request $request,
        NewElementCollectionResponderInterface $responder
    ) {
        $form = $this->formFactory->create(NewElementCollectionType::class)
                                    ->handleRequest($request);

        if ($this->handler->handle($form)) {
            $request->getSession()->getFlashBag()->add('success', 'L\'élément a bien été créé');
            return $responder(true);
        }

        return $responder(false, $form);
    }
}