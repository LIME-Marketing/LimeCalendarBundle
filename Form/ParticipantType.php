<?php

namespace Lime\CalendarBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Lime\CalendarBundle\Model\ParticipantInterface;

class ParticipantType extends AbstractType
{

    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('user', 'lime_calendar.username')
            ->add('role', 'choice', array(
                'choices' => array(
                    ParticipantInterface::ROLE_VIEW => 'View',
                    ParticipantInterface::ROLE_CONTRIBUTE => 'Contribute',
                    ParticipantInterface::ROLE_ADMIN => 'Admin',
                ),
            ));
    }

    public function getName()
    {
        return 'lime_calendar_participant';
    }

}
