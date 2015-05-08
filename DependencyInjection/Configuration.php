<?php

namespace Tc\Bundle\Pjax\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Configuration
 */
class Configuration implements ConfigurationInterface
{
    /**
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('tc_pjax');

        $rootNode
            ->children()
            ->scalarNode('version')->defaultNull()->end()
            ->end();

        return $treeBuilder;
    }
}
