<?php

namespace BestIt\ContentfulTranslationBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * Class BestItContentfulTranslationExtension
 *
 * @author Michel Chowanski <michel.chowanski@bestit-online.de>
 * @package BestIt\ContentfulTranslationBundle\DependencyInjection
 */
class BestItContentfulTranslationExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setAliases([
           'best_it_contentful_translation.contentful_client' => $config['contentful_client_id'],
           'best_it_contentful_translation.cache' => $config['cache_id']
        ]);

        $container->setParameter('best_it_contentful_translation.contentful_mapping', $config['contentful_mapping']);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');
    }
}
