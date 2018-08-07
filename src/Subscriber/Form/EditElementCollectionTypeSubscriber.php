<?php

namespace App\Subscriber\Form;


use App\Domain\DTO\AddElementImageDTO;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class EditElementCollectionTypeSubscriber implements EventSubscriberInterface
{
    /**
     * @var array
     */
    private $image;


    public static function getSubscribedEvents()
    {
        return [
            FormEvents::POST_SET_DATA => 'onPostSetData',
            FormEvents::PRE_SUBMIT => 'onPreSubmit',
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

    public function onPreSubmit(FormEvent $event)
    {

    }

    public function onSubmit(FormEvent $event)
    {
        foreach ($this->image as $imageCollection) {
            $newImage = new AddElementImageDTO($imageCollection);
            $newTab[] = $newImage;
        }

        // tableaux d'images
        $tab = $event->getData()->images;

        foreach ($tab as $item) {
            $number = count($newTab);
            dump($number);
            if ( ($item->image != null) && ($number < 3) ) {
                $newTab[] = new AddElementImageDTO($item->image);
            }
        }

        foreach ($event->getData()->images as $oldImage) {
            if (($oldImage->image == null) && ($this->image != null)) {
                $event->getForm()->getData()->images = $newTab;
            }
        }

    }
}