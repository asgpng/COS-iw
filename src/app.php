<?php

use Silex\Application;
use Silex\Provider\FormServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\TranslationServiceProvider;
use Silex\Provider\SwiftmailerServiceProvider;

/* include 'twig_load.php'; */

$app->register(new ValidatorServiceProvider());
$app->register(new FormServiceProvider());
$app->register(new TranslationServiceProvider());
// session config
$app->register(new Silex\Provider\SessionServiceProvider());


$app->register(new TwigServiceProvider(),
               array(
                     'twig.path' => array(__DIR__.'/views'),
                     'twig.options' => array('cache' => __DIR__.'/../cache/twig'),
                     ));

$app['debug'] = true;

return $app;