<?php

namespace Lime\CalendarBundle\Controller;

use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class MembershipController extends BaseController
{

    public function addAction($calendar_id, Request $request)
    {
        $calendarManager = $this->getCalendarManager();
        $calendar = $calendarManager->find($calendar_id);

        $manager = $this->getMembershipManager();
        $membership = $manager->createMembership($calendar);
        $form = $this->getMembershipForm($membership);

        if ('POST' === $request->getMethod()) {
            $form->bindRequest($request);

            if ($form->isValid() && $manager->addMembership($membership)) {
                return new RedirectResponse($this->container->get('router')->generate($this->container->getParameter('lime_calendar.routing.membership.view'), array(
                    'id' => $membership->getId(),
                )));
            }
        }

        return $this->container->get('templating')->renderResponse('LimeCalendarBundle:Membership:add.html.' . $this->container->getParameter('lime_calendar.template.engine'), array(
            'form' => $form->createView(),
        ));
    }

    public function updateAction($id)
    {

    }

    /**
     * @return Form
     */
    protected function getMembershipForm($data = null)
    {
        return $this->container->get('lime_calendar.form_factory.membership')->createForm($data);
    }

}
