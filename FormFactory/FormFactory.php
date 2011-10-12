<?php

namespace Lime\CalendarBundle\FormFactory;

use Symfony\Component\Form\FormFactoryInterface as BaseFormFactoryInterface;
use Symfony\Component\Form\Form;

class FormFactory implements FormFactoryInterface
{

    protected $formFactory;
    protected $type;
    protected $name;

    public function __construct(BaseFormFactoryInterface $formFactory, $type, $name)
    {
        $this->formFactory  = $formFactory;
        $this->type         = $type;
        $this->name         = $name;
    }

    /**
     * @return Form
     */
    public function createForm($data = null)
    {
        return $this->formFactory->createNamed($this->type, $this->name, $data);
    }

}
