<?php

namespace Lime\CalendarBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Lime\CalendarBundle\Model\CalendarInterface;

class CalendarType extends AbstractType
{

    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('name')
            ->add('description')
            ->add('visibility', 'choice', array(
                'choices' => array(
                    CalendarInterface::VISIBILITY_HIDDEN    => 'Hidden',
                    CalendarInterface::VISIBILITY_PRIVATE   => 'Private',
                    CalendarInterface::VISIBILITY_PUBLIC    => 'Public',
                ),
            ));
    }

    public function getName()
    {
        return 'lime_calendar_calendar';
    }

}
