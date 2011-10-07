<?php

namespace Lime\CalendarBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Lime\CalendarBundle\Model\EventInterface;

class EventType extends AbstractType
{

    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('name')
            ->add('description')
            ->add('start_date', 'datetime')
            ->add('end_date', 'datetime')
            ->add('visibility', 'choice', array(
                'choices' => array(
                    EventInterface::VISIBILITY_HIDDEN   => 'Hidden',
                    EventInterface::VISIBILITY_PRIVATE  => 'Private',
                    EventInterface::VISIBILITY_PUBLIC   => 'Public',
                ),
            ));
    }

    public function getName()
    {
        return 'lime_calendar_event';
    }

}
