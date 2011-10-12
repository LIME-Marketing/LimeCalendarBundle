<?php

namespace Lime\CalendarBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\FormBuilder;

class UsernameType extends AbstractType
{

    protected $usernameTransformer;

    public function __construct(DataTransformerInterface $usernameTransformer)
    {
        $this->usernameTransformer = $usernameTransformer;
    }

    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->appendClientTransformer($this->usernameTransformer);
    }

    public function getParent(array $options)
    {
        return 'text';
    }

    public function getName()
    {
        return 'lime_calendar_username';
    }

}
