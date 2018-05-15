<?php
/**
 * Created by PhpStorm.
 * User: Matt
 * Date: 02/05/2018
 * Time: 13:41
 */

namespace App\Forms;

use App\Entity\Librairie;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class LibType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('type')

            ->add('save', SubmitType::class);
    }
}
