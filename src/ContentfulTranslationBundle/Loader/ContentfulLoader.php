<?php

namespace BestIt\ContentfulTranslationBundle\Loader;

use BestIt\ContentfulTranslationBundle\Exception\InvalidEntryValueFormatException;
use Contentful\Delivery\Client;
use Contentful\Delivery\ContentTypeField;
use Contentful\Delivery\DynamicEntry;
use Contentful\Delivery\Query;
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
     * The contentful config array
     *
     * @var array
     */
    private $config;

    /**
     * ContentfulLoader constructor.
     *
     * @param Client $client
     * @param array $config
     */
    public function __construct(Client $client, array $config)
    {
        $this->client = $client;
        $this->config = $config;
    }

    /**
     * {@inheritdoc}
     */
    public function load($resource, $locale, $domain = 'messages')
    {
        $messages = [];
        $contentfulLocale = $locale;

        // We need the full locale
        if (strpos($locale, '_') === false) {
            $contentfulLocale = $locale . '_' . strtoupper($locale);
        }

        // Contentful need another locale format
        $contentfulLocale = str_replace('_', '-', $contentfulLocale);

        $query = (new Query)
            ->setLocale($contentfulLocale)
            ->setContentType($this->config['content_type'])
            ->where(sprintf('fields.%s', $this->config['translation_domain']), $domain);

        $result = $this->client->getEntries($query);

        /** @var DynamicEntry $item */
        foreach ($result as $item) {
            $fields = $item->getContentType()->getFields();
            $values = array_map(function (ContentTypeField $field) use ($item) {
                $entryValue = $item->{'get' . ucfirst($field->getId())}();

                if (!is_string($entryValue)) {
                    throw new InvalidEntryValueFormatException(sprintf(
                        'Entry value must be string but is "%s"',
                        gettype($entryValue)
                    ));
                }

                return $entryValue;
            }, $fields);

            $messages[$values[$this->config['translation_key']]] = $values[$this->config['translation_value']];
        }

        $catalogue = new MessageCatalogue($locale);
        $catalogue->add($messages, $domain);

        return $catalogue;
    }
}
