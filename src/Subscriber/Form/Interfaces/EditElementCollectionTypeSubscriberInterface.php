<?php

namespace App\Subscriber\Form\Interfaces;


use Symfony\Component\Form\FormEvent;

interface EditElementCollectionTypeSubscriberInterface
{
    /**
     * @return mixed
     */
    public static function getSubscribedEvents();

    /**
     * @param FormEvent $event
     *
     * @return mixed
     */
    public function onPostSetData(FormEvent $event);

    /**
     * @param FormEvent $event
     *
     * @return mixed
     */
    public function onSubmit(FormEvent $event);
}
