<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


// controller groups
$files = $app['controllers_factory'];
$forms = $app['controllers_factory'];
$admin = $app['controllers_factory'];

$app->get('/cas-login', function() use ($app) {
    phpCAS::setDebug();

    // initialize phpCAS
    phpCAS::client(CAS_VERSION_2_0,'fed.princeton.edu',443,'cas');

    // no SSL validation for the CAS server
    phpCAS::setNoCasServerValidation();

    // force CAS authentication
    phpCAS::forceAuthentication();

    // at this step, the user has been authenticated by the CAS server
    // and the user's login name can be read with phpCAS::getUser().
    // logout if desired
    /* if (isset($_REQUEST['logout'])) { */
    /*   phpCAS::logout(); */
    /* } */
    $app['session']->set('user', array('netID' => phpCAS::getUser()));

    /* $user = $app['session']->get('user'); */
    /* return "Welcome {$user['netID']}!"; */ // to test if it's working
    return $app->redirect('/iw-php/web/index.php');
  });



$app->get('/login', function () use ($app) {
    return $app['twig']->render('login.html',
                                array(
                                      'title'=> 'Home',
                                      ));
  });

$app->post('/login', function () use ($app) {

    $netID = $_POST['netID'];
    $app['session']->set('user', array('netID' => $netID));
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
$forms->match('/test', function(Request $request) use ($app) {
    $data = array(
                  'name' => 'Adam',
                  'email' => 'asgpng@gmail.com'
                  );

    $form = $app['form.factory']->createBuilder('form', $data)
      ->add('name')
      ->add('email')
      ->add('gender', 'choice', array(
                                      'choices' => array(1 => 'maile', 2=> 'female'),
                                      'expanded' => true,
                                      ))
      ->getForm();

    if ('POST' == $request->getMethod()) {
      $form->bind($request);

      if ($form->isValid()) {
        $data = $form->getData();
        // do something with data
        // redirect somewhere
      }
    }
    return $app['twig']->render('forms/form_test.html', array('form' => $form->createView()));
  });
    /* return $app['twig']->render('form_test.html', */
    /*                             array( */
    /*                                   'title'=> 'Form Test', */
    /*                                   )); */



$forms->get('/signup', function() use ($app) {
    return $app['twig']->render('forms/signup.html',array(
                                                         'title'=> 'Signup Form',
                                                         ));
  });

$forms->get('/checkpoint', function() use ($app) {
    return $app['twig']->render('forms/checkpoint.html',array(
                                                         'title'=> 'Checkpoint Form',
                                                         ));
  });

$forms->get('/february', function() use ($app) {
    return $app['twig']->render('forms/february.html',array(
                                                         'title'=> 'February Form',
                                                         ));
  });

$forms->get('/second_reader', function() use ($app) {
    return $app['twig']->render('forms/second_reader.html',array(
                                                         'title'=> 'Second Reader Form',
                                                         ));
  });

$forms->get('/query', function() use ($app) {
    return $app['twig']->render('forms/query.html',array(
                                                         'title'=> 'Query Forms',
                                                         ));
  });



// files controllers

 $files->match('/upload', function (Request $request) use ($app){

     $form = $app['form.factory']->createBuilder('form')
       ->add('FileUpload', 'file')
       ->getForm();

     $request = $app['request'];

     if ($request->isMethod('POST'))
       {
         $form->bind($request);
         if ($form->isValid())
           {
             $files = $request->files->get($form->getName());
             /* Make sure that Upload Directory is properly configured and writable */
             $path = __DIR__.'/../web/upload/';
             $filename = $files['FileUpload']->getClientOriginalName();
             $files['FileUpload']->move($path,$filename);

           }
         return $app['twig']->render('files/upload_test.html', array(
                                                               'title' => 'Upload File',
                                                              'message' => 'File was successfully uploaded!',
                                                              'form' => $form->createView()
                                                              ));

       }
     return $app['twig']->render('files/upload_test.html', array(
                                                           'title' => 'Upload File',
                                                           'message' => '',
            'form' => $form->createView()
        )
    );
}, 'GET|POST');

$files->get('/uploads_view', function() use ($app) {
    return $app['twig']->render('files/view_files.html',array(
                                                         'title'=> 'View Uploads',
                                                         ));
  });

// admin controllers
$admin->get('/user_view', function() use ($app) {
    return $app['twig']->render('admin/users_view.html',array(
                                                         'title'=> 'View users',
                                                         ));
  });


// mount controllers:
$app->mount('/files', $files);
$app->mount('/forms', $forms);
$app->mount('/admin', $admin);
