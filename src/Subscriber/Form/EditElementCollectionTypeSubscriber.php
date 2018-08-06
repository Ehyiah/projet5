<?php

namespace App\Subscriber\Form;


use Symfony\Component\EventDispatcher\EventSubscriberInterface;
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
            $this->image[] = $image;
        }

    }

    public function onPreSubmit(FormEvent $event)
    {

    }

    public function onSubmit(FormEvent $event)
    {
        dump($event);
        // si pas de nouvelles images on conserve les anciennes
        if (($event->getData()->images == null) && ($this->image != null)) {
            $event->getForm()->getData()->images = $this->image;
        }

        dump($event);
        //die();





    }
}