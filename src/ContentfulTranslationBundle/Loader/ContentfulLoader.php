<?php

namespace BestIt\ContentfulTranslationBundle\Loader;

use Contentful\Delivery\Client;
use Contentful\Delivery\Query;
use Psr\Cache\CacheItemPoolInterface;
use Symfony\Component\Translation\Loader\LoaderInterface;
use Symfony\Component\Translation\MessageCatalogue;

/**
 * Class ContentfulLoader
 *
 * @author Michel Chowanski <michel.chowanski@bestit-online.de>
 * @package BestIt\ContentfulTranslationBundle\Loader
 */
class ContentfulLoader implements LoaderInterface
{
    /**
     * The contentful client
     *
     * @var Client
     */
    private $client;

    /**
     * The cache
     *
     * @var CacheItemPoolInterface
     */
    private $cacheItemPool;

    /**
     * The contentful config array
     *
     * @var array
     */
    private $config;

    /**
     * ContentfulLoader constructor.
     *
     * @param Client $client
     * @param CacheItemPoolInterface $cacheItemPool
     * @param array $config
     */
    public function __construct(Client $client, CacheItemPoolInterface $cacheItemPool, array $config)
    {
        $this->client = $client;
        $this->cacheItemPool = $cacheItemPool;
        $this->config = $config;
    }

    /**
     * {@inheritdoc}
     */
    public function load($resource, $locale, $domain = 'messages')
    {
        $messages = ['foo' => 'kirk'];

        $query = new Query();
        $query
            ->setLocale($locale)
            ->setContentType($this->config['content_type'])
            ->where(sprintf('fields.%s', $this->config['translation_domain']), $domain);

        // TODO: Fetch al entries and add to catalogue
        $result = $this->client->getEntries($query);

        $catalogue = new MessageCatalogue($locale);
        $catalogue->add($messages, $domain);

        return $catalogue;
    }
}
