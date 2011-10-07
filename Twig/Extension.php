<?php

namespace Lime\CalendarBundle\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface;

class Extension extends \Twig_Extension
{

    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getFunctions()
    {
        return array(
            'lime_calendar_route' => new \Twig_Function_Method($this, 'lime_calendar_route'),
        );
    }

    public function lime_calendar_route($controller, $action)
    {
        return $this->container->getParameter(sprintf('lime_calendar.routing.%s.%s', $controller, $action));
    }

    public function getName()
    {
        return 'lime_calendar';
    }

}
