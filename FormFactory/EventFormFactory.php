<?php

namespace Lime\CalendarBundle\FormFactory;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormFactory;

class EventFormFactory implements EventFormFactoryInterface
{

    protected $formFactory;
    protected $type;
    protected $name;

    public function __construct(FormFactory $formFactory, $type, $name)
    {
        $this->formFactory  = $formFactory;
        $this->type         = $type;
        $this->name         = $name;
    }

    /**
     * @return Form
     */
    public function createForm()
    {
        $builder = $this->formFactory->createNamedBuilder($this->type, $this->name);

        return $builder->getForm();
    }

}
