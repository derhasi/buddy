<?php
/**
 * @file
 * BuddySchema.php
 */

namespace derhasi\buddy\Config;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Defines configuration schema for buddy config files.
 */
class BuddySchema implements ConfigurationInterface {

  /**
   * {@inheritdoc}
   */
  public function getConfigTreeBuilder() {
    $treeBuilder = new TreeBuilder();
    $rootNode = $treeBuilder->root('buddy');
    $rootNode
      ->children()
        ->booleanNode('root')
          ->defaultFalse()
        ->end()
        ->arrayNode('commands')
          ->prototype('array')
          ->children()
            ->scalarNode('cmd')->end()
            ->scalarNode('workingDir')->end()
          ->end()
          ->end()
        ->end()
      ->end()
    ;

    return $treeBuilder;
  }
}
