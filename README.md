# bestit/contentful-translation-bundle

[![Total Downloads](https://poser.pugx.org/bestit/contentful-translation-bundle/downloads.png)](https://packagist.org/packages/bestit/contentful-translation-bundle)
[![Latest Stable Version](https://poser.pugx.org/bestit/contentful-translation-bundle/v/stable.png)](https://packagist.org/packages/bestit/contentful-translation-bundle)

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