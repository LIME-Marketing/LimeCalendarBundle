<?php

namespace Lime\CalendarBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;

class CalendarController extends ContainerAware
{

    public function createAction()
    {

        return $this->container->get('templating')->renderResponse('LimeCalendarBundle:Calendar:create.html.' . $this->container->getParameter('lime_calendar.template.engine'), array(

        ));
    }

    public function viewAction($id)
    {
        $manager = $this->container->get('lime_calendar.calendar_manager');
        $calendar = $manager->find($id);

        return $this->container->get('templating')->renderResponse('LimeCalendarBundle:Calendar:view.html.' . $this->container->getParameter('lime_calendar.template.engine'), array(

        ));
    }

    public function editAction($id)
    {
        $manager = $this->container->get('lime_calendar.calendar_manager');
        $calendar = $manager->find($id);

        return $this->container->get('templating')->renderResponse('LimeCalendarBundle:Calendar:edit.html.' . $this->container->getParameter('lime_calendar.template.engine'), array(

        ));
    }

    public function deleteAction($id)
    {
        $manager = $this->container->get('lime_calendar.calendar_manager');
        $calendar = $manager->find($id);

        return $this->container->get('templating')->renderResponse('LimeCalendarBundle:Calendar:delete.html.' . $this->container->getParameter('lime_calendar.template.engine'), array(

        ));
    }

}
