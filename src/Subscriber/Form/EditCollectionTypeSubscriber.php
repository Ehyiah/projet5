<?php

namespace App\Subscriber\Form;


use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class EditCollectionTypeSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            FormEvents::POST_SET_DATA => 'onPostSetData',
            FormEvents::PRE_SUBMIT => 'onPreSubmit'
        ];
    }


    public function onPostSetData(FormEvent $event)
    {

        dump($event);
    }

    public function onPreSubmit(FormEvent $event)
    {
        dump($event);
        die();
    }
}