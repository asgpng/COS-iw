<?php

ini_set('display_errors', 1);

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

require __DIR__.'/../src/app.php';

require __DIR__.'/../src/controllers.php';

require __DIR__.'/../src/CAS.php';

$app->run();