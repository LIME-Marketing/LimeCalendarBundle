<?php

namespace Lime\CalendarBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;

class Configuration
{

    public function getConfigTree()
    {
        $tb = new TreeBuilder();

        $tb->root('lime_calendar', 'array')
            ->children()

                ->scalarNode('db_driver')->cannotBeOverwritten()->cannotBeEmpty()->defaultValue('orm')->end()

                ->arrayNode('class')->isRequired()
                    ->children()
                        ->arrayNode('model')
                            ->children()
                                ->scalarNode('calendar')->isRequired()->end()
                                ->scalarNode('membership')->isRequired()->end()
                                ->scalarNode('event')->isRequired()->end()
                                ->scalarNode('participant')->isRequired()->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()

                ->arrayNode('form')->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('calendar')->isRequired()->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('type')->defaultValue('lime_calendar.calendar')->end()
                                ->scalarNode('name')->defaultValue('lime_calendar_calendar')->end()
                            ->end()
                        ->end()
                        ->arrayNode('event')->isRequired()->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('type')->defaultValue('lime_calendar.event')->end()
                                ->scalarNode('name')->defaultValue('lime_calendar_event')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()

                ->arrayNode('routing')->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('calendar')->isRequired()->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('index')->defaultValue('lime_calendar_calendar_index')->end()
                                ->scalarNode('view')->defaultValue('lime_calendar_calendar_view')->end()
                                ->scalarNode('create')->defaultValue('lime_calendar_calendar_create')->end()
                                ->scalarNode('edit')->defaultValue('lime_calendar_calendar_edit')->end()
                                ->scalarNode('delete')->defaultValue('lime_calendar_calendar_delete')->end()
                            ->end()
                        ->end()
                        ->arrayNode('event')->isRequired()->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('index')->defaultValue('lime_calendar_event_index')->end()
                                ->scalarNode('view')->defaultValue('lime_calendar_event_view')->end()
                                ->scalarNode('create')->defaultValue('lime_calendar_event_create')->end()
                                ->scalarNode('edit')->defaultValue('lime_calendar_event_edit')->end()
                                ->scalarNode('delete')->defaultValue('lime_calendar_event_delete')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()

                ->arrayNode('service')->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('manager')->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('calendar')->cannotBeEmpty()->defaultValue('lime_calendar.manager.calendar.default')->end()
                                ->scalarNode('event')->cannotBeEmpty()->defaultValue('lime_calendar.manager.event.default')->end()
                            ->end()
                        ->end()
                        ->arrayNode('form_factory')->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('calendar')->cannotBeEmpty()->defaultValue('lime_calendar.form_factory.calendar.default')->end()
                                ->scalarNode('event')->cannotBeEmpty()->defaultValue('lime_calendar.form_factory.event.default')->end()
                            ->end()
                        ->end()
                        ->arrayNode('blamer')->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('calendar')->cannotBeEmpty()->defaultValue('lime_calendar.blamer.security')->end()
                                ->scalarNode('event')->cannotBeEmpty()->defaultValue('lime_calendar.blamer.security')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()

                ->arrayNode('template')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('engine')->defaultValue('twig')->end()
                    ->end()
                ->end()

            ->end()
        ->end();

        return $tb->buildTree();
    }

}
