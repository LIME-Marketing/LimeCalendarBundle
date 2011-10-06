Installation
============

Add the CalendarBundle to your /vendor/bundles dir
-----------------------

Using the vendors script
~~~~~~~~~~~~~~~~~~~~~~~

Add the following lines to your ``deps`` file::

    [LimeCalendarBundle]
        git=git://github.com/LIME-Marketing/LimeCalendarBundle.git
        target=bundles/Lime/CalendarBundle

Run the vendors script::

    ./bin/vendors install

Add the Lime namespace to your autoloader
-------------------------

::

    // app/autoload.php

    $loader->registerNamespaces(array(
        'Lime' => __DIR__.'/../vendor/bundles',
        // other namespaces
    ));

Add the CalendarBundle to your app kernel
-------------------------

::

    // app/AppKernel.php

    public function registerBundles()
    {
        return array(
            // ...
            new Lime\CalendarBundle\LimeCalendarBundle(),
            // ...
        );
    }

Configure your project
----------------------

A minimal configuration includes the mapping of the calendar, membership, event, and participant classes:

Doctrine ORM
~~~~~~~~~~~~

::

    // src/YourProject/YourBundle/Entity/Calendar.php

    namespace YourProject\YourBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;
    use Lime\CalendarBundle\Entity\Calendar as BaseCalendar;

    /**
     * @ORM\Entity
     */
    class Calendar extends BaseCalendar
    {

        /**
         * @ORM\Id @ORM\Column(type="integer")
         * @ORM\GeneratedValue
         */
        protected $id;

        /**
         * @ORM\ManyToOne(targetEntity="YourProject\UserBundle\Entity\User")
         */
        protected $user;

        /**
         * @ORM\OneToMany(targetEntity="Membership", mappedBy="calendar")
         */
        protected $memberships;

        /**
         * @ORM\OneToMany(targetEntity="Event", mappedBy="calendar")
         */
        protected $events;
    }

::

    // src/YourProject/YourBundle/Entity/Event.php
    
    namespace YourProject\YourBundle\Entity;
    
    use Doctrine\ORM\Mapping as ORM;
    use Lime\CalendarBundle\Entity\Event as BaseEvent;
    
    /**
     * @ORM\Entity
     */
    class Event extends BaseEvent
    {
    
        /**
         * @ORM\Id @ORM\Column(type="integer")
         * @ORM\GeneratedValue
         */
        protected $id;
    
        /**
         * @ORM\ManyToOne(targetEntity="Event", inversedBy="children")
         */
        protected $parent;
    
        /**
         * @ORM\OneToMany(targetEntity="Event", mappedBy="parent")
         */
        protected $children;
    
        /**
         * @ORM\ManyToOne(targetEntity="Calendar", inversedBy="events")
         */
        protected $calendar;
    
        /**
         * @ORM\ManyToOne(targetEntity="YourProject\UserBundle\Entity\User")
         */
        protected $user;
    
        /**
         * @ORM\OneToMany(targetEntity="Participant", mappedBy="event")
         */
        protected $participants;
    }

::

    // src/YourProject/YourBundle/Entity/Participant.php
    
    namespace YourProject\YourBundle\Entity;
    
    use Doctrine\ORM\Mapping as ORM;
    use Lime\CalendarBundle\Entity\Participant as BaseParticipant;
    
    /**
     * @ORM\Entity
     */
    class Participant extends BaseParticipant
    {
    
        /**
         * @ORM\Id @ORM\Column(type="integer")
         * @ORM\GeneratedValue
         */
        protected $id;
    
        /**
         * @ORM\ManyToOne(targetEntity="Event", inversedBy="participants")
         */
        protected $event;
    
        /**
         * @ORM\ManyToOne(targetEntity="YourProject\UserBundle\Entity\User")
         */
        protected $user;
    }

::

    // src/YourProject/YourBundle/Entity/Membership.php
    
    namespace YourProject\YourBundle\Entity;
    
    use Doctrine\ORM\Mapping as ORM;
    use Lime\CalendarBundle\Entity\Membership as BaseMembership;
    
    /**
     * @ORM\Entity
     */
    class Membership extends BaseMembership
    {
    
        /**
         * @ORM\Id @ORM\Column(type="integer")
         * @ORM\GeneratedValue
         */
        protected $id;
    
        /**
         * @ORM\ManyToOne(targetEntity="Calendar", inversedBy="memberships")
         */
        protected $calendar;
    
        /**
         * @ORM\ManyToOne(targetEntity="YourProject\UserBundle\Entity\User")
         */
        protected $user;
    }



Configure your application::

    # app/config/config.yml

    lime_calendar:
        class:
            model:
                calendar: YourProject\YourBundle\Entity\Calendar
                membership: YourProject\YourBundle\Entity\Membership
                event: YourProject\YourBundle\Entity\Event
                participant: YourProject\YourBundle\Entity\Participant

Register routing
----------------

The routes used by the bundle can be configured, but to use the defaults, include them in your routing file::

    # app/config/routing.yml

    lime_calendar:
        resource: "@LimeCalendarBundle/Resource/config/routing.yml"

Configuration Defaults
======================

::

    # app/config/config.yml

    lime_calendar:
        db_driver: orm
        class:
            model:
                calendar: ~
                membership: ~
                event: ~
                participant: ~
        form:
            calendar:
                type: lime_calendar.calendar
                name: lime_calendar_calendar
            event:
                type: lime_calendar.event
                name: lime_calendar_event
        routing: #used internally for redirects, etc in controllers
            calendar:
                index: lime_calendar_calendar_index
                view: lime_calendar_calendar_view
                create: lime_calendar_calendar_create
                edit: lime_calendar_calendar_edit
                delete: lime_calendar_calendar_delete
            event:
                index: lime_calendar_event_index
                view: lime_calendar_event_view
                create: lime_calendar_event_create
                edit: lime_calendar_event_edit
                delete: lime_calendar_event_delete
        service:
            manager:
                calendar: lime_calendar.manager.calendar.default
                event: lime_calendar.manager.event.default
            form_factory:
                calendar: lime_calendar.form_factory.calendar.default
                event: lime_calendar.form_factory.event.default
            blamer:
                calendar: lime_calendar.blamer.security
                event: lime_calendar.blamer.security
        template:
            engine: twig