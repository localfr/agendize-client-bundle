<?php

namespace Localfr\AgendizeClientBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('localfr_agendize');
        $rootNode = method_exists($treeBuilder, 'getRootNode')
            ? $treeBuilder->getRootNode()
            : $treeBuilder->root('localfr_agendize');

        $rootNode
            ->children()
                ->scalarNode('client_id')->isRequired()->end()
                ->scalarNode('client_secret')->isRequired()->end()
                ->scalarNode('username')->isRequired()->end()
                ->scalarNode('password')->isRequired()->end()
                ->scalarNode('api_version')->defaultValue('2.0')->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
