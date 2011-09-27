<?php

namespace Lime\CalendarBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;

class EventController extends ContainerAware
{

    public function createAction()
    {
        $manager = $this->container->get('lime_calendar.event_manager');
        $event = $manager->createEvent();

        return $this->container->get('templating')->renderResponse('LimeCalendarBundle:Event:create.html.' . $this->container->getParameter('lime_calendar.template.engine'), array(

        ));
    }

    public function viewAction($id)
    {
        $manager = $this->container->get('lime_calendar.event_manager');
        $event = $manager->find($id);

        return $this->container->get('templating')->renderResponse('LimeCalendarBundle:Event:view.html.' . $this->container->getParamter('lime_calendar.template.engine'), array(

        ));
    }

    public function editAction($id)
    {
        $manager = $this->container->get('lime_calendar.event_manager');
        $event = $manager->find($id);

        return $this->container->get('templating')->renderResponse('LimeCalendarBundle:Event:edit.html.' . $this->container->getParamter('lime_calendar.template.engine'), array(

        ));
    }

    public function deleteAction($id)
    {
        $manager = $this->container->get('lime_calendar.event_manager');
        $event = $manager->find($id);

        return $this->container->get('templating')->renderResponse('LimeCalendarBundle:Event:delete.html.' . $this->container->getParameter('lime_calendar.template.engine'), array(

        ));
    }

}
