SERPS
=====

**S**earch **E**ngine **R**esult **P**age **S**crapper

[![Build Status](https://travis-ci.org/serp-spider/core.svg?branch=master)](https://travis-ci.org/serp-spider/core)
[![Test Coverage](https://codeclimate.com/github/serp-spider/core/badges/coverage.svg)](https://codeclimate.com/github/serp-spider/core/coverage)
[![Gitter](https://img.shields.io/gitter/room/nwjs/nw.js.svg)](https://gitter.im/serp-spider/help)


This is a work in progress.

Install
-------

Install it using composer: ``composer require serps/core``

The base package does not include an http client. 
We advice you to use our curl client: ``composer require serps/http-client-curl``


Example
-------

The following example is only a short example of what you can do with serps.
For further details you can [check the full documentation](http://serp-spider.github.io/documentation/).

Note: This example requires the google package that you can install with  ``composer require serps/search-engine-google``.


```php

    use Serps\SearchEngine\Google\GoogleClient;
    use Serps\HttpClient\CurlClient;
    use Serps\SearchEngine\Google\GoogleUrl;
    use Serps\Exception\CaptchaException;
    use Serps\Exception\RequestErrorException;
    
    $googleClient = new GoogleClient(new CurlClient());
    
    $googleUrl = new GoogleUrl('google.fr');
    $googleUrl->setSearchTerm('simpsons');
    
    try {
        $googleSerp = $googleClient->query($googleUrl);
        $results = $googleSerp->getNaturalResults();
        
        foreach($results as $result){
            $resultTypes = $result->getTypes();
            $resultPosition = $result->getPosition();
            // an array of data depending on the result type
            $resultData = $result->getData(); 
        } 
    } catch (CaptchaException $e) {
        // Captcha must be solved to continue with this ip
    } catch (RequestErrorException $e) {
        // Non-captcha error (not found, network error...)
    }

```
