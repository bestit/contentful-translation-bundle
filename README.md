# bestit/contentful-translation-bundle

[![Latest Stable Version](https://poser.pugx.org/bestit/contentful-translation-bundle/v/stable)](https://packagist.org/packages/bestit/contentful-translation-bundle)
[![Total Downloads](https://poser.pugx.org/bestit/contentful-translation-bundle/downloads)](https://packagist.org/packages/bestit/contentful-translation-bundle)
[![Latest Unstable Version](https://poser.pugx.org/bestit/contentful-translation-bundle/v/unstable)](https://packagist.org/packages/bestit/contentful-translation-bundle)
[![License](https://poser.pugx.org/bestit/contentful-translation-bundle/license)](https://packagist.org/packages/bestit/contentful-translation-bundle)

A Translation bundle for loading messages from contentful


Step 1: Download the Bundle
---------------------------

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
$ composer require bestit/contentful-translation-bundle
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Step 2: Enable the Bundle
-------------------------

Then, enable the bundle by adding it to the list of registered bundles
in the `app/AppKernel.php` file of your project:

```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...

            new BestIt\ContentfulTranslationBundle\BestItContentfulTranslationBundle(),
        );

        // ...
    }

    // ...
}
```

Step 3: Configure the Bundle
-------------------------

Simple configuration. Here a yaml example:

```yml
# config.yml

best_it_contentful_translation:

    # Contentful client service ... expect an Client from offical contentful sdk
    contentful_client_id: 'contentful.delivery.translation_client'                      # Required
    
    # Contentful mapping (all optional)
    contentful_mapping:
    
            # Contentful content type id (default: translation)
            content_type: 'translation'
            
            # Contentful field id for the message key (default: translation_key)
            translation_key: 'translation_key'
            
            # Contentful field id for the message value (default: translation_value)
            translation_value: 'translation_value'
            
            # Contentful field id for the message domain (default: translation_domain)
            translation_domain: 'translation_domain'

```

Step 4: Configure contentful
-------------------------

You need a translation content type in your contentful space. Just create one and set the field id in your config mapping (see above).
The content type need three fields: key, value and domain. You can use a localized field as value.

Example configuration as json:
```json
{
  "name": "Übersetzung",
  "description": "",
  "displayField": "translation_key",
  "fields": [
    {
      "id": "translation_key",
      "name": "Schlüssel",
      "type": "Symbol",
      "localized": false,
      "required": true,
      "validations": [
        {
          "unique": true
        }
      ],
      "disabled": false,
      "omitted": false
    },
    {
      "id": "translation_value",
      "name": "Text",
      "type": "Symbol",
      "localized": true,
      "required": false,
      "validations": [],
      "disabled": false,
      "omitted": false
    },
    {
      "id": "translation_domain",
      "name": "Domain",
      "type": "Symbol",
      "localized": false,
      "required": false,
      "validations": [],
      "disabled": false,
      "omitted": false
    }
  ],
  "sys": {
    //...
  }
}
```

Step 5: Use translations
-------------------------

The symfony translator expects a translation file. So you have to create a 'contentful' translation file - 
as you already know it through yml, xml or xliff: `/Resources/translations/messages.de.contentful`

The filename defines the domain and locale as usual in Symfony. 
The file content can remain empty - the translations are fetched via contentful.

Please note that Symfony cache the translations. So you have to clear the cache after changes in Contentful.