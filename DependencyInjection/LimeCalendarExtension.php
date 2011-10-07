<?php

namespace Lime\CalendarBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;

class LimeCalendarExtension extends Extension
{

    public function load(array $configs, ContainerBuilder $container)
    {
        $processor = new Processor();
        $configuration = new Configuration();

        $config = $processor->process($configuration->getConfigTree(), $configs);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));

        if (!in_array(strtolower($config['db_driver']), array('orm'))) {
            throw new \InvalidArgumentException(sprintf('Invalid db driver "%s".', $config['db_driver']));
        }
        $loader->load(sprintf('%s.yml', $config['db_driver']));

        foreach (array('form', 'blamer', 'twig', 'authorization') as $base) {
            $loader->load(sprintf('%s.yml', $base));
        }

        $container->setParameter('lime_calendar.model.calendar.class', $config['class']['model']['calendar']);
        $container->setParameter('lime_calendar.model.event.class', $config['class']['model']['event']);

        $container->setParameter('lime_calendar.form.calendar.type', $config['form']['calendar']['type']);
        $container->setParameter('lime_calendar.form.calendar.name', $config['form']['calendar']['name']);
        $container->setParameter('lime_calendar.form.event.type', $config['form']['event']['type']);
        $container->setParameter('lime_calendar.form.event.name', $config['form']['event']['name']);

        $container->setParameter('lime_calendar.routing.calendar.index', $config['routing']['calendar']['index']);
        $container->setParameter('lime_calendar.routing.calendar.view', $config['routing']['calendar']['view']);
        $container->setParameter('lime_calendar.routing.calendar.create', $config['routing']['calendar']['create']);
        $container->setParameter('lime_calendar.routing.calendar.edit', $config['routing']['calendar']['edit']);
        $container->setParameter('lime_calendar.routing.calendar.delete', $config['routing']['calendar']['delete']);

        $container->setParameter('lime_calendar.routing.event.index', $config['routing']['event']['index']);
        $container->setParameter('lime_calendar.routing.event.view', $config['routing']['event']['view']);
        $container->setParameter('lime_calendar.routing.event.create', $config['routing']['event']['create']);
        $container->setParameter('lime_calendar.routing.event.edit', $config['routing']['event']['edit']);
        $container->setParameter('lime_calendar.routing.event.delete', $config['routing']['event']['delete']);

        $container->setParameter('lime_calendar.template.engine', $config['template']['engine']);

        $container->setAlias('lime_calendar.manager.calendar', $config['service']['manager']['calendar']);
        $container->setAlias('lime_calendar.manager.event', $config['service']['manager']['event']);

        $container->setAlias('lime_calendar.form_factory.calendar', $config['service']['form_factory']['calendar']);
        $container->setAlias('lime_calendar.form_factory.event', $config['service']['form_factory']['event']);

        $container->setAlias('lime_calendar.blamer.calendar', $config['service']['blamer']['calendar']);
        $container->setAlias('lime_calendar.blamer.event', $config['service']['blamer']['event']);
    }

}
