<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Circle.php";

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app = new Silex\Application();

    $server = 'mysql:host=localhost:8889;dbname=shapes';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path'=>__DIR__.'/../views'
    ));

    $app->get('/', function() use ($app){
        return $app['twig']->render('index.html.twig');
    });

    //Circle
    $app->get('/circles', function() use($app){
        return $app['twig']->render('circles.html.twig', array('circles' => Circle::getAll()));
    });

    $app->post('/add_circle', function() use($app){
        $circle_name = $_POST['circle_name'];
        $circle_radius = $_POST['circle_radius'];
        $id = null;
        $new_circle = new Circle($circle_name, $circle_radius, $id);
        $new_circle->saveCircle();
        return $app['twig']->render('circles.html.twig', array('circles' => Circle::getAll()));
    });

    $app->get('/circle/{id}', function($id) use ($app){
        $circle = Circle::findCircle($id);
        return $app['twig']->render('circle.html.twig', array('circle' => $circle));
    });

    $app->get('/circle/{id}/edit', function($id) use ($app){
        $circle = Circle::findCircle($id);
        return $app['twig']->render('circle_edit.html.twig', array('circle' => $circle));
    });

    $app->patch('/circle/{id}', function($id) use ($app){
        $new_circle_name = $_POST['new_circle_name'];
        $new_circle_radius = $_POST['new_circle_radius'];
        $circle = Circle::findCircle($id);
        $circle->updateCircle($new_circle_name, $new_circle_radius);
        return $app['twig']->render('circle.html.twig', array('circle' => $circle, 'circles' => Circle::getAll()));
    });

    $app->get('/circles_home', function() use ($app){
        return $app['twig']->render('circles.html.twig', array('circles' => Circle::getAll()));
    });

    return $app;
 ?>
