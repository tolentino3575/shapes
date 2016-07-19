<?php

/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/

require_once 'src/Circle.php';

$server = 'mysql:host=localhost:8889;dbname=shapes_test';
$username = 'root';
$password = 'root';
$DB = new PDO($server, $username, $password);

class CircleTest extends PHPUnit_Framework_TestCase
{
    protected function TearDown()
    {
        Circle::deleteAll();
    }

    function test_getCircleName()
    {
        $circle_name = 'CircleOne';
        $circle_radius = 3;
        $id = 1;
        $test_circle_name = new Circle($circle_name, $circle_radius, $id);

        $result = $test_circle_name->getCircleName();

        $this->assertEquals($circle_name, $result);
    }

    function test_getCircleRadius()
    {
        $circle_name = 'CircleOne';
        $circle_radius = 3;
        $id = 1;
        $test_circle_radius = new Circle($circle_name, $circle_radius, $id);

        $result = $test_circle_radius->getCircleRadius();

        $this->assertEquals($circle_radius, $result);
    }

    function test_getCircleId()
    {
        $circle_name = 'CircleOne';
        $circle_radius = 3;
        $id = 1;
        $test_circle_id = new Circle($circle_name, $circle_radius, $id);

        $result = $test_circle_id->getCircleId();

        $this->assertEquals($id, $result);
    }

    function test_saveCircle()
    {
        $circle_name = 'CircleOne';
        $circle_radius = 3;
        $id = 1;
        $test_circle = new Circle($circle_name, $circle_radius, $id);
        $test_circle->saveCircle();

        $result = Circle::getAll();

        $this->assertEquals([$test_circle], $result);
    }

    function test_getAll()
    {
        $circle_name1 = 'CircleOne';
        $circle_radius1 = 3;
        $id1 = 1;
        $test_circle1 = new Circle($circle_name1, $circle_radius1, $id1);
        $test_circle1->saveCircle();

        $circle_name2 = 'CircleTwo';
        $circle_radius2 = 4;
        $id2 = 2;
        $test_circle2 = new Circle($circle_name2, $circle_radius2, $id2);
        $test_circle2->saveCircle();

        $result = Circle::getAll();

        $this->assertEquals([$test_circle1, $test_circle2], $result);
    }

    function test_findCircle()
    {
        $circle_name = 'CircleOne';
        $circle_radius = 3;
        $id = 1;
        $test_circle = new Circle($circle_name, $circle_radius, $id);
        $test_circle->saveCircle();

        $result = Circle::findCircle($test_circle->getCircleId());

        $this->assertEquals($test_circle, $result);
    }

    function test_updateCircle()
    {
        $circle_name = 'CircleOne';
        $circle_radius = 3;
        $id = 1;
        $test_circle = new Circle($circle_name, $circle_radius, $id);
        $test_circle->saveCircle();

        $new_circle_name = 'CircleTwo';
        $new_circle_radius = 4;
        $test_circle->updateCircle($new_circle_name, $new_circle_radius);

        $result = $test_circle->getCircleName();
        $result2 = $test_circle->getCircleRadius();

        $this->assertEquals($new_circle_name, $result);
        $this->assertEquals($new_circle_radius, $result2);
    }
}

?>
