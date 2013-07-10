<?php

require_once __DIR__.'/../vendor/autoload.php';
include 'twig_load.php';
include_once('CAS.php');

// app creation
$app = new Silex\Application();

// app config
$app['debug'] = true;
$app->register(new Silex\Provider\TwigServiceProvider(),
               array(
                     'twig.path' => __DIR__.'/views',
                     ));

// session config
$app->register(new Silex\Provider\SessionServiceProvider());

use Symfony\Component\HttpFoundation\Response;

$app->get('/login', function () use ($app) {
    return $app['twig']->render('login.html',array(
                                                   'title'=> 'Home',
                                                   ));
  });

$app->post('/login', function () use ($app) {

    $netID = $_POST['netID'];
    $app['session']->set('user', array('netID' => $netID));
    /*   // store session data */
    /* $_SESSION['netID']=$netID; */
    /* echo $netID; */
    return $app->redirect('/iw-php/web/index.php/account');
    /* $username = $app['request']->server->get('PHP_AUTH_USER', false);
    /* $password = $app['request']->server->get('PHP_AUTH_PW'); */

    /* if ('igor' === $username && 'password' === $password) { */
      /* $app['session']->set('user', array('username' => $username)); */

    /* } */

  });

$app->get('/account', function () use ($app) {
    if (null === $user = $app['session']->get('user')) {
      return $app->redirect('/login');
    }

    return "Welcome {$user['netID']}!";
  });

// controller groups
$files = $app['controllers_factory'];
$forms = $app['controllers_factory'];
$admin = $app['controllers_factory'];

// global controllers
$app->get('/', function() use ($app) {
    return $app['twig']->render('index.html',
                                array('title'=> 'Home',));
  });

$app->get('/messages', function() use ($app) {
    return $app['twig']->render('messages.html',array(
                                                   'title'=> 'Messages',
                                                   ));
  });

$app->get('/about', function() use ($app) {
    return $app['twig']->render('about.html',array(
                                                   'title'=> 'About',
                                                   ));
  });

$app->get('/contact', function() use ($app) {
    return $app['twig']->render('contact.html',array(
                                                   'title'=> 'Contact',
                                                   ));
  });


// form controllers
$forms->get('/signup', function() use ($app) {
    return $app['twig']->render('form_signup.html',array(
                                                         'title'=> 'Signup Form',
                                                         ));
  });

$forms->get('/checkpoint', function() use ($app) {
    return $app['twig']->render('form_checkpoint.html',array(
                                                         'title'=> 'Checkpoint Form',
                                                         ));
  });

$forms->get('/february', function() use ($app) {
    return $app['twig']->render('form_february.html',array(
                                                         'title'=> 'February Form',
                                                         ));
  });

$forms->get('/second_reader', function() use ($app) {
    return $app['twig']->render('form_second_reader.html',array(
                                                         'title'=> 'Second Reader Form',
                                                         ));
  });

// files controllers
$files->get('/upload', function() use ($app) {
    return $app['twig']->render('upload.html',array(
                                                         'title'=> 'Upload',
                                                         ));
  });

$files->get('/uploads_view', function() use ($app) {
    return $app['twig']->render('uploads_view.html',array(
                                                         'title'=> 'View Uploads',
                                                         ));
  });

// admin controllers
$admin->get('/user_view', function() use ($app) {
    return $app['twig']->render('users_view.html',array(
                                                         'title'=> 'View users',
                                                         ));
  });

$admin->get('/form_query', function() use ($app) {
    return $app['twig']->render('form_query.html',array(
                                                         'title'=> 'Query Forms',
                                                         ));
  });


// mount controllers:
$app->mount('/files', $files);
$app->mount('/forms', $forms);
$app->mount('/admin', $admin);

$app->run();
