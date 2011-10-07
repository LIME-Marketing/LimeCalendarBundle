<?php

namespace Lime\CalendarBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Lime\CalendarBundle\Model\CalendarManagerInterface;
use Symfony\Component\Form\Form;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Lime\CalendarBundle\Model\CalendarInterface;

class CalendarController extends ContainerAware
{

    public function indexAction()
    {
        $manager = $this->getCalendarManager();
        $calendars = $manager->findAll();

        return $this->container->get('templating')->renderResponse('LimeCalendarBundle:Calendar:index.html.' . $this->container->getParameter('lime_calendar.template.engine'), array(
            'calendars' => $calendars,
        ));
    }

    public function createAction(Request $request)
    {
        if (!$this->isGranted('create', $this->container->getParameter('lime_calendar.model.calendar.class'))) {
            throw new AccessDeniedException();
        }

        $manager = $this->getCalendarManager();
        $calendar = $manager->createCalendar();

        $form = $this->getCalendarForm();
        $form->setData($calendar);

        if ('POST' === $request->getMethod()) {
            $form->bindRequest($request);

            if ($form->isValid() && $manager->addCalendar($calendar)) {
                return new RedirectResponse($this->container->get('router')->generate($this->container->getParameter('lime_calendar.routing.calendar.view'), array(
                    'id' => $calendar->getId(),
                )));
            }
        }

        return $this->container->get('templating')->renderResponse('LimeCalendarBundle:Calendar:create.html.' . $this->container->getParameter('lime_calendar.template.engine'), array(
            'form' => $form->createView(),
        ));
    }

    public function viewAction($id)
    {
        $manager = $this->getCalendarManager();
        $calendar = $manager->find($id);

        if (!$this->isGranted('view', $calendar)) {
            throw new AccessDeniedException();
        }

        return $this->container->get('templating')->renderResponse('LimeCalendarBundle:Calendar:view.html.' . $this->container->getParameter('lime_calendar.template.engine'), array(
            'calendar' => $calendar,
        ));
    }

    public function editAction($id, Request $request)
    {
        $manager = $this->getCalendarManager();
        $calendar = $manager->find($id);

        if (!$this->isGranted('edit', $calendar)) {
            throw new AccessDeniedException();
        }

        $form = $this->getCalendarForm();
        $form->setData($calendar);

        if ('POST' === $request->getMethod()) {
            $form->bindRequest($request);

            if ($form->isValid() && $manager->updateCalendar($calendar)) {
                return new RedirectResponse($this->container->get('router')->generate($this->container->getParameter('lime_calendar.routing.calendar.view'), array(
                    'id' => $calendar->getId(),
                )));
            }
        }

        return $this->container->get('templating')->renderResponse('LimeCalendarBundle:Calendar:edit.html.' . $this->container->getParameter('lime_calendar.template.engine'), array(
            'form' => $form->createView(),
        ));
    }

    public function deleteAction($id, Request $request)
    {
        $manager = $this->getCalendarManager();
        $calendar = $manager->find($id);

        if (!$this->isGranted('delete', $calendar)) {
            throw new AccessDeniedException();
        }

        if ('POST' === $request->getMethod()) {
            $manager->removeCalendar($calendar);

            return new RedirectResponse($this->container->get('router')->generate($this->container->getParameter('lime_calendar.routing.calendar.index'), array(

            )));
        }

        return $this->container->get('templating')->renderResponse('LimeCalendarBundle:Calendar:delete.html.' . $this->container->getParameter('lime_calendar.template.engine'), array(
            'calendar' => $calendar,
            'cancelURL' => $this->container->get('router')->generate($this->container->getParameter('lime_calendar.routing.calendar.view'), array(
                'id' => $calendar->getId(),
            )),
        ));
    }

    protected function isGranted($action, $object = null)
    {
        $token = $this->container->get('security.context')->getToken();

        return $this->container->get('lime_calendar.voter')->decide($token, array($action), $object);
    }

    /**
     * @return CalendarManagerInterface
     */
    protected function getCalendarManager()
    {
        return $this->container->get('lime_calendar.manager.calendar');
    }

    /**
     * @return Form
     */
    protected function getCalendarForm()
    {
        return $this->container->get('lime_calendar.form_factory.calendar')->createForm();
    }

}
