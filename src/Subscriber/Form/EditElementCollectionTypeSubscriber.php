<?php

namespace App\Subscriber\Form;


use App\Domain\DTO\AddElementImageDTO;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

final class EditElementCollectionTypeSubscriber implements EventSubscriberInterface
{
    /**
     * @var array
     */
    private $image;


    public static function getSubscribedEvents()
    {
        return [
            FormEvents::POST_SET_DATA => 'onPostSetData',
            FormEvents::SUBMIT => 'onSubmit'
        ];
    }

    public function onPostSetData(FormEvent $event)
    {
        //stock les images deja presentes
        foreach ($event->getForm()->getData()->images as $image) {
            $this->image[] = $image->image;
        }
    }

    public function onSubmit(FormEvent $event)
    {
        if (\is_null($this->image)) {
            return;
        }

        // replace les images déjà présentes dans un tableau
        foreach ($this->image as $imageCollection) {
            $newImage = new AddElementImageDTO($imageCollection);
            $newTab[] = $newImage;
        }

        // tableau d'images nouvelles soumises dans le formulaire
        $tab = $event->getData()->images;

        foreach ($tab as $item) {
            // compte le nombre d'images déjà présentes dans le tableau
            $number = \count($newTab);

            // on complète le tableau contenant les anciennes imags avec les nouvelles images
            if ((!\is_null($item->image)) && ($number < 3) ) {
                $newTab[] = new AddElementImageDTO($item->image);
            }

            /*
            // si plus de 3 images dans le tableau erreur
            if ($number > 3) {
                $event->getForm()->get('title')->addError(new FormError('3 images maximum par éléments'));
            }
            */

        }

        foreach ($event->getData()->images as $oldImage) {
            if ((\is_null($oldImage->image)) && (!\is_null($this->image))) {
                $event->getForm()->getData()->images = $newTab;
            }
        }
    }
}