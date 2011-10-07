<?php

namespace Lime\CalendarBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Request;
use Lime\CalendarBundle\Model\EventManagerInterface;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Lime\CalendarBundle\Model\EventInterface;

class EventController extends ContainerAware
{

    public function indexAction()
    {
        $manager = $this->getEventManager();
        $events = $manager->findAll();

        return $this->container->get('templating')->renderResponse('LimeCalendarBundle:Event:index.html.' . $this->container->getParameter('lime_calendar.template.engine'), array(
            'events' => $events,
        ));
    }

    /**
     * @param integer $id id of calendar that event is being created for
     */
    public function createAction($calendar_id, Request $request)
    {
        if (!$this->isGranted('create', $this->container->getParameter('lime_calendar.model.event.class'))) {
            throw new AccessDeniedException();
        }

        $calManager = $this->container->get('lime_calendar.manager.calendar');
        $calendar = $calManager->find($calendar_id);

        $manager = $this->getEventManager();
        $event = $manager->createEvent($calendar);

        $form = $this->getEventForm();
        $form->setData($event);

        if ('POST' === $request->getMethod()) {
            $form->bindRequest($request);

            if ($form->isValid() && $manager->addEvent($event)) {
                return new RedirectResponse($this->container->get('router')->generate($this->container->getParameter('lime_calendar.routing.event.view'), array(
                    'id' => $event->getId(),
                )));
            }
        }

        return $this->container->get('templating')->renderResponse('LimeCalendarBundle:Event:create.html.' . $this->container->getParameter('lime_calendar.template.engine'), array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @param integer $id id of event to be viewed
     */
    public function viewAction($id)
    {
        $manager = $this->getEventManager();
        $event = $manager->find($id);

        if (!$this->isGranted('view', $event)) {
            throw new AccessDeniedException();
        }

        return $this->container->get('templating')->renderResponse('LimeCalendarBundle:Event:view.html.' . $this->container->getParameter('lime_calendar.template.engine'), array(
            'event' => $event,
        ));
    }

    /**
     * @param integer $id id of event to be edited
     */
    public function editAction($id, Request $request)
    {
        $manager = $this->getEventManager();
        $event = $manager->find($id);

        if (!$this->isGranted('edit', $event)) {
            throw new AccessDeniedException();
        }

        $form = $this->getEventForm();
        $form->setData($event);

        if ('POST' === $request->getMethod()) {
            $form->bindRequest($request);

            if ($form->isValid() && $manager->updateEvent($event)) {
                return new RedirectResponse($this->container->get('router')->generate($this->container->getParameter('lime_calendar.routing.event.view'), array(
                    'id' => $event->getId(),
                )));
            }
        }

        return $this->container->get('templating')->renderResponse('LimeCalendarBundle:Event:edit.html.' . $this->container->getParamter('lime_calendar.template.engine'), array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @param integer $id id of event to be deleted
     */
    public function deleteAction($id, Request $request)
    {
        $manager = $this->getEventManager();
        $event = $manager->find($id);

        if (!$this->isGranted('delete', $event)) {
            throw new AccessDeniedException();
        }

        if ('POST' === $request->getMethod()) {
            $manager->removeEvent($event);

            return new RedirectResponse($this->container->get('router')->generate($this->container->getParameter('lime_calendar.routing.event.index'), array(

            )));
        }

        return $this->container->get('templating')->renderResponse('LimeCalendarBundle:Event:delete.html.' . $this->container->getParameter('lime_calendar.template.engine'), array(
            'event' => $event,
            'cancelURL' => $this->container->get('router')->generate($this->container->getParameter('lime_calendar.routing.event.view'), array(
                'id' => $event->getId(),
            )),
        ));
    }

    protected function isGranted($action, $object = null)
    {
        $token = $this->container->get('security.context')->getToken();

        return $this->container->get('lime_calendar.voter')->decide($token, array($action), $object);
    }

    /**
     * @return EventManagerInterface
     */
    protected function getEventManager()
    {
        return $this->container->get('lime_calendar.manager.event');
    }

    /**
     * @return Form
     */
    protected function getEventForm()
    {
        return $this->container->get('lime_calendar.form_factory.event')->createForm();
    }

}
