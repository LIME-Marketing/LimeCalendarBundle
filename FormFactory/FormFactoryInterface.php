<?php

namespace Lime\CalendarBundle\FormFactory;

use Symfony\Component\Form\Form;

interface FormFactoryInterface
{

    /**
     * @return Form
     */
    function createForm($data = null);

}
