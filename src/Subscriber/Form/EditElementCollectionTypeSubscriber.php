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
        foreach ($event->getForm()->getData()->images as $image) {
            $this->image[] = $image;
        }

        dump($this->image);

        dump($event);
        //die();

    }

    public function onPreSubmit(FormEvent $event)
    {
        dump($event);
        //die();
    }

    public function onSubmit(FormEvent $event)
    {
        dump($event);
        dump($this->image);
        die();
        if (empty($event->getData()->images) && ($this->image != null)) {
            foreach ($this->image as $img) {
                $event->getForm()->getData()->images[] = $img;
            }
        }

        dump($event);
        //dump($event->getData()->images);

    }
}