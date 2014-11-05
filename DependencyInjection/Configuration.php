<?php

namespace Bxav\Bundle\ResellerClubBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('bxav_reseller_club');

        $rootNode
            ->children()
                ->arrayNode('api')
                    ->children()
                        ->scalarNode('url')->end()
                    ->end()
                    ->children()
                        ->scalarNode('user_id')->end()
                    ->end()
                    ->children()
                        ->scalarNode('key')->end()
                    ->end()
                ->end()
                ->arrayNode('domain_registration')
                    ->children()
                        ->arrayNode('nameservers')
                            ->prototype('scalar')->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
