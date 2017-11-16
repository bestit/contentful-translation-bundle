<?php

namespace BestIt\ContentfulTranslationBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 *
 * @author Michel Chowanski <michel.chowanski@bestit-online.de>
 * @package BestIt\ContentfulTranslationBundle\DependencyInjection
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('best_it_contentful_translation');

        $rootNode
            ->children()
                ->scalarNode('contentful_client_id')
                    ->info('The contentful client service id.')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('cache_id')
                    ->info('The used cache service.')
                    ->defaultValue('app.cache')
                    ->cannotBeEmpty()
                ->end()
                ->arrayNode('contentful_mapping')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('content_type')
                            ->defaultValue('translation')
                            ->cannotBeEmpty()
                        ->end()
                        ->scalarNode('translation_key')
                            ->defaultValue('translation_key')
                            ->cannotBeEmpty()
                        ->end()
                        ->scalarNode('translation_value')
                            ->defaultValue('translation_value')
                            ->cannotBeEmpty()
                        ->end()
                        ->scalarNode('translation_locale')
                            ->defaultValue('translation_locale')
                            ->cannotBeEmpty()
                        ->end()
                        ->scalarNode('translation_domain')
                            ->defaultValue('translation_domain')
                            ->cannotBeEmpty()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
