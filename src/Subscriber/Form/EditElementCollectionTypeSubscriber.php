<?php

namespace App\Subscriber\Form;


use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
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
            FormEvents::SUBMIT => 'onSubmit'
        ];
    }

    public function onPostSetData(FormEvent $event)
    {
        foreach ($event->getForm()->getData()->images as $image) {
            $this->image[] = $image;
        }
        dump($event);
    }

    public function onSubmit(FormEvent $event)
    {
        dump($event);
        //die();
    }
}