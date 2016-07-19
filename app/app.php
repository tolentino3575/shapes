<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Circle.php";
    require_once __DIR__."/../src/Square.php";
    require_once __DIR__."/../src/Rectangle.php";

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
        return $app['twig']->render('/circle/circles.html.twig', array('circles' => Circle::getAll()));
    });

    $app->post('/add_circle', function() use($app){
        $circle_name = $_POST['circle_name'];
        $circle_radius = $_POST['circle_radius'];
        $id = null;
        $new_circle = new Circle($circle_name, $circle_radius, $id);
        $new_circle->saveCircle();
        return $app['twig']->render('/circle/circles.html.twig', array('circles' => Circle::getAll()));
    });

    $app->get('/circle/{id}', function($id) use ($app){
        $circle = Circle::findCircle($id);
        return $app['twig']->render('/circle/circle.html.twig', array('circle' => $circle));
    });

    $app->get('/circle/{id}/edit', function($id) use ($app){
        $circle = Circle::findCircle($id);
        return $app['twig']->render('/circle/circle_edit.html.twig', array('circle' => $circle));
    });

    $app->patch('/circle/{id}', function($id) use ($app){
        $new_circle_name = $_POST['new_circle_name'];
        $new_circle_radius = $_POST['new_circle_radius'];
        $circle = Circle::findCircle($id);
        $circle->updateCircle($new_circle_name, $new_circle_radius);
        return $app['twig']->render('/circle/circle.html.twig', array('circle' => $circle));
    });

    $app->get('/circles_home', function() use ($app){
        return $app['twig']->render('/circle/circles.html.twig', array('circles' => Circle::getAll()));
    });

    //Square
    $app->get('/squares', function() use ($app){
        return $app['twig']->render('/square/squares.html.twig', array('squares' => Square::getAll()));
    });

    $app->post('/add_square', function() use ($app){
        $square_name = $_POST['square_name'];
        $square_width = $_POST['square_width'];
        $id = null;
        $new_square = new Square($square_name, $square_width, $id);
        $new_square->saveSquare();
        return $app['twig']->render('/square/squares.html.twig', array('squares' => Square::getAll()));
    });

    $app->get('/square/{id}', function($id) use ($app){
        $square = Square::findSquare($id);
        return $app['twig']->render('/square/square.html.twig', array('square' => $square));
    });

    $app->get('/square/{id}/edit', function($id) use ($app){
        $square = Square::findSquare($id);
        return $app['twig']->render('/square/square_edit.html.twig', array('square' => $square));
    });

    $app->patch('/square/{id}', function($id) use ($app){
        $new_square_name = $_POST['new_square_name'];
        $new_square_width = $_POST['new_square_width'];
        $square = Square::findSquare($id);
        $square->updateSquare($new_square_name, $new_square_width);
        return $app['twig']->render('/square/square.html.twig', array('square' => $square));
    });

    $app->get('/squares_home', function() use ($app){
        return $app['twig']->render('/square/squares.html.twig', array('squares' => Square::getAll()));
    });

    //Rectangle
    $app->get('/rectangles', function() use ($app){
        return $app['twig']->render('/rectangle/rectangles.html.twig', array('rectangles' => Rectangle::getAll()));
    });

    $app->post('/add_rectangle', function() use ($app){
        $rectangle_name = $_POST['rectangle_name'];
        $rectangl_length = $_POST['rectangle_length'];
        $rectangle_width = $_POST['rectangle_width'];
        $id = null;
        $new_rectangle = new Rectangle($rectangle_name, $rectangle_length, $rectangle_width, $id);
        $new_rectangle->saveRectangle();
        return $app['twig']->render('/rectangle/rectangles.html.twig', array('rectangles' => Rectangle::getAll()));
    });

    $app->get('/rectangle/{id}', function($id) use ($app){
        $rectangle = Rectangle::findRectangle($id);
        return $app['twig']->render('/rectangle/rectangle.html.twig', array('rectangle' => $rectangle));
    });

    $app->get('/rectangle/{id}/edit', function($id) use ($app){
        $rectangle = Rectangle::findRectangle($id);
        return $app['twig']->render('/rectangle/rectangle_edit.html.twig', array('rectangle' => $rectangle));
    });

    $app->patch('/rectangle/{id}', function($id) use ($app){
        $new_rectangle_name = $_POST['new_rectangle_name'];
        $new_rectangle_length = $_POST['new_rectangle_length'];
        $new_rectangle_width = $_POST['new_rectangle_width'];
        $rectangle = Rectangle::findRectangle($id);
        $rectangle->updateRectangle($new_rectangle_name, $new_rectangle_length, $new_rectangle_width);
        return $app['twig']->render('/rectangle/rectangle.html.twig', array('rectangle' => $rectangle));
    });

    $app->get('/rectangles_home', function() use ($app){
        return $app['twig']->render('/rectangle/rectangles.html.twig', array('rectangles' => Rectangle::getAll()));
    });

    return $app;
 ?>
