<?php

namespace BestIt\ContentfulTranslationBundle\Loader;

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
     * {@inheritdoc}
     */
    public function load($resource, $locale, $domain = 'messages')
    {
        $messages = ['foo' => 'kirk'];

        $catalogue = new MessageCatalogue($locale);
        $catalogue->add($messages, $domain);

        return $catalogue;
    }
}
