<?php

namespace Lime\CalendarBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Lime\CalendarBundle\Model\MembershipInterface;

class MembershipType extends AbstractType
{

    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('user', 'lime_calendar.username')
            ->add('role', 'choice', array(
                'choices' => array(
                    MembershipInterface::ROLE_VIEW => 'View',
                    MembershipInterface::ROLE_CONTRIBUTE => 'Contribute',
                    MembershipInterface::ROLE_ADMIN => 'Admin',
                ),
            ));
    }

    public function getName()
    {
        return 'lime_calendar_membership';
    }

}
